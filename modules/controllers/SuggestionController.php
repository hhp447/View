<?php
namespace app\modules\controllers;
use Yii;
use yii\web\Controller;
use app\modules\controllers\CommonController;
use app\models\Suggestion;
use yii\data\Pagination;
class SuggestionController extends CommonController
{
	public function actionIndex()
	{
		$this->layout = "layout1";
		if(Yii::$app->request->get('sugid'))//删除方法
		{
			$sugid = Yii::$app->request->get('sugid');
			$model2 = new Suggestion;
			if((bool)$model2->deleteAll('sugid = :id',[':id' => $sugid]))
			{
				Yii::$app->session->setFlash('info','删除成功');
			}/*else{
				Yii::$app->session->setFlash('info','删除失败');
			}*/
		}
		$model = Suggestion::find();
		$count = $model->count();
		$pagesize = Yii::$app->params['adminPageSize']['SuggestionSize'];
		$pager = new Pagination(['totalCount' => $count,'pageSize' => $pagesize]);
		$sugs = $model->offset($pager->offset)->limit($pager->limit)->all();
		return $this->render('index',['pager' => $pager,'sugs' => $sugs]);
	}
}