<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>艺术资讯</title>
		<link rel="stylesheet" href="assets/css/common.css">
		<link rel="stylesheet" href="assets/css/zx.css" />		
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
		<div class="zx-content clearfloat">
			<div class="row zx-row">
			<?php foreach($data['three'] as $three): ?>
				<div class="col-4">
					<a href="<?php echo yii\helpers\Url::to(['news/detail','newid' => $three->newid]); ?>">
					<img src="<?php echo $three->cover; ?>" /></a>
					<a href="<?php echo yii\helpers\Url::to(['news/detail','newid' => $three->newid]); ?>">
					<p class="zxtxt"><?= $three->title; ?></p>
					</a>
					<hr />
					<a href="<?php echo yii\helpers\Url::to(['news/detail','newid' => $three->newid]); ?>">
					<p class="zxtime"><?= date('Y-m-d H:m:s',$three->createtime); ?></p>
					</a>
				</div>
			<?php endforeach; ?>
			</div>
		</div>
		
		<div id="donate_carousel">
			<ul class="donate_bar">
			<?php $i = 1;?>
			<?php foreach($data['all'] as $all):  ?>
				<li class="tb"> 
					<em class="num"><?= $i; ?></em>
				<a href="<?php echo yii\helpers\Url::to(['news/detail','newid' => $all->newid]); ?>">
				<span class="zx-tit"><?= $all->title; ?></span>
				</a>
				<span class="zx-time"><?= date('Y-m-d H:m:s',$all->createtime); ?></span>
				<a href="<?php echo yii\helpers\Url::to(['news/detail','newid' => $all->newid]); ?>"><img src="assets/img/zl-arrow.png" /></a>
				</li>
				<?php $i++;?>
			<?php endforeach;  ?>
				
			</ul>
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
		<!--</div>-->
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
			$.fn.extend({
				Scroll: function(opt, callback) {
					//参数初始化
					if(!opt) var opt = {};
					var _this = this.eq(0).find("ul.donate_bar:first");
					var lineH = _this.find("li:first").height(), //获取行高
						line = opt.line ? parseInt(opt.line, 10) : parseInt(this.height() / lineH, 10), //每次滚动的行数，默认为一屏，即父容器高度
						speed = opt.speed ? parseInt(opt.speed, 10) : 500, //卷动速度，数值越大，速度越慢（毫秒）
						timer = opt.timer ? parseInt(opt.timer, 10) : 3000; //滚动的时间间隔（毫秒）

					if(line == 0) line = 1;
					var upHeight = 0 - line * lineH;
					//滚动函数
					scrollUp = function() {
						_this.animate({
								marginTop: upHeight
						}, speed, function() {
							for(i = 1; i <= line; i++) {
								_this.find("li:first").appendTo(_this);
							}
							_this.css({
								marginTop: 18
							});
						});
					}
					//鼠标事件绑定
					_this.hover(function() {
						clearInterval(timerID);
					}, function() {
						timerID = setInterval("scrollUp()", timer);
					}).mouseout();
				}
			})
			$(function() {
				$('#donate_carousel').Scroll({
					line: 1,
					speed: 800,
					timer: 2000
				});
			});
		</script>
	</body>

</html>