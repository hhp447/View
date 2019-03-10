<?php
namespace app\modules\controllers;
use Yii;
use yii\web\Controller;
use app\modules\controllers\CommonController;
class RbacController extends CommonController
{
	public function actionIndex()
	{

		$auth = Yii::$app->authManager;
		//创建admin角色
		$admin = $auth->createRole('admin');
		$admin->description = 'admin';
		$auth->add($admin);
		//创建operator角色
		$operator = $auth->createRole('operator');
		$operator->description = 'operator';
		$auth->add($operator);
		//创建useroperator角色
		$useroperator = $auth->createRole('useroperator');
		$useroperator->description = 'useroperator';
		$auth->add($useroperator);

		// 并且建立好等级关系，admin是useroperator,operator的上司
		$auth->addChild($admin, $operator);
		$auth->addChild($admin, $useroperator);


		//创建新增展览、资讯、艺术家权限
		$createPost = $auth->createPermission('createPost');
		$createPost->description = "createPost";
		$auth->add($createPost);
		//创建更新展览、资讯、艺术家权限
		$updatePost = $auth->createPermission('updatePost');
		$updatePost->description = "updatePost";
		$auth->add($updatePost);
		//创建删除展览、资讯、艺术家权限
		$deletePost = $auth->createPermission('deletePost');
		$deletePost->description = "deletePost";
		$auth->add($deletePost);
		//创建新增用户权限
		$createUser = $auth->createPermission('createUser');
		$createUser->description = "createUser";
		$auth->add($createUser);
		//创建更新用户权限
		$updateUser = $auth->createPermission('updateUser');
		$updateUser->description = "updateUser";
		$auth->add($updateUser);
		//创建删除用户权限
		$deleteUser = $auth->createPermission('deleteUser');
		$deleteUser->description = "deleteUser";
		$auth->add($deleteUser);
		//为角色赋予权限
		$auth->addChild($operator, $createPost);
		$auth->addChild($operator, $updatePost);
		$auth->addChild($useroperator, $updateUser);
		$auth->addChild($useroperator, $createUser);
		$auth->addChild($admin, $deleteUser);
		$auth->addChild($admin, $deletePost);
		//为用户赋予角色
		$auth->assign($admin,10);
		$auth->assign($operator,11);
		$auth->assign($useroperator,12);




	}
}