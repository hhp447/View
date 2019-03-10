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
						<a class="tab-active" data-index="0" href="#">修改密码</a>
					</li>
				</ul>
				<div class="tabs-content-placeholder">
					<div class="tab-content-active divnone">
					<?php $form = ActiveForm::begin([
						"fieldConfig" => [
							"template" => "{input}{error}",
						],
					]); ?>
					<?php
					if(Yii::$app->session->hasFlash('info')){
						echo Yii::$app->session->getFlash('info');
					}
					?>
					<?php echo $form->field($model, 'username')->hiddenInput(); ?>
					<?php echo $form->field($model, 'userpass')->passwordInput(["placeholder" => "新密码"]); ?>
	                <?php echo $form->field($model, 'userrepass')->passwordInput(["placeholder" => "确认密码"]); ?>
	                <a href="<?php echo yii\helpers\Url::to(['index/loginre']); ?>" class="forgot">返回登录</a>
					<?php echo Html::submitButton('修改密码',['class' => 'btn']); ?>
					<?php ActiveForm::end(); ?>
					</div>
				</div>
			</div>
		</div>
		<script>
			window.jQuery || document.write('<script src="assets/js/jquery-2.2.3.min.js"><\/script>')
		</script>
		<script src="assets/js/lor.js"></script>
	</body>

</html>