<?php
namespace app\modules\controllers;
use Yii;
use yii\web\Controller;
use app\modules\controllers\CommonController;
use app\models\User;
use yii\data\Pagination;
use yii\web\ForbiddenHttpException;
use app\modules\models\AuthItemChild;
class UserController extends CommonController
{
	public function actionIndex()
	{
		$this->layout = "layout1";
		if(Yii::$app->request->get('userid'))//删除方法
		{
			$name = Yii::$app->session['admin']['adminuser'];
			$model = new AuthItemChild;
			$data = $model->getChild($name);
			//echo "<pre>";print_r($data);die;
			$can = 0;
			foreach($data as $role)
			{
				if($role == 'deleteUser')
				{
					$can = 1;
				}
			}
			if(!$can)
			{
				throw new ForbiddenHttpException('对不起，您没有权限执行此操作');
			}
			$userid = Yii::$app->request->get('userid');
			$model2 = new User;
			if((bool)$model2->deleteAll('userid = :id',[':id' => $userid]))
			{
				Yii::$app->session->setFlash('info','删除成功');
			}else{
				Yii::$app->session->setFlash('info','删除失败');
			}
		}

		$model = User::find();
		$model3 = new User;
		$count = $model->count();
		$pagesize = Yii::$app->params['adminPageSize']['UserSize'];
		$pager = new Pagination(['totalCount' => $count,'pageSize' => $pagesize]);
		$users = $model->offset($pager->offset)->limit($pager->limit)->all();
		return $this->render('index',['pager' => $pager,'users' => $users,'model' => $model3]);
	}


	public function actionCreate()//创建用户
	{
		
		$name = Yii::$app->session['admin']['adminuser'];
		$model = new AuthItemChild;
		$data = $model->getChild($name);
		//echo "<pre>";print_r($data);die;
		$can = 0;
		foreach($data as $role)
		{
			if($role == 'useroperator' || $role == 'createUser')
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
			$model2 = new User;
			$post = Yii::$app->request->post();
			if($model2->reg($post))
			{
				Yii::$app->session->setFlash('info','新增成功');
			}else{
				Yii::$app->session->setFlash('info','新增失败');
			}
		}
		$model = User::find();
		$model3 = new User;
		$count = $model->count();
		$pagesize = Yii::$app->params['adminPageSize']['UserSize'];
		$pager = new Pagination(['totalCount' => $count,'pageSize' => $pagesize]);
		$users = $model->offset($pager->offset)->limit($pager->limit)->all();
		return $this->render('index',['pager' => $pager,'users' => $users,'model' => $model3]);
	}



	public function actionUpdateuser()
    {

    		$name = Yii::$app->session['admin']['adminuser'];
			$model = new AuthItemChild;
			$data = $model->getChild($name);
			//echo "<pre>";print_r($data);die;
			$can = 0;
			foreach($data as $role)
			{
				if($role == 'useroperator' || $role == 'updateUser')
				{
					$can = 1;
				}
			}
			if(!$can)
			{
				throw new ForbiddenHttpException('对不起，您没有权限执行此操作');
			}


            $this->layout = "layout1";
            $userid = Yii::$app->request->get('userid');
            $model = new User;
            $model = $model->find()->where('userid = :id',[':id' => $userid])->one();
            //echo "<pre>";print_r($model);die;


            if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ((bool)$model->updateAll([
                    'username' => $post['User']['username'],
                    'userpass' => md5($post['User']['userpass']),
                    'useremail' => $post['User']['useremail'],
                    'truename' => $post['User']['truename'],
                    'introduction' => $post['User']['introduction'],
                    'nickname' => $post['User']['nickname']],'userid = :id',[':id' => $userid])){
                        Yii::$app->session->setFlash('info', '修改成功');
                    }else{
                        Yii::$app->session->setFlash('info', '修改失败');
                    }
                }


                $model = User::find()->where('userid = :id',[':id' => $userid])->one();
            return $this->render('updateuser',['model' => $model]);
    }

	


}