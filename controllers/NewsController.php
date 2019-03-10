<?php
namespace app\controllers;

use yii\web\Controller;
use Yii;
use app\models\News;
/*echo "<pre>";print_r($data);die;*/
class NewsController extends Controller
{
	public function actionIndex()
	{
		$this->layout = false;
		$model = new News;
		$data["three"] = $model->find()->orderBy("createtime DESC")->limit(3)->all();
		$data["all"] = $model->find()->orderBy("createtime DESC")->all();
		return $this->render('newsindex',['data' => $data]);
	}


	public function actionDetail()
	{
		$this->layout = false;
		$model = new News;
		if(Yii::$app->request->get('newid'))
		{
			$newid = Yii::$app->request->get('newid');
			$new = $model->find()->where('newid = :id',[':id' => $newid])->one();
			return $this->render('newsdetail',['new' => $new]);
		}
		$this->redirect(['index/index']);
	}



	public function actionAddnum()//ajax增加浏览次数
	{
		if(Yii::$app->request->isAjax)
		{
			$model = new News;
			if(Yii::$app->request->isPost)
			{
				$post = Yii::$app->request->post('newid');
				$new = $model->find()->where('newid = :id',[':id' => $post])->one();
				$new->num = $new->num+1;
				$new->save();
			}
		}
	}


	public function actionFind()
	{
		
	}



}

?>