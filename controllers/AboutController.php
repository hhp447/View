<?php
namespace app\controllers;
use yii\web\Controller;
use app\models\Suggestion;
use Yii;

class AboutController extends Controller
{
	public function actionIndex()
	{
		$this->layout = false;
		$model = new Suggestion;
		if(Yii::$app->request->isPost)
		{
			$post = Yii::$app->request->post();
			if($model->add($post))
			{
				Yii::$app->session->setFlash('info','反馈成功');
			}else{
				Yii::$app->session->setFlash('info','反馈失败');
			}
		}
		return $this->render('index',['model' => $model]);
	}
}