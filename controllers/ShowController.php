<?php
namespace app\controllers;
use yii\web\Controller;
use Yii;
use app\models\Show;
use app\models\Ticket;
use app\models\User;
use app\models\Artist;
/*echo "<pre>";print_r($a);die;*/
class ShowController extends Controller
{
	public function actionIndex()
	{
		$this->layout = false;
		$model = new Show;
		$lifetime =1800;
        $session = Yii::$app->session;
        session_set_cookie_params($lifetime);
        $session['limit'] = 5;
		$shows = $model->find()->orderBy("createtime DESC")->limit(5)->all();//显示最新的5条数据
		return $this->render('index',['model' => $shows]);
	}

	public function actionDetail()
	{
		$this->layout = false;
		$ticket = new Ticket;
		$model = new Show;
		if(Yii::$app->request->isPost)//报名参加展览
		{
			$post = Yii::$app->request->post();
			if($ticket->add($post))
			{
				Yii::$app->session->setFlash('info','报名成功');
			}else
			{
				Yii::$app->session->setFlash('info','报名失败');
			}
			
		}
		if(Yii::$app->request->get('showid'))//显示详细信息
		{
			$get = Yii::$app->request->get('showid');
			$detail = $model->find()->where('showid = :id',[':id' => $get])->one();
			$name = Yii::$app->session['user']['username'];
			$userid = User::find()->where('username = :name',[':name' => $name])->one();
			return $this->render('detail',['detail' => $detail,'ticket' => $ticket,'email' => $userid]);
		}
		
		//$this->redirect(['index/index']);
	}

	public function actionDa_pl()//按时间和城市搜索方法
	{
		$this->layout = false;
		$lifetime =1800;
        $session = Yii::$app->session;
        session_set_cookie_params($lifetime);
		$model = New Show;
		if(Yii::$app->request->get('day') || Yii::$app->request->get('place'))//只要有选择条件
		{
			if(Yii::$app->request->get('day'))//如果选择的是日期
			{
				if(Yii::$app->request->get('day') == 100)//如果选择的是不限
				{
					$session['day'] = 0;
				}else//选择的不是不限
				{
					$session['day'] = Yii::$app->request->get('day');//获取这个天数
				}
			}
			if(Yii::$app->request->get('place'))//如果选择的是地点
			{
				if(Yii::$app->request->get('place') == '不限')//如果选择的是不限
				{
					$session['place'] = '';
				}else//如果选择的不是不限
				{
					$session['place'] = Yii::$app->request->get('place');//获取这个地点
				}
			}
			$time = Yii::$app->session['day'] ? '2017-05-'.Yii::$app->session['day'] : 0;//有值就拼起来
			$city = Yii::$app->session['place'] ? Yii::$app->session['place'] : '';//有值就拼起来
			$data = $model->findshow($time,$city);
			return $this->render('index',['model' => $data]);
		}
	}


	

	public function actionSearch()
	{
		$this->layout = false;
		if(Yii::$app->request->post('searchtext'))
		{
			$text = Yii::$app->request->post('searchtext');
			$data = Show::find()->where(['like','title',$text])->all();
			return $this->render('index',['model' => $data]);
		}else
		{
			$this->redirect(['index/index']);
		}
	}

	public function actionMore()
	{
		$model = new Show;
		$lifetime =1800;
        $session = Yii::$app->session;
        session_set_cookie_params($lifetime);
		$limit = Yii::$app->session['limit'] ? Yii::$app->session['limit'] : 0;
		$city = Yii::$app->session['place'] ? Yii::$app->session['place'] : 0;
		$time = Yii::$app->session['day'] ? '2017-05-'.Yii::$app->session['day'] : 0;
		if(!$time)        //没给时间
		{
			if(!$city)   //没给时间没给地点
			{
				$sql = "SELECT * FROM view_show limit $limit,5";
				$shows = $model->findBySql($sql)->asArray()->all();
			}else         //没给时间有给地点
			{
				$sql = "SELECT * FROM view_show where city = '$city' limit $limit,5";
				$shows = $model->findBySql($sql)->asArray()->all();
			}
		}else             //有给时间
		{
			$time1 = strtotime($time);
			if(!$city)   //有给时间没给地点
			{
				$sql = "SELECT * FROM view_show where start_time = '$time1' limit $limit,5";
				$shows = $model->findBySql($sql)->asArray()->all();
			}else         //有给时间有给地点
			{
				$sql = "SELECT * FROM view_show where city = '$city' and start_time = '$time1' limit $limit,5";
				$shows = $model->findBySql($sql)->asArray()->all();
			}
		}
		Yii::$app->session['limit'] += 5; 
		foreach($shows as $k => $v)
		{
			$a[] = "<div class='zlbox'>
				<a href='?r=show/detail&showid=".$shows[$k]['showid']."'><img data-original='".$shows[$k]['cover']."' class='thumb' style='display: inline-block;' src='".$shows[$k]['cover']."'></a>
				<p class='justify ms-txt'>".$shows[$k]['title']."
				</p>
				<p class='place'>".$shows[$k]['city'].',结束于'.date('d-m-Y',$shows[$k]['end_time'])."</p>
			</div>";
		}
		echo json_encode($a);
	}

	
}


?>