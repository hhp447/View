<?php
namespace app\modules\controllers;
use Yii;
use yii\web\Controller;
use app\modules\controllers\CommonController;
use app\modules\models\Admin;
use yii\data\Pagination;
use yii\web\ForbiddenHttpException;
use app\modules\models\AuthItemChild;
use app\modules\models\AuthAssignment;
class AdminController extends CommonController
{
	public function actionIndex()
	{
		$this->layout = "layout1";
		if(Yii::$app->request->get('adminid'))//删除管理员方法
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
			$adminid = Yii::$app->request->get('adminid');
			$model2 = new Admin;
			if((bool)$model2->deleteAll('id = :id',[':id' => $adminid]))
			{
				Yii::$app->session->setFlash('info','删除成功');
			}/*else{
				Yii::$app->session->setFlash('info','删除失败');
			}*/
		}
		$model = Admin::find();
		$model3 = new Admin;
		$count = $model->count();
		$pagesize = Yii::$app->params['adminPageSize']['AdminSize'];
		$pager = new Pagination(['totalCount' => $count,'pageSize' => $pagesize]);
		$admins = $model->offset($pager->offset)->limit($pager->limit)->all();
		return $this->render('index',['pager' => $pager,'admins' => $admins,'model' => $model3]);
	}


	public function actionUpdateadmin()
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

            $this->layout = "layout1";
            $id = Yii::$app->request->get('adminid');
            $model = new Admin;
            $model = $model->find()->where('id = :id',[':id' => $id])->one();
            //echo "<pre>";print_r($model);die;


            if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            //echo "<pre>";print_r($post);die;
            $auth = $post['auth'];
            $ass = new AuthAssignment;
            if((bool)$ass->deleteAll('user_id = :id',[':id' => $id]))//如果删除成功
            {}
            $ass->item_name = $auth;
        	$ass->user_id = $id;
        	$ass->created_at = time();
        	$ass->save();
            if ((bool)$model->updateAll([
                    'adminuser' => $post['Admin']['adminuser'],
                    'adminpass' => md5($post['Admin']['adminpass']),
                    'adminemail' => $post['Admin']['adminemail']],'id = :id',[':id' => $id])){
                        Yii::$app->session->setFlash('info', '修改成功');
                    }else{
                        Yii::$app->session->setFlash('info', '修改失败');
                    }
                }


                $model = Admin::find()->where('id = :id',[':id' => $id])->one();
            return $this->render('updateadmin',['model' => $model]);
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
			if($role == 'deletePost')
			{
				$can = 1;
			}
		}
		if(!$can)
		{
			throw new ForbiddenHttpException('对不起，您没有权限执行此操作');
		}
		$this->layout = "layout1";
		if(Yii::$app->request->isPost)
		{
			$model2 = new Admin;
			$post = Yii::$app->request->post();
			//echo "<pre>";print_r($post);die;
			if($model2->reg($post))
			{
				Yii::$app->session->setFlash('info','新增成功');
			}else{
				Yii::$app->session->setFlash('info','新增失败');
			}
		}
		$model = Admin::find();
		$model3 = new Admin;
		$count = $model->count();
		$pagesize = Yii::$app->params['adminPageSize']['AdminSize'];
		$pager = new Pagination(['totalCount' => $count,'pageSize' => $pagesize]);
		$admins = $model->offset($pager->offset)->limit($pager->limit)->all();
		return $this->render('index',['pager' => $pager,'admins' => $admins,'model' => $model3]);
	}
}