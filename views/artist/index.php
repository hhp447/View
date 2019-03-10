<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>每日艺术</title>
		<link rel="stylesheet" href="assets/css/common.css" />
		<link rel="stylesheet" href="assets/css/art.css" />
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
			                 <?php echo \Yii::$app->session['user']['username']; ?> , </a>
			                 <a href="<?php echo yii\helpers\Url::to(['index/logout']); ?>">退出</a>
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
		<!--content-->
		<div id="content">
			<div id="lista2" class="als-container">
				<span class="als-prev"><img src="assets/img/artardown.png" alt="prev" title="previous" /></span>
				<div class="als-viewport">
					<div class="als-wrapper">


						<?php foreach($model as $k => $art): ?>
						<div class="als-item">
						<a href="<?php echo yii\helpers\Url::to(['artist/detail','artistid' => $art->artistid]); ?>">
						<img src="<?php echo $art->cover; ?>" alt="" title="" />
						</a>
							<div class="artist-txt">
								<p class="name"><a href="<?php echo yii\helpers\Url::to(['artist/detail','artistid' => $art->artistid]); ?>"><span><?php echo $art->name; ?></span></a></p>
								<p class="txt"><?php echo $art->identity; ?></p>
							</div>
						</div>
						<?php endforeach; ?>
						

					</div>
				</div>
				<span class="als-next"><img src="assets/img/artarrow.png" alt="next" title="next" /></span>
			</div>
		</div>
		<div class="artist clearfloat">



			<div class="at clearfloat at1">
				<div class="at-left clearfloat">
					<div class="left-box">
						<a href="<?php echo yii\helpers\Url::to(['artist/detail','artistid' => 6]); ?>">
						<img src="assets/img/artist03.png" /></a>
						<p class="txt">20世纪最著名的建筑大师、城市规划家和作家</p>
						<p class="name sp">勒·柯布西耶</p>
					</div>
				</div>
				<div class="at-right clearfloat">
					<div class="rt-box">
						<a href="<?php echo yii\helpers\Url::to(['artist/detail','artistid' => 3]); ?>">
						<img src="assets/img/artist0123.jpg" /></a>
						<p class="name">阿布雷特•丢勒</p>
						<p class="txt sp">德国画家、及木版画设计家,文艺复兴的代表人物</p>
					</div>
				</div>
			</div>
			<div class="at clearfloat at2">
				<div class="at-left clearfloat">
					<div class="left-box">
						<a href="<?php echo yii\helpers\Url::to(['artist/detail','artistid' => 4]); ?>">
						<img src="assets/img/artist05.png" /></a>
						<p class="txt">意大利文艺复兴后期威尼斯画派的代表画家</p>
						<p class="name sp">提香·韦切利</p>
					</div>
				</div>
				<div class="at-right clearfloat">
					<div class="rt-box">
						<a href="<?php echo yii\helpers\Url::to(['artist/detail','artistid' => 5]); ?>">
						<img src="assets/img/artist06.png" /></a>
						<p class="txt">德国建筑师，也是最著名的现代主义建筑大师之一</p>
						<p class="name sp" style="left: 320px;">路德维希·密斯·凡德罗</p>
					</div>
				</div>
			</div>
			<div class="artist-list">
				<h2>艺术家检索</h2>
				<ul class="abc clearfloat">
					<li class="A"><a>A</a></li>
					<li class="B"><a>B</a></li>
					<li class="C"><a>C</a></li>
					<li class="D"><a>D</a></li>
					<li class="E"><a>E</a></li>
					<li class="F"><a>F</a></li>
					<li class="G"><a>G</a></li>
					<li class="H"><a>H</a></li>
					<li class="I"><a>I</a></li>
					<li class="J"><a>J</a></li>
					<li class="K"><a>K</a></li>
					<li class="L"><a>L</a></li>
					<li class="M"><a>M</a></li>
					<li class="N"><a>N</a></li>
					<li class="O"><a>O</a></li>
					<li class="P"><a>P</a></li>
					<li class="Q"><a>Q</a></li>
					<li class="R"><a>R</a></li>
					<li class="S"><a>S</a></li>
					<li class="T"><a>T</a></li>
					<li class="U"><a>U</a></li>
					<li class="V"><a>V</a></li>
					<li class="W"><a>W</a></li>
					<li class="S"><a>S</a></li>
					<li class="Y"><a>Y</a></li>
					<li class="Z"><a>Z</a></li>
				</ul>
				<div class="fff">

				<?php foreach($arts as $art): ?>
				<div id="<?= $art[0]->abc; ?>" class="abcbox clearfloat">
					<h3><span><?= $art[0]->abc; ?></span></h3>
					<ul class="left clearfloat">
					<?php foreach($art as $a): ?>
						<li><a href="<?= yii\helpers\Url::to(['artist/detail','artistid' => $a->artistid]); ?>"><?= $a->name;?> </a></li>
					<?php endforeach; ?>
					</ul>
				</div>
				<?php endforeach; ?>

				</div>
			</div>
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

		<script type="text/javascript" src="assets/js/jquery-2.2.3.min.js"></script>
		<!--<script src="assets/js/sy.js"></script>-->
		<script type="text/javascript" src="assets/js/jquery.als-1.7.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$("#lista2").als({
					visible_items: 1,
					scrolling_items: 1,
					orientation: "vertical",
					circular: "no",
					autoscroll: "no",
					start_from: 5
				});
			});
			$('.loginimg').click(function() {
				if($('.chose').hasClass('show')) {
					$('.chose').css('opacity', '1');
					$('.chose').removeClass('show');
				} else {
					$('.chose').css('opacity', '0');
					$('.chose').addClass('show');
				}

			});


			$("li").click(function(){
				//alert("22");
				/*$(".fff").html("111");*/
				var a = $(this).attr('class');
				$.post("<?php echo yii\helpers\Url::to(['artist/find_art']); ?>",{
					"<?PHP echo Yii::$app->request->csrfParam;?>":"<?php echo yii::$app->request->csrfToken?>",
					"abc":a,
				},function(data){
					$(".fff").html(data);
				},"json")
			});


		</script>
	</body>

</html>