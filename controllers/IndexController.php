<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Show;
use app\models\User;
use app\models\Artist;
use app\models\News;

class IndexController extends Controller
{
	
	public function actionIndex()//项目首页
	{
		$this->layout = false;
		$model = new Show;
		$art = new Artist;
		$new = new News;
		$cover = $model->find()->where('isCover = :cover',[':cover' => 1])->limit(3)->all();
		$show = $model->find()->orderBy("createtime DESC")->limit(5)->all();
		$art = $art->find()->orderBy('num ASC')->limit(2)->all();
		$news = $new->find()->orderBy("createtime DESC")->limit(3)->all();
		return $this->render("index",['cover' => $cover,'shows' => $show,'arts' => $art,'news' => $news]);
	}




	public function actionLoginre()//注册方法
	{
		$this->layout = false;
		$model = new User;
		if(Yii::$app->request->isPost)
		{
			$post = Yii::$app->request->post();
			/*echo "<pre>";print_r($post);die;*/
			if($model->reg($post))
			{
				Yii::$app->session->setFlash('info','注册成功');
			}else
			{
				Yii::$app->session->setFlash('info','注册失败');
			}
			/*echo "<pre>";print_r($post);die;*/
		}
		$model->userpass = '';
		$model->userrepass = '';
		return $this->render("loginre",['model' => $model]);
	}





	public function actionLogin()//登录方法
	{
		$this->layout = false;
		$model = new User;
		if(Yii::$app->request->isPost)
		{
			$post = Yii::$app->request->post();
			if($model->log($post))
			{
				$this->redirect(['index/index']);
				Yii::$app->end();
			}else
			{
				Yii::$app->session->setFlash('info','登录失败,邮箱或者密码不正确');
				$this->redirect(['index/loginre']);
			}
		}
		$this->redirect(['index/loginre']);
	}

	public function actionLogout()
	{
		Yii::$app->session->removeAll();
        if (!isset(Yii::$app->session['user']['isLogin'])) {
            $this->redirect(['index/loginre']);
            Yii::$app->end();
        }
        $this->goback();
	}



	public function actionSeekpass()
	{
		$this->layout = false;
		$model = new User;
		if (Yii::$app->request->isPost) {//查看是否有post数据提交过来
            $post = Yii::$app->request->post();//接受数据
            if ($model->seekPass($post)) {//执行找回密码发送邮件方法
                Yii::$app->session->setFlash('info', '电子邮件已经发送成功，请查收');//邮件发送成功提醒
            }
        }
		return $this->render('seek',['model' => $model]);
	}


	public function actionMailchangepass()
    {
        $this->layout = false;
        $time = Yii::$app->request->get("timestamp");
        $username = Yii::$app->request->get("username");
        $token = Yii::$app->request->get("token");
        $model = new User;
        $myToken = $model->createToken($username, $time);
        if ($token != $myToken) {
            $this->redirect(['index/loginre']);
            Yii::$app->end();
        }
        if (time() - $time > 300) {
            $this->redirect(['index/loginre']);
            Yii::$app->end();
        }
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->changePass($post)) {
                Yii::$app->session->setFlash('info', '密码修改成功');
            }
        }
        $model->username = $username;
        return $this->render("mailchangepass", ['model' => $model]);

    }




}







