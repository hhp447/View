<?php
namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class Notify extends ActiveRecord
{
	public static function tableName()
	{
		return "{{%notify}}";
	}
}
?>