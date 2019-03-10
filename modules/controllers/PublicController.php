<?php
namespace app\modules\controllers;
use yii\web\Controller;
use Yii;
use app\modules\models\Admin;
class PublicController extends Controller
{

	public function actionLogin()//管理员登录方法
	{
		$this->layout = false;
		$model = new Admin;
		if(Yii::$app->request->isPost)
		{
			$post = Yii::$app->request->post();
			/*echo "<pre>";print_r($post);die;*/
			if($model->login($post))
			{
				return $this->redirect(['index/index']);//跳转到后台首页
				Yii::$app->end();
			}
		}
		return $this->render('login',['model' => $model]);
	}




	public function actionLogout()//退出登录方法
	{
		Yii::$app->session->removeAll();
		if(!isset(Yii::$app->session['admin']['isLogin']))
		{
			$this->redirect(['public/login']);
			Yii::$app->end();
		}
		$this->goback();
	}


}
?>