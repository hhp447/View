<?php
namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class Careart extends ActiveRecord
{
	public static function tableName()
	{
		return "{{%careart}}";
	}
}
?>