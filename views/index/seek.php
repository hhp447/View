<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>登陆注册</title>
		<link rel="stylesheet" href="assets/css/loginr.css" />
	</head>

	<body>
		<div class="wrap">
			<div class="bg"></div>
			<div class="login-logo">
				<img src="assets/img/images/loginlogo_03.png" />
			</div>
			<div class="tabs-underline">
				<ul>
					<li>
						<a class="tab-active" data-index="0" href="#">找回密码</a>
					</li>
					<!-- <li>
						<a data-index="1" href="#">注册</a>
					</li> -->
				</ul>
				<div class="tabs-content-placeholder">


					
					<div class="tab-content-active divnone">
					<?php $form = ActiveForm::begin([
						"action" => "?r=index/seekpass",
						"fieldConfig" => [
							"template" => "{input}{error}",
						],
					]); ?>
					<?php
					if(Yii::$app->session->hasFlash('info')){
						echo Yii::$app->session->getFlash('info');
					}
					?>
					<?php echo $form->field($model, 'username')->textInput(["placeholder" => "您的用户名"]); ?>
					<?php echo $form->field($model, 'useremail')->textInput(["placeholder" => "您的电子邮箱"]); ?>
						<a href = "<?php echo yii\helpers\Url::to(['index/loginre']);	 ?>">返回登陆</a>
						<?php echo Html::submitButton('找回密码',['class' => 'btn']); ?>
					<?php ActiveForm::end(); ?>
					</div>
					


					<!-- <div class="divnone">
						<input type="email" name="eadress" placeholder="请输入用于登录的邮箱地址">
						<input type="text" placeholder="您的用户名" />
						<input type="password" placeholder="请输入密码" />
						<input type="password" placeholder="请再一次输入密码" />
						<input type="submit" class="btn" value="注册"></input>
					</div> -->
				</div>
			</div>
		</div>
		<script>
			window.jQuery || document.write('<script src="assets/js/jquery-2.2.3.min.js"><\/script>')
		</script>
		<script src="assets/js/lor.js"></script>
	</body>

</html>