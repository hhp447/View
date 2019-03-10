<?php
namespace app\modules\controllers;
use Yii;
use yii\web\Controller;
use app\modules\controllers\CommonController;
use app\modules\models\Admin;
use app\modules\models\AuthAssignment;
use app\modules\models\AuthItemChild;
use yii\web\ForbiddenHttpException;
use app\models\News;
use app\models\User;
use app\models\Show;
use app\models\Artist;
class IndexController extends CommonController
{
	public function actionIndex()
	{
		/*if($a)
		{
			throw new ForbiddenHttpException('对不起，您没有权限执行此操作');
		}*/
		/*$name = Yii::$app->session['admin']['adminuser'];
		$model = new AuthItemChild;
		$data = $model->getChild($name);
		foreach($data as $role)
		{
			if
		}*/
		//echo "<pre>";print_r($data);die;
		$this->layout = "layout1";
		$news = News::find()->orderBy('num DESC')->limit(10)->all();
		$news_all = News::find()->all();
		
		$sum=0;//资讯总浏览用户量
		foreach($news_all as $all)
		{
			$sum+=$all->num;
		}
		$user_num = User::find()->count();//用户量
		$show_num = Show::find()->count();//展览量
		$news_num = News::find()->count();//资讯量
		$artist_num = Artist::find()->count();//艺术家量
		$total = compact('news','sum','user_num','show_num','news_num','artist_num');
			//echo "<pre>";print_r($total);die;
		return $this->render('index',['total' => $total]);
	}



}