<?php
namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class Suggestion extends ActiveRecord
{
	public static function tableName()
	{
		return "{{%suggestion}}";
	}

	public function rules()
	{
		return [
			['suggest','required','message' => '意见反馈不能为空'],
			['name','required','message' => '姓名不能为空'],
			['phone','required','message' => '联系方式不能为空'],
		];
	}

	public function add($data)
	{
		if($this->load($data) && $this->validate())
		{
			$this->createtime = time();
			return (bool)$this->save();
		}
		return false;
	}


}
?>