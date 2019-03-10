<?php
namespace app\models;

use yii\db\ActiveRecord;

class Show extends ActiveRecord
{

	const AK = 'h3rH6KmlQ4FFCVjO83jtWvzUQRym8xJ087OCY8-x';
    const SK = 'FnLyFSbmerkMYSZX1FwvneEN9TFwPR4xWoBtfDx8';
    const DOMAIN = 'ooc0eu4ky.bkt.clouddn.com';
    const BUCKET = 'shop';


	public static function tableName()
	{
		return "{{%show}}";
	}



	public function rules()
	{
		return [
			['smalltitle','required','message' => '小标题不能为空'],//input
			['title','required','message' => '标题不能为空'],//input
			['introduction','required','message' => '展览简介不能为空'],//textarea
			['pay','required','message' => '入场费用不能为空'],//input
			['pay','integer','message' => '入场费用必须为数字'],//input
			['start_time','required','message' => '展览开始时间不能为空'],//3个表单input年input月input日
			['end_time','required','message' => '展览结束时间不能为空'],//3个表单input年input月input日
			['day_time','required','message' => '每天开放时间不能为空'],//input
			['city','required','message' => '展览城市不能为空'],//input
			['place','required','message' => '地点不能为空'],//input
			['artistid','required','message' => '有关艺术家不能为空'],//input
		];
	}



	public function findshow($time = 0,$city = 0)
	{
		if(!$time)        //没给时间
		{
			if(!$city)   //没给时间没给地点
			{
				$data = self::find()->orderBy('start_time ASC')->limit(5)->all();
			}else         //没给时间有给地点
			{
				$data = self::find()->where('city = :city',[':city' => $city])->orderBy('start_time ASC')->limit(5)->all();
			}
		}else             //有给时间
		{
			$time1 = strtotime($time);
			if(!$city)   //有给时间没给地点
			{
				$data = self::find()->where('start_time = :time',[':time' => $time1])->orderBy('start_time ASC')->limit(5)->all();
			}else         //有给时间有给地点
			{
				$data = self::find()->where('start_time = :time and city = :city',[':time' => $time1,':city' => $city])->orderBy('start_time ASC')->limit(5)->all();
			}
		}
		
		return $data;
	}



	public function reg($data)//新增方法
	{
		if($this->load($data) && $this->validate())
		{
			$this->createtime = time();
			$this->cover = $data['Show']['cover'];
			$this->pics = $data['Show']['pics'];
			$this->sponsor = $data['Show']['sponsor'];
			$this->start_time = strtotime($data['Show']['start_time']);
			$this->end_time = strtotime($data['Show']['end_time']);
			if ($this->save(false)) {
                return true;
            }
            return false;
		}
		return false;
	}


	
}





?>