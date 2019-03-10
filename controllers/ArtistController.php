<?php
namespace app\controllers;
use yii\web\Controller;
use Yii;
use app\models\Artist;
use app\models\Show;
use app\models\Careart;
use app\models\User;
use app\models\Production;

class ArtistController extends Controller
{
	public function actionIndex()
	{
		$this->layout = false;
		$model = new Artist;
		$data = $model->find()->orderBy('createtime ASC')->all();
		$all = $model->find()->select(['abc'])->distinct()->all();
		//echo "<pre>";print_r($all);die;
		$arts = [];
		foreach($all as $a)
		{
			$abc = $a->abc;
			$arts[] = Artist::find()->where('abc = :a',[':a' => $abc])->all();
		}
			//echo "<pre>";print_r($arts);die;


		return $this->render('index',['model' => $data,'arts' => $arts]);
	}

	public function actionDetail()
	{
		$this->layout = false;
		$model = new Artist;
		$pro = new Production;
		$show = new Show;
		if(Yii::$app->request->get())
		{
			$id = Yii::$app->request->get('artistid');
			$art = $model->find()->where('artistid = :id',[':id' => $id])->one();
			$product = $pro->find()->where('artistid = :id',[':id' => $id])->all();
			$shows = $show->find()->where('artistid = :id',[':id' => $id])->all();
		}
		return $this->render('detail',['art' => $art,'products' => $product,'shows' => $shows]);
	}




	public function actionFind_art()
	{
		if(Yii::$app->request->isAjax)
		{
			if(Yii::$app->request->isPost)
			{
				$post = Yii::$app->request->post();
				$abc = $post['abc'];//接受表单异步传递过来的值
				$model = new Artist;
				$data = $model->find()->where('abc = :a',[':a' => $abc])->all();
				$a="<div id='".$abc."' class='abcbox clearfloat'><h3><span>".$abc."</span></h3><ul class='left clearfloat'>";
				foreach($data as $da)
				{
					$url = "?r=artist/detail&artistid=".$da->artistid;
					$a.= "<li><a href='".$url."'>".$da->name."</a></li>";
				}
				$a.= "</ul></div>";
				//$b[] = $a;
			}
			echo json_encode($a);
		}

	}



	public function actionKnow()
	{
		if(Yii::$app->request->get('artistid'))
		{
			$artistid = Yii::$app->request->get('artistid');
			$username = Yii::$app->session['user']['username'];
			//echo "<pre>";print_r($username);die;
			$userid = User::find()->where('username = :name',[':name' => $username])->one()->userid;
			$model = new Careart;
			$model->userid = $userid;
			$model->artistid = $artistid;
			$model->createtime = time();
			if($model->save())
			{
				Yii::$app->session->setFlash('info','关注成功');
				$this->redirect(['artist/detail','artistid' => $artistid]);
			}else{
				Yii::$app->session->setFlash('info','关注失败');
				$this->redirect(['artist/detail','artistid' => $artistid]);
			}
		}
	}



}

?>