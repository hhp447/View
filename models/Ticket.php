<?php
namespace app\models;
use yii\db\ActiveRecord;
use Yii;

class Ticket extends ActiveRecord
{
	public static function tableName()
	{
		return "{{%ticket}}";
	}

	public function rules()
	{
		return [
			['email','required','message' => '电子邮件不能为空'],
			['email','email','message' => '电子邮件格式不正确'],
			/*['showid','validateshow']*/
		];
	}

	/*public function validateshow()
	{
		if(!$this->hasErrors())
		{
			$data = self::find()->where('showid = :show and userid = :user',[':show' => $this->showid,':user' => $this->userid])->one();
			if(is_null($data))
			{
				$this->addError('showid','您已经报名过了');
			}
		}
	}*/

	public function add($data)//报名参加展览
	{
		if($this->load($data) && $this->validate())
		{
			$this->createtime = time();
			$this->userid = $data['Ticket']['userid'];
			$this->showid = $data['Ticket']['showid'];
			if($this->save(false))
			{
				return true;
			}
			return false;
		}
		return false;

	}

}


?>