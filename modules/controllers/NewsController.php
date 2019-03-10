<?php
namespace app\modules\controllers;
use Yii;
use yii\web\Controller;
use app\modules\controllers\CommonController;
use app\models\News;
use yii\data\Pagination;
use crazyfd\qiniu\Qiniu;
use yii\web\ForbiddenHttpException;
use app\modules\models\AuthItemChild;
class NewsController extends CommonController
{
	public function actionIndex()
	{
        
		$this->layout = "layout1";
		if(Yii::$app->request->get('newid'))//删除方法
		{
            $name = Yii::$app->session['admin']['adminuser'];
            $model = new AuthItemChild;
            $data = $model->getChild($name);
            //echo "<pre>";print_r($data);die;
            $can = 0;
            foreach($data as $role)
            {
                if($role == 'deletePost')
                {
                    $can = 1;
                }
            }
            if(!$can)
            {
                throw new ForbiddenHttpException('对不起，您没有权限执行此操作');
            }
			$newid = Yii::$app->request->get('newid');
			$model2 = new News;
			if((bool)$model2->deleteAll('newid = :id',[':id' => $newid]))
			{
				Yii::$app->session->setFlash('info','删除成功');
			}/*else{
				Yii::$app->session->setFlash('info','删除失败');
			}*/
		}
		$model = News::find();
		$model3 = new News;
		$count = $model->count();
		$pagesize = Yii::$app->params['adminPageSize']['NewsSize'];
		$pager = new Pagination(['totalCount' => $count,'pageSize' => $pagesize]);
		$news = $model->offset($pager->offset)->limit($pager->limit)->all();
		return $this->render('index',['pager' => $pager,'news' => $news,'model' => $model3]);
	}


	public function actionCreate()
	{
        $name = Yii::$app->session['admin']['adminuser'];
        $model = new AuthItemChild;
        $data = $model->getChild($name);
        //echo "<pre>";print_r($data);die;
        $can = 0;
        foreach($data as $role)
        {
            if($role == 'createPost' || $role == 'operator')
            {
                $can = 1;
            }
        }
        if(!$can)
        {
            throw new ForbiddenHttpException('对不起，您没有权限执行此操作');
        }
		$this->layout = "layout1";
		if (Yii::$app->request->isPost) {
			$model4 = new News;
            $post = Yii::$app->request->post();
            $pics = $this->upload();

            if (!$pics) {
                $model4->addError('cover', '封面不能为空');
            } else {

                $post['News']['cover'] = 'http://'.$pics['cover'];
                $post['News']['pics'] = $pics['pics'];
            }
            if ($pics && $model4->reg($post)) {
                Yii::$app->session->setFlash('info', '添加成功');
            } else {
                Yii::$app->session->setFlash('info', '添加失败');
            }

        }

        
		$model = News::find();
		$model3 = new News;
		$count = $model->count();
		$pagesize = Yii::$app->params['adminPageSize']['NewsSize'];
		$pager = new Pagination(['totalCount' => $count,'pageSize' => $pagesize]);
		$news = $model->offset($pager->offset)->limit($pager->limit)->all();
		return $this->render('index',['pager' => $pager,'news' => $news,'model' => $model3]);
	}





	public function actionUpdatenews()
    {
            $name = Yii::$app->session['admin']['adminuser'];
            $model = new AuthItemChild;
            $data = $model->getChild($name);
            //echo "<pre>";print_r($data);die;
            $can = 0;
            foreach($data as $role)
            {
                if($role == 'updatePost' || $role == 'operator')
                {
                    $can = 1;
                }
            }
            if(!$can)
            {
                throw new ForbiddenHttpException('对不起，您没有权限执行此操作');
            }
            $this->layout = "layout1";
            $newid = Yii::$app->request->get('newid');
            $model = new News;
            $model = $model->find()->where('newid = :id',[':id' => $newid])->one();
            //echo "<pre>";print_r($model);die;



            if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $qiniu = new Qiniu(News::AK, News::SK, News::DOMAIN, News::BUCKET);
            $post['News']['cover'] = $model->cover;
            //echo $_FILES['Product']['error']['cover']; die;
            if ($_FILES['News']['error']['cover'] == 0) {//如果没有错误
                $key = uniqid();
                $qiniu->uploadFile($_FILES['News']['tmp_name']['cover'], $key);

                $post['News']['cover'] = $qiniu->getLink($key);//覆盖新的封面
                //$qiniu->delete(basename($model->cover));//删除七牛中原来的封面照片
            }
            $pics = [];
            foreach($_FILES['News']['tmp_name']['pics'] as $k => $file) {
                if ($_FILES['News']['error']['pics'][$k] > 0) {//有错误，跳过
                    continue;
                }
                $key = uniqid();
                $qiniu->uploadfile($file, $key);//上传图片到七牛中
                $pics[$key] = $qiniu->getlink($key);//获取上传图片的KEY
            }
            $post['News']['pics'] = json_encode(array_merge((array)json_decode($model->pics, true), $pics));
            if ((bool)$model->updateAll([
                    'title' => $post['News']['title'],
                    'num' => $post['News']['num'],
                    'author' => $post['News']['author'],
                    'content' => $post['News']['content'],
                    'pics' => $post['News']['pics'],
                    'cover' => "http://".$post['News']['cover']],'newid = :id',[':id' => $newid])){
                        Yii::$app->session->setFlash('info', '修改成功');
                    }else{
                        Yii::$app->session->setFlash('info', '修改失败');
                    }
                }



                $model = News::find()->where('newid = :id',[':id' => $newid])->one();
            return $this->render('updatenews',['model' => $model]);
    }






	private function upload()//上传文件到七牛
    {
        if ($_FILES['News']['error']['cover'] > 0) {
            return false;
        }
        $qiniu = new Qiniu(News::AK, News::SK, News::DOMAIN, News::BUCKET);
        $key = uniqid();//在七牛上用key来定位图片
        $qiniu->uploadFile($_FILES['News']['tmp_name']['cover'], $key);//上传图片
        $cover = $qiniu->getLink($key);//上传后图片的外链
        $pics = [];//附加图片，有多张，所以定义一个数组来存储
        foreach ($_FILES['News']['tmp_name']['pics'] as $k => $file) {
            if ($_FILES['News']['error']['pics'][$k] > 0) {//大于0代表有错
                continue;
            }
            $key = uniqid();
            $qiniu->uploadFile($file, $key);//上传每一个
            $pics[$key] = $qiniu->getLink($key);
        }
        return ['cover' => $cover, 'pics' => json_encode($pics)];
    }



    public function actionRemovepic()//编辑下面的删除图片
    {
        $key = Yii::$app->request->get("key");//获取传递过来的要删除的照片的key
        $newid = Yii::$app->request->get("newid");//获取该商品的ID
        $model = News::find()->where('newid = :id', [':id' => $newid])->one();
        //查询该商品的信息
        $qiniu = new Qiniu(News::AK, News::SK, News::DOMAIN, News::BUCKET);
        //$qiniu->delete($key);//删除七牛中的图片
        $pics = json_decode($model->pics, true);//将json数据转换为数组
        unset($pics[$key]);
        News::updateAll(['pics' => json_encode($pics)], 'newid = :id', [':id' => $newid]);//更新数据库数据
        return $this->redirect(['news/updatenews', 'newid' => $newid]);
    }



}
