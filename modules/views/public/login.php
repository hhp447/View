<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>后台登录</title>
		<link rel="stylesheet" href="assets/admin/css/login.css" />
	</head>
	<body>
		<div class="wrap">
			<div id='stars'></div>
<div id='stars2'></div>
<div id='stars3'></div>
			<div class="bg"></div>
			
			<div class="login-logo">
				<img src="assets/admin/img/logo.png" />
			</div>
			<div class="tabs-underline">
				<ul>
					<li>
						view--后台登录
					</li>
					<!-- <li>
						<a data-index="1" href="#">超级管理员</a>
					</li> -->
				</ul>
				<div class="tabs-content-placeholder">
					<?php $form = ActiveForm::begin([
						'action' => "?r=admin/public/login",
						"fieldConfig" => [
							'template' => '{input}{error}'
						]
					]); ?>
					<div class="tab-content-active divnone">
						<?php echo $form->field($model,'adminuser')->textInput(['placeholder' => '您的用户名']); ?>
						<?php echo $form->field($model,'adminpass')->passwordInput(['placeholder' => '请输入密码']); ?>
						<?= Html::submitButton('登录',['class' => 'btn']); ?>
					<?php ActiveForm::end(); ?>
					</div>
					<!-- <div class="divnone">
						<input type="text" placeholder="您的用户名" />
						<input type="password" placeholder="请输入密码" />
						<input type="submit" class="btn" value="登录"></input>
					</div> -->
				</div>
			</div>
		</div>
		<script src="assets/admin/js/jquery-2.2.3.min.js"></script>
		<script src="assets/admin/js/login.js"></script>
	</body>
</html>
