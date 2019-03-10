<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>资讯详细页</title>
		<link rel="stylesheet" href="assets/css/common.css">
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
		<!--nav end-->
		<div class="xx-contain clearfloat">
			<div class="zxxx-left">
				<div class="zxxx-left">
				<h3><?= $new->title; ?></h3>
				<p class="author">
					<span class="xx-time"><?= date('Y-m-d H:m:s',$new->createtime); ?></span>
					<span class="xx-au">作者：<?= $new->author; ?></span>
					<span class="xx-au">浏览次数：<?= $new->num; ?></span>
				</p>
				<div class="txt">
				<?= $new->content; ?>
				</div>
			</div>
			</div>
			<div class="zxxx-rt">
				<!-- <div class="xx-box box1">
					<img src="assets/img/zxxx01.png" />
					<p class="sp">麦克斯·霍珀·施奈德 《意外标本间》</p>
				</div> -->
				<?php foreach((array)json_decode($new->pics) as $k => $pic):  ?>
				<div class="xx-box">
					<img src="http://<?php echo $pic;  ?>" />
					<!-- <p class="sp">麦克斯·霍珀·施奈德 《意外标本间》</p> -->
				</div>
				<?php endforeach;?>
			</div>
		</div>
		<div id="backtotop" class="xx-totop">
			<img src="assets/img/totop.png" />
			<p>返回顶部</p>
		</div>
		
		
		<footer>
			<div class="today-art clearfloat">
				<div class="dingyue">
					<p>订阅每期艺术资讯</p>
					<input placeholder="请输入邮箱地址" />
					<button class="btn-dy"><img src="assets/img/foot-ar.png"></button>
				</div>
				<!--
			-->
				<div class="contact">
					<a class="con-us">联系我们</a>
					<br />
					<a class="email">邮箱:664727359@qq.com</a>
				</div>
			</div>
		</footer>
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
			$(document).ready(function(){
				$.post("<?php echo yii\helpers\Url::to(['news/addnum']); ?>",{"newid":"<?= $new->newid;?>","<?PHP echo Yii::$app->request->csrfParam;?>":"<?php echo yii::$app->request->csrfToken?>"},function(data){
					alert(data);
				},'json');
			});
		</script>
		<script src="assets/js/zxxx.js"></script>
	</body>
</html>
