<?php
namespace app\modules\controllers;
use Yii;
use yii\web\Controller;
use app\modules\controllers\CommonController;
use app\models\Show;
use app\models\Notify;
use app\models\Careart;
use yii\data\Pagination;
use crazyfd\qiniu\Qiniu;
use yii\web\ForbiddenHttpException;
use app\modules\models\AuthItemChild;
class ShowController extends CommonController
{
	public function actionIndex()
	{
		$this->layout = "layout1";
		if(Yii::$app->request->get('showid'))//删除方法
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
			$showid = Yii::$app->request->get('showid');
			$model2 = new Show;
			if((bool)$model2->deleteAll('showid = :id',[':id' => $showid]))
			{
				Yii::$app->session->setFlash('info','删除成功');
			}/*else{
				Yii::$app->session->setFlash('info','删除失败');
			}*/
		}
		$model = Show::find();
		$model3 = new Show;
		$count = $model->count();
		$pagesize = Yii::$app->params['adminPageSize']['ShowSize'];
		$pager = new Pagination(['totalCount' => $count,'pageSize' => $pagesize]);
		$shows = $model->offset($pager->offset)->limit($pager->limit)->all();
		return $this->render('index',['pager' => $pager,'shows' => $shows,'model' =>$model3]);
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
			$model4 = new Show;
            $post = Yii::$app->request->post();
            $pics = $this->upload();

            if (!$pics) {
                $model4->addError('cover', '封面不能为空');
            } else {

                $post['Show']['cover'] = 'http://'.$pics['cover'];
                $post['Show']['pics'] = $pics['pics'];
            }
            if ($pics && $model4->reg($post)) {
            	$artid = $post['Show']['artistid'];
            	$data = Careart::find()->where('artistid = :id',[':id' => $artid])->all();
            	foreach($data as $v)
            	{
            		$notify = new Notify;
            		$notify->title = "系统通知";
            		$notify->content = "您关注的艺术家出新展览啦！！！快去查看。";
            		$notify->userid = $v->userid;
            		$notify->createtime = time();
            		$notify->save();
            	}
                Yii::$app->session->setFlash('info', '添加成功');
            } /*else {
                Yii::$app->session->setFlash('info', '添加失败');
            }*/
        }
		$model = Show::find();
		$model3 = new Show;
		$count = $model->count();
		$pagesize = Yii::$app->params['adminPageSize']['ShowSize'];
		$pager = new Pagination(['totalCount' => $count,'pageSize' => $pagesize]);
		$shows = $model->offset($pager->offset)->limit($pager->limit)->all();
		return $this->render('index',['pager' => $pager,'shows' => $shows,'model' =>$model3]);
	}


    public function actionUpdateshow()
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
            $showid = Yii::$app->request->get('showid');
            $model = new Show;
            $model = $model->find()->where('showid = :id',[':id' => $showid])->one();
            //echo "<pre>";print_r($model);die;
            if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            //echo "<pre>";print_r($post);die;
            $qiniu = new Qiniu(Show::AK, Show::SK, Show::DOMAIN, Show::BUCKET);
            $post['Show']['cover'] = $model->cover;
            //echo $_FILES['Product']['error']['cover']; die;
            if ($_FILES['Show']['error']['cover'] == 0) {//如果没有错误
                $key = uniqid();
                $qiniu->uploadFile($_FILES['Show']['tmp_name']['cover'], $key);

                $post['Show']['cover'] = $qiniu->getLink($key);//覆盖新的封面
                //$qiniu->delete(basename($model->cover));//删除七牛中原来的封面照片
            }
            $pics = [];
            foreach($_FILES['Show']['tmp_name']['pics'] as $k => $file) {
                if ($_FILES['Show']['error']['pics'][$k] > 0) {//有错误，跳过
                    continue;
                }
                $key = uniqid();
                $qiniu->uploadfile($file, $key);//上传图片到七牛中
                $pics[$key] = $qiniu->getlink($key);//获取上传图片的KEY
            }
            $post['Show']['pics'] = json_encode(array_merge((array)json_decode($model->pics, true), $pics));
            if ((bool)$model->updateAll([
                    'title' => $post['Show']['title'],
                    'smalltitle' => $post['Show']['smalltitle'],
                    'isCover' => $post['Show']['isCover'],
                    'artistid' => $post['Show']['artistid'],
                    'city' => $post['Show']['city'],
                    'place' => $post['Show']['place'],
                    'pay' => $post['Show']['pay'],
                    'num' => $post['Show']['num'],
                    'sponsor' => $post['Show']['sponsor'],
                    'introduction' => $post['Show']['introduction'],
                    'pics' => $post['Show']['pics'],
                    'cover' => "http://".$post['Show']['cover']],'showid = :id',[':id' => $showid])){
                        Yii::$app->session->setFlash('info', '修改成功');
                    }else{
                        Yii::$app->session->setFlash('info', '修改失败');
                    }
                }
                $model = Show::find()->where('showid = :id',[':id' => $showid])->one();
            return $this->render('updateshow',['model' => $model]);
    }



	private function upload()//上传文件到七牛
    {
        if ($_FILES['Show']['error']['cover'] > 0) {
            return false;
        }
        $qiniu = new Qiniu(Show::AK, Show::SK, Show::DOMAIN, Show::BUCKET);
        $key = uniqid();//在七牛上用key来定位图片
        $qiniu->uploadFile($_FILES['Show']['tmp_name']['cover'], $key);//上传图片
        $cover = $qiniu->getLink($key);//上传后图片的外链
        $pics = [];//附加图片，有多张，所以定义一个数组来存储
        foreach ($_FILES['Show']['tmp_name']['pics'] as $k => $file) {
            if ($_FILES['Show']['error']['pics'][$k] > 0) {//大于0代表有错
                continue;
            }
            $key = uniqid();
            $qiniu->uploadFile($file, $key);//上传每一个
            $pics[$key] = $qiniu->getLink($key);
        }
        return ['cover' => $cover, 'pics' => json_encode($pics)];
    }


    public function actionRemovepic()//编辑商品下面的删除图片
    {
        $key = Yii::$app->request->get("key");//获取传递过来的要删除的照片的key
        $showid = Yii::$app->request->get("showid");//获取该商品的ID
        $model = Show::find()->where('showid = :pid', [':pid' => $showid])->one();
        //查询该商品的信息
        $qiniu = new Qiniu(Show::AK, Show::SK, Show::DOMAIN, Show::BUCKET);
        //$qiniu->delete($key);//删除七牛中的图片
        $pics = json_decode($model->pics, true);//将json数据转换为数组
        unset($pics[$key]);
        Show::updateAll(['pics' => json_encode($pics)], 'showid = :id', [':id' => $showid]);//更新数据库数据
        return $this->redirect(['show/updateshow', 'showid' => $showid]);
    }



}