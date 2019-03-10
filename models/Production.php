<?php
namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class Production extends ActiveRecord
{
	public static function tableName()
	{
		return "{{%production}}";
	}
}
?>