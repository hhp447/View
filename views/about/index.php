<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\HTML;
?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>关于我们</title>
		<link rel="stylesheet" href="assets/css/common.css" />
	</head>

	<body>
		<div class="contain">
			<nav>
				<div class="logo-header">
					<a href="<?php echo yii\helpers\Url::to(['index/index']); ?>"><img src="assets/img/logo.png" /></a>
				</div>
				<ul class="nav-list clearfloat">
					<li class="item secarch">
						<form action="<?php echo yii\helpers\Url::to(['show/search']); ?>" method="post" name="search">
						<input type="text" class="search-control" name="searchtext">
						<input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
						<input type="image" src="assets/img/sealogo.png" onclick="javascript:document.forms['search'].submit();">
						</form>
					</li>
					<li class="item">
						<a href="<?php echo yii\helpers\Url::to(['show/index']); ?>">展览</a>
					</li>
					<li class="item day-art">
						<a href="<?php echo yii\helpers\Url::to(['artist/index']); ?>">艺术家</a>
					</li>
					<li class="item">
						<a href="<?php echo yii\helpers\Url::to(['news/index']); ?>">艺术资讯</a>
					</li>
					<li class="item about-us">
						<a href="<?php echo yii\helpers\Url::to(['about/index']); ?>">关于我们</a>
					</li>
					<li class="item">

						 <?php if (\Yii::$app->session['user']['isLogin'] == 1): ?>
			                <a href="<?php echo yii\helpers\Url::to(['user/index']); ?>">
			                 <?php echo \Yii::$app->session['user']['username']; ?> , </a><a href="<?php echo yii\helpers\Url::to(['index/logout']); ?>">退出</a>
			            <?php else: ?>
			                <a href="<?php echo yii\helpers\Url::to(['index/loginre']); ?>">登录</a>
			            <?php endif; ?>

						<!-- <a href="<?php echo yii\helpers\Url::to(['user/index']); ?>">登录</a>
						<img src="assets/img/arrow-down.png" class="loginimg"/>
						<div class="chose show">
							<a href="huiyuan.html">个人中心</a>
							<a href="huiyuan.html">系统通知</a>
							<a href="loginre.html">退出登录</a>
						</div> -->
					</li>
				</ul>
			</nav>
		</div>

		<div class="au-content">
			<img src="assets/img/aboutus.png" />
			<h2 class="abtxt">关于我们</h2>
			<div class="txt-de clearfloat">
				<span class="us">关于我们:</span>
				<span class="us-txt">1、view是一个发布关于展览信息以及艺术信息的网址，世界色彩纷呈，放下手机，走入一场展览，体会不一样的人生。
			<br />
			2、一个年轻的团队，带着一个充满诚意的作品想让你看见，我们的真诚，对待世界的独特的眼光，温和又激烈。
			</span>
			</div>
			<div class="txt-de clearfloat">
				<span class="us">联系我们:</span>
				<span class="us-txt">
					1、如果你想要与我们合作，请发送邮件到以上的联系方式。
			email：664727359@qq.com
			<br />
					2、倘若你有什么好建议，想要分享，或者有问题想要反馈，请联系我们，我们很乐意跟你交流。
			<br />

			<?php if(Yii::$app->session->hasFlash('info')){
				echo Yii::$app->session->getFlash('info');
				} ?>

			<?php $form = ActiveForm::begin([
				"fieldConfig" => [
					'template' => '{label}{input}{error}'
				]
			]);?>
			<?= $form->field($model,'name')->textInput(['class' => 'ab-name','placeholder' => '请输入您的名字']); ?>
			<?= $form->field($model,'phone')->textInput(['class' => 'abcontact','placeholder' => '请输入您的联系方式']); ?>
			<?= $form->field($model,'suggest')->textarea(['class' => 'option','cols' => '40','rows' => '15','placeholder' => '请输入您的意见反馈']); ?>
			<?= HTML::submitButton('提交',['class' => 'abbtn']); ?>
			<?php ActiveForm::end(); ?>
			
			</span>
			</div>
		</div>
		<script src="assets/js/jquery-2.2.3.min.js"></script>
		<script>
			$('.loginimg').click(function() {
				if($('.chose').hasClass('show')) {
					$('.chose').css('opacity', '1');
					$('.chose').removeClass('show');
				} else {
					$('.chose').css('opacity', '0');
					$('.chose').addClass('show');
				}

			});
		</script>
	</body>

</html>