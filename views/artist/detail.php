<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>艺术家</title>
		<link rel="stylesheet" href="assets/css/common.css" />
		<link rel="stylesheet" href="assets/css/ysj.css">
		<link rel="stylesheet" href="assets/css/zl.css" />
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
		
		<div class="art">
			<div class="headimg">
				<img src="<?= $art->cover; ?>" class="arthead" />
				<span class="position"><?= $art->identity; ?></span>
				<span class="name"><?= $art->name; ?></span>
			</div>
				<?php
					if(Yii::$app->session->hasFlash('info'))
					{
						echo Yii::$app->session->getFlash('info');
					}

				?>
				<a href="<?= yii\helpers\Url::to(['artist/know','artistid' => $art->artistid]); ?>">				
				<button><strong>+</strong>关注</button></a>

			<div class="art-chose">
				<a href="#" class="active" data-index="0">简介</a>
				<a href="#" data-index="1">生平</a>
				<a href="#" data-index="2">作品</a>
				<a href="#" data-index="3">展览信息</a>
				<!-- <a href="<?= yii\helpers\Url::to(['artist/know','artist' => $art->artistid]); ?>">				
				<button><strong>+</strong>关注</button></a> -->
 				
			</div>

			<div class="artbox">
			<div id="jianjie" class="box boxactive">



				<!-- <p class="LiN"><span>建筑理念</span></p>
				<p class="linian">格罗皮乌斯针对当时的建筑造型复杂而华丽，同时又无法适应工业化大批量生产的情况，提出了他崭新的设计要求：既是艺术的又是科学的，既是设计的又是实用的，同时还能够在工厂的流水线上大批量生产制造。为此，与传统学校不同，在格罗皮乌斯的学校里，学生们不但要学习设计、造型、材料，还要学习绘图、构图、制作，于是，国立建筑工艺学校拥有着一系列的生产车间：木工车间、砖石车间、钢材车间、陶瓷车间等等，学校里没有“老师”和“学生”的称谓，师生彼此称之为“师傅”和“徒弟”。

					<p class="linian">他引导学生如何认识周围的一切：颜色、形状、大小、纹理、质量；他教导学生如何既能符合实用的标准，又能独特地表达设计者的思想；他还告诉学生如何在一定的形状和轮廓里使一座房屋或一件器具的功用得到最大的发挥。其教学为国立建筑工艺学校带来了以几何线条为基本造型的全新设计风格。学校设计的工厂不再有任何装饰，厂房为四方形，平平的房顶、楼身除支柱外全部用金属板搭构，外镶大块的玻璃，简洁而敞亮，完全适于生产的需要。格罗皮乌斯让他的学生学会了用最简单的方形、长方形、正方形、圆形赢得设计样式和风格的现代感。</p>
				</p>
				<p class="LiN style"><span>建筑风格</span></p>
				<p class="linian">设计讲究充分的采光和通风，主张按空间的用途、性质、相互关系来合理组织和布局，按人的生理要求、人体尺度来确定空间的最小极限等。</p>
				<p class="linian">他还积极提倡建筑设计与工艺的统一，艺术与技术的结合，讲究功能、技术和经济效益。</p>
 -->

				<!-- <p class="LiN"><span>个人简介</span></p>
				<p class = "linian"> -->
				<?= $art->introduction; ?>
				<!-- </p>
				<p class = "linian">
				<?= $art->introduction; ?>
				</p>
				<p class = "linian">
				<?= $art->introduction; ?>
				</p> -->



			</div>
			<div id="splive" class="box" style="height: 900px;">				
				<div class="art-left">	


					<!-- <?= $art->career; ?> -->
				<!-- <div class="life clearfloat">
					<span class="year">1883,5,18</span>
					<span class="thing">生于德国柏林</span>
				</div>
				<div class="life clearfloat">
					<span class="year">1907—<br />
                		1910</span>
					<span class="thing">在柏林建筑师P·贝伦斯的建筑事务所任职</span>
				</div>
				<div class="life clearfloat">
					<span class="year">1910—<br />
                		1914</span>
					<span class="thing">自己开业，同A·迈耶合作设计了他的两座成名作：“法古斯鞋楦厂”和1914年在科隆展览会展出的“示范工厂”和“办公楼”</span>
				</div>
				<div class="life clearfloat">
					<span class="year">1915</span>
					<span class="thing">在魏玛实用美术学校任教</span>
				</div>
				<div class="life clearfloat">
					<span class="year">1915</span>
					<span class="thing">任魏玛实用美术学校校长，将实用美术学校和魏玛美术学院合并成为专门培养建筑和工业日用品设计人才的学校，即公立包豪斯学校</span>
				</div>
				<div class="life clearfloat">
					<span class="year">1919</span>
					<span class="thing">原撒克逊大公美术学院和国家工艺美术学院合并，成立了国立建筑工艺学校”，36岁的格罗皮乌斯被任命为校长</span>
				</div>
				<div class="life clearfloat">
					<span class="year">1928</span>
					<span class="thing">同勒柯布西耶等组织国际现代建筑协会</span>
				</div>
				<div class="life clearfloat">
					<span class="year">1915</span>
					<span class="thing">任魏玛实用美术学校校长，将实用美术学校和魏玛美术学院合并成为专门培养建筑和工业日用品设计人才的学校，即公立包豪斯学校</span>
				</div>
				<div class="life clearfloat">
					<span class="year">1919</span>
					<span class="thing">原撒克逊大公美术学院和国家工艺美术学院合并，成立了国立建筑工艺学校”，36岁的格罗皮乌斯被任命为校长</span>
				</div>
				<div class="life clearfloat">
					<span class="year">1928</span>
					<span class="thing">同勒柯布西耶等组织国际现代建筑协会</span>
				</div>
				<div class="life clearfloat">
					<span class="year">1915</span>
					<span class="thing">任魏玛实用美术学校校长，将实用美术学校和魏玛美术学院合并成为专门培养建筑和工业日用品设计人才的学校，即公立包豪斯学校</span>
				</div>
				<div class="life clearfloat">
					<span class="year">1919</span>
					<span class="thing">原撒克逊大公美术学院和国家工艺美术学院合并，成立了国立建筑工艺学校”，36岁的格罗皮乌斯被任命为校长</span>
				</div>
				<div class="life clearfloat">
					<span class="year">1928</span>
					<span class="thing">同勒柯布西耶等组织国际现代建筑协会</span>
				</div>
 -->

 				<?= $art->career; ?>


				</div>	
			</div>
			<!--生平-->
			<div id="zuop" class="clearfloat box">
			<?php foreach((array)json_decode($art->pics) as $k => $pic):  ?>
				<div class="zpleft">
				<img src="http://<?= $pic; ?>" />							
				</div>
			<?php endforeach; ?>
				
			</div><!--作品-->
			<div id="zlxxi" class="wrapper box">	
			<?php foreach($shows as $show): ?>		
			<article class="panel">
			<a href="<?php echo yii\helpers\Url::to(['show/detail','showid' => $show->showid]);?>">
			<img src="<?php echo $show->cover; ?>" class="thumb" alt="Alex Gross">
			</a>
			<p class="justify ms-txt">
				<?= $show->smalltitle;?>
			</p>
			<p class="place"><?= $show->city.',结束于'.date('Y-m-d',$show->end_time);?></p>
			</article>
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
	
		<script src="assets/js/jquery-2.2.3.min.js"></script>
		
		<script src="assets/js/pinterest_grid.js"></script>
		<script>
			$(function() {
				$(".wrapper").pinterest_grid({
					no_columns: 4,
					padding_x: 20,
					padding_y: 20,
					margin_bottom: 50,
					single_column_breakpoint: 700
				});

			});
			$(document).ready(function() {
				var widget = $('.art');
				var tabs = widget.find('.art-chose a'),
				content = widget.find('.artbox > .box');;
				tabs.on('click', function(e) {
					e.preventDefault();
					var index = $(this).data('index');
					tabs.removeClass('active');
					content.removeClass('boxactive');
					$(this).addClass('active');
					content.eq(index).addClass('boxactive');
				});
			});
		</script>

	</body>
</html>
