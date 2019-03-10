<?php
namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class Careshow extends ActiveRecord
{
	public static function tableName()
	{
		return "{{%careshow}}";
	}
}
?>