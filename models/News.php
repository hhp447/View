<?php
namespace app\models;
use yii\db\ActiveRecord;

class News extends ActiveRecord
{

	const AK = 'h3rH6KmlQ4FFCVjO83jtWvzUQRym8xJ087OCY8-x';
    const SK = 'FnLyFSbmerkMYSZX1FwvneEN9TFwPR4xWoBtfDx8';
    const DOMAIN = 'ooc0eu4ky.bkt.clouddn.com';
    const BUCKET = 'shop';
	public static function tableName()
	{
		return "{{%news}}";
	}


	public function rules()
	{
		return [
			['title','required','message' => '标题不能为空'],
			['content','required','message' => '内容不能为空'],
			['author','required','message' => '作者不能为空'],
		];
	}


	public function reg($data)//新增方法
	{
		if($this->load($data) && $this->validate())
		{
			$this->createtime = time();
			$this->cover = $data['News']['cover'];
			$this->pics = $data['News']['pics'];
			if ($this->save(false)) {
                return true;
            }
            return false;
		}
		return false;
	}

}

?>