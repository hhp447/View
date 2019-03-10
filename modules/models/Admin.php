<?php
namespace app\modules\models;

use Yii;
use yii\db\ActiveRecord;

class Admin extends ActiveRecord
{
	//记住我
	//$rememberMe = true;



	public function rules()
	{
		return [
			['adminuser','required','message' => '管理员账号不能为空','on' => ['log','reg']],
			['adminuser','unique','message' => '管理员账号已存在','on' => ['reg']],
			['adminuser','required','message' => '管理员账号不能为空','on' => ['log','reg']],
			['adminemail','required','message' => '管理员邮箱不能为空','on' => ['reg']],
			['adminemail','email','message' => '管理员邮箱格式不正确','on' => ['reg']],
			['adminpass','validatePass','on' => ['log']],//验证账号密码是否正确的方法
			//记住我['rememberMe','boolean'],
		];
	}






	public function validatePass()
	{
		if(!$this->hasErrors())
		{
			$data = self::find()->where('adminuser = :user and adminpass = :pass',[':user' => $this->adminuser,':pass' => md5($this->adminpass)])->one();
			if(is_null($data))
			{
				$this->addError('adminpass','用户名或者密码错误');
			}
		}
	}







	public static function tableName()
	{
		return "{{%admin}}";
	}






 
	public function login($data)//管理员登录方法
	{
		$this->scenario = "log";
		if($this->load($data) && $this->validate())
		{
			//将用户信息写入到session中

			//记住我保存时间
			$lifetime = 2*3600;
			$session = Yii::$app->session;
			session_set_cookie_params($lifetime);
			$session['admin'] = [ 
				'adminuser' => $this->adminuser,
				'isLogin' => 1,
			];
			$this->updateAll(['logintime' => time(),'loginip' => ip2long(Yii::$app->request->userIP)],'adminuser = :user',[':user' => $this->adminuser]);
			return (bool)$session['admin']['isLogin'];
		}
		return false;
	}


	public function reg($data)//注册方法
	{
		$this->scenario = "reg";
		if($this->load($data) && $this->validate())
		{
			$this->adminpass = md5($data['Admin']['adminpass']);
			$this->createtime = time();
			if ($this->save(false)) {
                return true;
            }
            return false;
		}
		return false;
	}






}





?>