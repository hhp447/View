<?php
namespace app\modules\controllers;
use Yii;
use yii\web\Controller;
use app\modules\controllers\CommonController;
use yii\data\Pagination;
use app\models\Artist;
use crazyfd\qiniu\Qiniu;
use yii\web\ForbiddenHttpException;
use app\modules\models\AuthItemChild;
class ArtistController extends CommonController
{
	public function actionIndex()
	{
		$this->layout = "layout1";
		if(Yii::$app->request->get('artistid'))//删除方法
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
			$artistid = Yii::$app->request->get('artistid');
			$model2 = new Artist;
			if((bool)$model2->deleteAll('artistid = :id',[':id' => $artistid]))
			{
				Yii::$app->session->setFlash('info','删除成功');
			}else{
				Yii::$app->session->setFlash('info','删除失败');
			}
		}
		$model = Artist::find();
		$model3 = new Artist;
		$count = $model->count();
		$pagesize = Yii::$app->params['adminPageSize']['ArtSize'];
		$pager = new Pagination(['totalCount' => $count,'pageSize' => $pagesize]);
		$arts = $model->offset($pager->offset)->limit($pager->limit)->all();
		return $this->render('index',['pager' => $pager,'arts' => $arts,'model' => $model3]);
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
			$model4 = new Artist;
            $post = Yii::$app->request->post();
            $pics = $this->upload();
            if (!$pics) {
                $model4->addError('cover', '封面不能为空');
            } else {
                $post['Artist']['cover'] = 'http://'.$pics['cover'];
                $post['Artist']['pics'] = $pics['pics'];
                //echo "<pre>";print_r($post);die;
            }
            if ($pics && $model4->reg($post)) {
                Yii::$app->session->setFlash('info', '添加成功');
            } else {
                Yii::$app->session->setFlash('info', '添加失败');
            }

        }
		$model = Artist::find();
		$model3 = new Artist;
		$count = $model->count();
		$pagesize = Yii::$app->params['adminPageSize']['UserSize'];
		$pager = new Pagination(['totalCount' => $count,'pageSize' => $pagesize]);
		$arts = $model->offset($pager->offset)->limit($pager->limit)->all();
		return $this->render('index',['pager' => $pager,'arts' => $arts,'model' => $model3]);
	}



	public function actionUpdateart()
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
            $artistid = Yii::$app->request->get('artistid');
            $model = new Artist;
            $model = $model->find()->where('artistid = :id',[':id' => $artistid])->one();
            //echo "<pre>";print_r($model);die;
            if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $qiniu = new Qiniu(Artist::AK, Artist::SK, Artist::DOMAIN, Artist::BUCKET);
            $post['Artist']['cover'] = $model->cover;
            if ($_FILES['Artist']['error']['cover'] == 0) {//如果没有错误
                $key = uniqid();
                $qiniu->uploadFile($_FILES['Artist']['tmp_name']['cover'], $key);

                $post['Artist']['cover'] = $qiniu->getLink($key);//覆盖新的封面
                //$qiniu->delete(basename($model->cover));//删除七牛中原来的封面照片
            }
            if ((bool)$model->updateAll([
                    'name' => $post['Artist']['name'],
                    'introduction' => $post['Artist']['introduction'],
                    'identity' => $post['Artist']['identity'],
                    'cover' => "http://".$post['Artist']['cover']],'artistid = :id',[':id' => $artistid])){
                        Yii::$app->session->setFlash('info', '修改成功');
                    }else{
                        Yii::$app->session->setFlash('info', '修改失败');
                    }
                }
                $model = Artist::find()->where('artistid = :id',[':id' => $artistid])->one();
            return $this->render('updateart',['model' => $model]);
    }


	private function upload()//上传文件到七牛
    {
        if ($_FILES['Artist']['error']['cover'] > 0) {
            return false;
        }
        $qiniu = new Qiniu(Artist::AK, Artist::SK, Artist::DOMAIN, Artist::BUCKET);
        $key = uniqid();//在七牛上用key来定位图片
        $qiniu->uploadFile($_FILES['Artist']['tmp_name']['cover'], $key);//上传图片
        $cover = $qiniu->getLink($key);//上传后图片的外链
        $pics = [];//附加图片，有多张，所以定义一个数组来存储
        foreach ($_FILES['Artist']['tmp_name']['pics'] as $k => $file) {
            if ($_FILES['Artist']['error']['pics'][$k] > 0) {//大于0代表有错
                continue;
            }
            $key = uniqid();
            $qiniu->uploadFile($file, $key);//上传每一个
            $pics[$key] = $qiniu->getLink($key);
        }
        return ['cover' => $cover, 'pics' => json_encode($pics)];
    }

}