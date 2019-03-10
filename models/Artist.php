<?php
namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class Artist extends ActiveRecord
{

	const AK = 'h3rH6KmlQ4FFCVjO83jtWvzUQRym8xJ087OCY8-x';
    const SK = 'FnLyFSbmerkMYSZX1FwvneEN9TFwPR4xWoBtfDx8';
    const DOMAIN = 'ooc0eu4ky.bkt.clouddn.com';
    const BUCKET = 'shop';


	public static function tableName()
	{
		return "{{%artist}}";
	}

	public function rules()
	{
		return [
			['name','required','message' => '姓名不能为空'],
			['identity','required','message' => '身份/职业不能为空'],
			['cover','required','message' => '封面照片不能为空'],
		];
	}

	public function reg($data)//新增方法
	{
		if($this->load($data) && $this->validate())
		{
			$this->createtime = time();
			$this->career = $data['Artist']['career'];
			$this->abc = $data['Artist']['abc'];
			$this->introduction = $data['Artist']['introduction'];
			$this->pics = $data['Artist']['pics'];
			if ($this->save(false)) {
                return true;
            }
            return false;
		}
		return false;
	}

}
?>