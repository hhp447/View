<?php
namespace app\controllers;
use yii\web\Controller;
use Yii;
use app\models\User;
use app\models\Careshow;
use app\models\Careart;
use crazyfd\qiniu\Qiniu;

class UserController extends Controller
{
	public function actionIndex()
	{
		$this->layout = false;
		$username = Yii::$app->session['user']['username'];
		$model = User::find()->where('username = :name', [':name' => $username])->one();

		if(isset(Yii::$app->request->post()['User']['nickname']))
		{	
			$post = Yii::$app->request->post();
			$qiniu = new Qiniu(User::AK, User::SK, User::DOMAIN, User::BUCKET);
			$post['User']['photo'] = $model->photo;
            //if($_FILES['User']['error']['photo'] == 0){//如果有换头像
                if($_FILES['User']['tmp_name']['photo'])
                {
                	$key = uniqid();
                	$qiniu->uploadFile($_FILES['User']['tmp_name']['photo'], $key);
                	$post['User']['photo'] = 'http://'.$qiniu->getLink($key);//覆盖新的封面
                }
                //$qiniu->delete(basename($model->photo));//删除七牛中原来的封面照片
                if((bool)$model->updateAll([
					'nickname' => $post['User']['nickname'],
					'useremail' => $post['User']['useremail'],
					'truename' => $post['User']['truename'],
					'phone' => $post['User']['phone'],
					'introduction' => $post['User']['introduction'],
					'photo' => $post['User']['photo']],'username = :name',[':name' => $username]))
				{
					Yii::$app->session->setFlash('info','修改成功');
				}else
				{
					Yii::$app->session->setFlash('info','修改失败');
				}
		}

		if(isset(Yii::$app->request->post()['User']['newuserpass']))
		{	
			$post = Yii::$app->request->post();
			/*echo "<pre>";print_r($post);die;*/
			/*$a = $model->change_pass($post);
			echo $a;die;*/
			if($model->change_pass($post))
			{
				Yii::$app->session->setFlash('info','修改成功');
			}else{
				Yii::$app->session->setFlash('info','修改失败');
			}
		}




		$data = $model->find()->where('username = :name',[':name' => $username])->one();
		$arts = $model->findart($username);
        echo "<pre>";print_r($arts);die;
		$shows = $model->findshow($username);
		$tickets = $model->findticket($username);
		$data->userpass='';
		$data->userrepass = '';
		/*echo "<pre>";print_r($tickets);die;*/
		$notify = $model->findnotify($username);
		return $this->render('index',['model' => $data,
            'arts' => $arts,
            'shows' => $shows,
            'tickets' => $tickets,
            'notifys' => $notify]);
	}

	public function actionOut()//ajax退订消息
	{
		if(Yii::$app->request->isAjax)
		{
			if(Yii::$app->request->isPost)
			{
				$post = Yii::$app->request->post();
				$showid = $post['showid'];

				$username = Yii::$app->session['user']['username'];

				$data = User::find()->where('username = :name',[':name' => $username])->one();
				$userid = $data->userid;

				$model = new Careshow;
				if((bool)$model->deleteAll('showid = :show and userid = :id',[':show' => $showid,':id' => $userid]))
				{
					echo json_encode("退订成功");
				}else
				{
					echo json_encode("退订失败");
				}	
			}
		}
	}


	public function actionOut_art()//ajax取消关注方法
	{
		if(Yii::$app->request->isAjax)
		{
			if(Yii::$app->request->isPost)
			{
				$post = Yii::$app->request->post();
				$artistid = $post['artid'];
				$username = Yii::$app->session['user']['username'];
				$data = User::find()->where('username = :name',[':name' => $username])->one();
				$userid = $data->userid;
				$model = new Careart;
				if((bool)$model->deleteAll('artistid = :art and userid = :id',[':art' => $artistid,':id' => $userid]))
				{
					echo json_encode("取消关注成功");
				}else
				{
					echo json_encode("您已取消关注");
				}	
			}
		}
	}


	/*public function actionChange_pass()
	{
		$this->layout = false;
		$username = Yii::$app->session['user']['username'];
		$model = User::find()->where('username = :name', [':name' => $username])->one();
		if(Yii::$app->request->isPost)
		{
			$post = Yii::$app->request->post();
			if($model->change_pass($post))
			{
				Yii::$app->session->setFlash('info','修改成功');
			}else{
				Yii::$app->session->setFlash('info','修改失败');
			}
		}
		return $this->render('index',[''])
	}

*/




}


?>