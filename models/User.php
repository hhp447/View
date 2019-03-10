<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class User extends ActiveRecord
{

	const AK = 'h3rH6KmlQ4FFCVjO83jtWvzUQRym8xJ087OCY8-x';
    const SK = 'FnLyFSbmerkMYSZX1FwvneEN9TFwPR4xWoBtfDx8';
    const DOMAIN = 'ooc0eu4ky.bkt.clouddn.com';
    const BUCKET = 'shop';

	public $userrepass;
	public $newuserpass;
	public $newuserrepass;
	public static function tableName()
	{
		return "{{%user}}";
	}





	public function rules()
	{
		return [
			['useremail','required','message'=>'邮箱不能为空','on' => ['reg','seekpass']],
			['useremail','email','message' => '邮箱格式不正确','on' => ['reg','seekpass']],
			['useremail','unique','message' => '该邮箱已经存在','on' => ['reg']],
			['username','unique','message' => '该用户名已经存在','on' => ['reg']],
			['username','required','message' => '用户名不能为空','on' => ['reg','log','seekpass','changepass']],
			['userpass','required','message' => '密码不能为空','on' => ['reg','log','changepass','change_pass']],
			['userrepass','required','message' => '确认密码不能为空','on' => ['reg','changepass']],
			['userpass','validatePass','on' => ['log','change_pass']],
			['useremail','validateEmail','on' => 'seekpass'],
			['userrepass', 'compare', 'compareAttribute' => 'userpass', 'message' => '两次密码输入不一致', 'on' => ['reg','changepass']],
			['newuserrepass', 'compare', 'compareAttribute' => 'newuserpass', 'message' => '两次密码输入不一致', 'on' => 'change_pass'],
			['newuserpass','required','message' => '新密码不能为空','on'=>'change_pass'],
			['newuserrepass','required','message' => '确认密码不能为空','on' => 'change_pass']
		];
	}


	public function validatePass()
	{
		if(!$this->hasErrors())
		{
			$data = self::find()->where('username = :name and userpass = :pass',[':name' => $this->username,':pass' => md5($this->userpass)])->one();
			if(is_null($data))
			{
				$this->addError('userpass','用户名或者密码不正确');
			}
		}
	}

	public function validateEmail()
    {
        if (!$this->hasErrors()) {
            $data = self::find()->where('username = :name and useremail = :email', [':name' => $this->username, ':email' => $this->useremail])->one();
            if (is_null($data)) {
                $this->addError("useremail", "用户名和电子邮箱不匹配");        
            }
        }
    }



	public function attributeLabels()
	{
		return [
			'photo' => '',
			'username' => '用 户 名',
			'useremail' => '电子邮件',
			'nickname' => '个人昵称',
			'truename' => '真实姓名',
			'phone' => '手机号码',
			'introduction' => '个人简介',
			'userpass' => '',
			'newuserpass' => '',
			'newuserrepass' => ''
		];
	}




	public function reg($data)//注册方法
	{
		$this->scenario = "reg";
		if($this->load($data) && $this->validate())
		{
			$this->userpass = md5($this->userpass);
			$this->createtime = time();
			if ($this->save(false)) {
                return true;
            }
            return false;
		}
		return false;
	}


	public function ud($data)//修改个人信息方法
	{
		$this->scenario = "ud";
		if($this->load($data))
		{
			if ($this->save(false)) {
                return true;
            }
            return false;
		}
		return false;
	}




	public function log($data)//登录方法
	{
		$this->scenario = "log";
		if($this->load($data) && $this->validate())
		{
			//将用户信息写入到session中

			//记住我保存时间
			$lifetime = 24*3600;
			$session = Yii::$app->session;
			session_set_cookie_params($lifetime);
			$session['user'] = [ 
				'username' => $this->username,
				'isLogin' => 1,
			];
			$this->updateAll(['lastlogin' => time()],'username = :name',[':name' => $this->username]);
			return (bool)$session['user']['isLogin'];
		}
		return false;
	}

	public function findshow($name)
	{
		$username = $name;
		$data = self::find()->where('username = :name',[':name' => $username])->one();
		$userid = $data->userid;
		$show = Careshow::find()->where('userid = :id',[':id' => $userid])->all();
		$shows = [];
		foreach ($show as $value)
		{
			$showid = $value->showid;
			$shows[] = Show::find()->where('showid = :id',[':id' => $showid])->one();
		}
		return $shows;
	}


	public function findart($name)
	{
		$username = $name;
		$data = self::find()->where('username = :name',[':name' => $username])->one();
		$userid = $data->userid;
		$art = Careart::find()->where('userid = :id',[':id' => $userid])->all();
		$arts = [];
		foreach ($art as $value)
		{
			$artid = $value->artistid;
			$arts[] = Artist::find()->where('artistid = :id',[':id' => $artid])->one();
		}
		return $arts;
	}

	public function findticket($name)
	{
		$username = $name;
		$data = self::find()->where('username = :name',[':name' => $username])->one();
		$userid = $data->userid;
		$ticket = Ticket::find()->where("userid =:id",[':id' => $userid])->orderBy('createtime DESC')->all();
		$tickets = [];
		foreach ($ticket as $value)
		{
			$showid = $value->showid;
			$tickets[] = Show::find()->where('showid = :id',[':id' => $showid])->one();
		}
		return $tickets;
	}

	public function findnotify($name)
	{
		$username = $name;
		$data = self::find()->where('username = :name',[':name' => $username])->one();
		$userid = $data->userid;
		$notify = Notify::find()->where('userid = :id',[':id' => $userid])->orderBy("createtime DESC")->all();
		return $notify;
	}

	public function seekPass($data)
    {
        $this->scenario = "seekpass";
        if ($this->load($data) && $this->validate()) {
            //做点有意义的事
            $time = time();
            $token = $this->createToken($data['User']['username'], $time);
            $mailer = Yii::$app->mailer->compose('seekpass', ['username' => $data['User']['username'], 'time' => $time, 'token' => $token]);
            $mailer->setFrom("13640125767@163.com");
            $mailer->setTo($data['User']['useremail']);
            $mailer->setSubject("view展网-找回密码");
            if ($mailer->send()) {
                return true;
            }
        }
        return false;
    
    }

    public function changePass($data) 
    {
        $this->scenario = "changepass";
        if ($this->load($data) && $this->validate()) {
            return (bool)$this->updateAll(['userpass' => md5($this->userpass)], 'username = :user', [':user' => $this->username]);
        }
        return false;
    }



    public function createToken($username, $time)
    {
        return md5(md5($username).base64_encode(Yii::$app->request->userIP).md5($time));
    }



    public function change_Pass($data) 
    {
        $this->scenario = "change_pass";
        if ($this->load($data) && $this->validate()) {
            return (bool)$this->updateAll(['userpass' => md5($this->newuserpass)], 'username = :user', [':user' => $this->username]);
        }
        return false;
    }





}


?>