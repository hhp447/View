<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>首页</title>
		<link rel="stylesheet" href="/assets/css/animate.css" />
		<link rel="stylesheet" href="assets/css/common.css" >
		<link rel="stylesheet" href="assets/css/style.css">
		<!--[if IE]>
		<script src="assets/http://libs.useso.com/js/html5shiv/3.7/html5shiv.min.js"></script>
	<![endif]-->
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
		<div class="content clearfloat">
			<div id="banner">
				<ul class="imgList">


					<?php foreach($cover as $cov): ?>
					<li>
						<div class="img-box animated rotateInDownLeft">
							<div class="date-left">
								<p class="start">开始于</p>
								<p class="day">
									<?php echo date('d',$cov->start_time); ?><span class="months">/<?php echo date('m',$cov->start_time);?></span>
								</p>
							</div>
							<div class="img-sha">
							<a href="<?= yii\helpers\Url::to(['show/detail','showid' => $cov->showid]); ?>">
							<img src="<?= $cov->cover; ?>" class="carouse" alt="“重影——刘易斯与玛利亚的乌拉圭艺术?">
							</a>
							</div>
						</div>
						<div class="txt animated rotateInDownRight">
							<p class="bold"><?= $cov->title; ?></p>
							<p class="adress"> <?= $cov->city.' '.$cov->place; ?></p>
							<a href="<?= yii\helpers\Url::to(['show/index']); ?>" class="more">更多
								<img src="assets/img/arrow-down.png" align="arrow-down" />
							</a>
						</div>
					</li>
					<?php endforeach; ?>

					
				</ul>
				<span class="arrow pre animated bounceInLeft" id="prev"><img src="assets/img/arrow-pre.png"> 上一个</span>
				<span class="arrow next animated bounceInRight" id="next">下一个<img src="assets/img/arrow-next.png"></span>
			</div>
		</div>

		<div class="mg-space-init container vert default">
			<div class="mg-rows row row-flex">
				<div class="lg-3 time">
					<span>今天是</span>
					<span>24,04,2017<a href="#"><img src="assets/img/arrow-down.png" class="day-arrow down mg-trigger"></a></span>
				</div>
				<div class="time lg-3">
					<span>你在</span>
					<span>全球 <img src="assets/img/arrow-down.png" id="globa-arr" class="down mg-trigger"></span>
				</div>
			</div>
			<div class="mg-targets row">
				<div class="container row row-flex the-date">
					<span class="months">4</span>
					<ul>
						<li id="li1"><a href="<?php echo yii\helpers\Url::to(['show/da_pl','day' => '10']); ?>">不限</a></li>
						<li id="li1"><a href="<?php echo yii\helpers\Url::to(['show/da_pl','day' => '1']); ?>">1</a></li>
						<li id="li2"><a href="<?php echo yii\helpers\Url::to(['show/da_pl','day' => '2']); ?>">2</a></li>
						<li id="li3"><a href="<?php echo yii\helpers\Url::to(['show/da_pl','day' => '3']); ?>">3</a></li>
						<li id="li4"><a href="<?php echo yii\helpers\Url::to(['show/da_pl','day' => '4']); ?>">4</a></li>
						<li id="li5"><a href="<?php echo yii\helpers\Url::to(['show/da_pl','day' => '5']); ?>">5</a></li>
						<li id="li6"><a href="<?php echo yii\helpers\Url::to(['show/da_pl','day' => '6']); ?>">6</a></li>
						<li id="li7"><a href="<?php echo yii\helpers\Url::to(['show/da_pl','day' => '7']); ?>">7</a></li>
						<li id="li8"><a href="<?php echo yii\helpers\Url::to(['show/da_pl','day' => '8']); ?>">8</a></li>
						<li id="li9"><a href="<?php echo yii\helpers\Url::to(['show/da_pl','day' => '9']); ?>">9</a></li>
						<li id="li10"><a href="<?php echo yii\helpers\Url::to(['show/da_pl','day' => '10']); ?>">10</a></li>
						<li id="li11"><a href="<?php echo yii\helpers\Url::to(['show/da_pl','day' => '11']); ?>">11</a></li>
						<li id="li12"><a href="<?php echo yii\helpers\Url::to(['show/da_pl','day' => '12']); ?>">12</a></li>
						<li id="li13"><a href="<?php echo yii\helpers\Url::to(['show/da_pl','day' => '13']); ?>">13</a></li>
						<li id="li14"><a href="<?php echo yii\helpers\Url::to(['show/da_pl','day' => '14']); ?>">14</a></li>
						<li id="li15"><a href="<?php echo yii\helpers\Url::to(['show/da_pl','day' => '15']); ?>">15</a></li>
						<li id="li16"><a href="<?php echo yii\helpers\Url::to(['show/da_pl','day' => '16']); ?>">16</a></li>
						<li id="li17"><a href="<?php echo yii\helpers\Url::to(['show/da_pl','day' => '17']); ?>">17</a></li>
						<li id="li18"><a href="<?php echo yii\helpers\Url::to(['show/da_pl','day' => '18']); ?>">18</a></li>
						<li id="li19"><a href="<?php echo yii\helpers\Url::to(['show/da_pl','day' => '19']); ?>">19</a></li>
						<li id="li20"><a href="<?php echo yii\helpers\Url::to(['show/da_pl','day' => '20']); ?>">20</a></li>
						<li id="li21"><a href="<?php echo yii\helpers\Url::to(['show/da_pl','day' => '21']); ?>">21</a></li>
						<li id="li22"><a href="<?php echo yii\helpers\Url::to(['show/da_pl','day' => '22']); ?>">22</a></li>
						<li id="li23"><a href="<?php echo yii\helpers\Url::to(['show/da_pl','day' => '23']); ?>">23</a></li>
						<li id="li24"><a href="<?php echo yii\helpers\Url::to(['show/da_pl','day' => '24']); ?>">24</a></li>
						<li id="li25"><a href="<?php echo yii\helpers\Url::to(['show/da_pl','day' => '25']); ?>">25</a></li>
						<li id="li26"><a href="<?php echo yii\helpers\Url::to(['show/da_pl','day' => '26']); ?>">26</a></li>
						<li id="li27"><a href="<?php echo yii\helpers\Url::to(['show/da_pl','day' => '27']); ?>">27</a></li>
						<li id="li28"><a href="<?php echo yii\helpers\Url::to(['show/da_pl','day' => '28']); ?>">28</a></li>
						<li id="li29"><a href="<?php echo yii\helpers\Url::to(['show/da_pl','day' => '29']); ?>">29</a></li>
						<li id="li30"><a href="<?php echo yii\helpers\Url::to(['show/da_pl','day' => '30']); ?>">30</a></li>
						<li id="li31"><a href="<?php echo yii\helpers\Url::to(['show/da_pl','day' => '31']); ?>">31</a></li>
					</ul>
				</div>
				<div class="container row row-flex the-date  the-place">
					<ul>
						<li>
							<a href="<?php echo yii\helpers\Url::to(['show/da_pl','place' => '不限']); ?>">不限</a>
						</li>
						<li>
							<a href="<?php echo yii\helpers\Url::to(['show/da_pl','place' => '北京']); ?>">北京</a>
						</li>
						<li>
							<a href="<?php echo yii\helpers\Url::to(['show/da_pl','place' => '上海']); ?>">上海</a>
						</li>
						<li>
							<a href="<?php echo yii\helpers\Url::to(['show/da_pl','place' => '广州']); ?>">广州</a>
						</li>
						<li>
							<a href="<?php echo yii\helpers\Url::to(['show/da_pl','place' => '深圳']); ?>">深圳</a>
						</li>
						<li>
							<a href="<?php echo yii\helpers\Url::to(['show/da_pl','place' => '香港']); ?>">香港</a>
						</li>
						<li>
							<a href="<?php echo yii\helpers\Url::to(['show/da_pl','place' => '澳门']); ?>">澳门</a>
						</li>
						<li>
							<a href="<?php echo yii\helpers\Url::to(['show/da_pl','place' => '成都']); ?>">成都</a>
						</li>
						<li>
							<a href="<?php echo yii\helpers\Url::to(['show/da_pl','place' => '长沙']); ?>">长沙</a>
						</li>
						<li>
							<a href="<?php echo yii\helpers\Url::to(['show/da_pl','place' => '南京']); ?>">南京</a>
						</li>
						<li>
							<a href="<?php echo yii\helpers\Url::to(['show/da_pl','place' => '杭州']); ?>">杭州</a>
						</li>
						<li>
							<a href="<?php echo yii\helpers\Url::to(['show/da_pl','place' => '重庆']); ?>">重庆</a>
						</li>
						<li>
							<a href="<?php echo yii\helpers\Url::to(['show/da_pl','place' => '西安']); ?>">西安</a>
						</li>
						<li>
							<a href="<?php echo yii\helpers\Url::to(['show/da_pl','place' => '武汉']); ?>">武汉</a>
						</li>
						<li>
							<a href="<?php echo yii\helpers\Url::to(['show/da_pl','place' => '天津']); ?>">天津</a>
						</li>
						<li>
							<a href="<?php echo yii\helpers\Url::to(['show/da_pl','place' => '桂林']); ?>">桂林</a>
						</li>
						<li>
							<a href="<?php echo yii\helpers\Url::to(['show/da_pl','place' => '烟台']); ?>">烟台</a>
						</li>
						<li>
							<a href="<?php echo yii\helpers\Url::to(['show/da_pl','place' => '香港']); ?>">香港</a>
						</li>
						<li>
							<a href="<?php echo yii\helpers\Url::to(['show/da_pl','place' => '澳门']); ?>">澳门</a>
						</li>
						<li>
							<a href="<?php echo yii\helpers\Url::to(['show/da_pl','place' => '台湾']); ?>">台湾</a>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div id="content">
			<div id="lista1" class="als-container animated">
				<span class="als-prev"><img src="assets/img/foleft.png" alt="prev" title="previous" /></span>
				<div class="als-viewport" id="als-viewport">
					<ul class="als-wrapper">

						<?php foreach($shows as $show): ?>
						<li class="als-item">
						<a href="<?= yii\helpers\Url::to(['show/detail','showid' => $show->showid]); ?>">
							<img src="<?= $show->cover; ?>" alt="" title="calculator" />
						</a>
							<p class="end-time">结束于<?= date('d-m-Y',$show->end_time); ?></p>
							<h3><?= $show->title; ?></h3>
							<p class="didian"><?= $show->city; ?></p>
							<p class="fomore"><a href="<?= yii\helpers\Url::to(['show/index']); ?>">更多</a></p>
						</li>
						<?php endforeach; ?>


					</ul>
				</div>
				<span class="als-next"><img src="assets/img/foright.png" alt="next" title="next" /></span>
			</div>
		</div>
		<div class="line"></div>
		<div class="today-art" id="todayart">
			<h3><a href="yishujia.html"></a>艺术家</h3>

			<!-- 	<?php foreach($arts as $art): ?>
			<div class="person per02 animated">
				<img src="assets/img/psha01.png" class="img-shadow" />
				<img src="assets/img/person01.png" class="person-img"/>
				<div class="person-dec">
				<p class="per-name"><?= $art->name; ?></p>
				<p class="per-txt"><?= $art->identity; ?></p>
				<p class="per-more"><a href="<?= yii\helpers\Url::to(['artist/index']); ?>">更多<img src="assets/img/per-ar.png" /></a></p>
				</div>
			</div>
				<?php endforeach; ?> -->


			<div class="person per01 animated">
				<img src="assets/img/psha01.png" class="img-shadow" />
				<a href="<?= yii\helpers\Url::to(['artist/detail','artistid' => 1]); ?>">
				<img src="assets/img/person01.png" class="person-img" />
				</a>
				<div class="person-dec">
					<p class="per-name">瓦尔特·格罗皮乌斯</p>
					<p class="per-txt">德国现代建筑师和建筑教育家，现代主义建筑学派的倡导人和奠基人之一，公立包豪斯学校的创办人。
					</p>
					<p class="per-more">
						<a href="<?= yii\helpers\Url::to(['artist/index']); ?>">更多<img src="assets/img/per-ar.png" /></a>
					</p>
				</div>
			</div>
			<div class="person per02 animated">
				<img src="assets/img/psha02.png" class="img-shadow" />
				<a href="<?= yii\helpers\Url::to(['artist/detail','artistid' => 2]); ?>">
				<img src="assets/img/person02.png" class="person-img" />
				</a>
				<div class="person-dec">
					<p class="per-name">勒·柯布西耶</p>
					<p class="per-txt">佛罗伦萨画派的创始人，也是文艺复兴的先驱者之一。</p>
					<p class="per-more">
						<a href="artist.html">更多<img src="assets/img/per-ar.png" />
						</a>
					</p>
				</div>
			</div>


		</div>
		<div class="new animated" id="new">
			<?php foreach($news as $new): ?>
			<div class="new01">
				<span class="title">
					<a href="<?php echo yii\helpers\Url::to(['news/detail','newid' => $new->newid]);  ?>"><?= $new->title; ?></a>
				</span><!--
				--><span class="time">
					<?= date('Y-m-d',$new->createtime); ?>
				</span>
				<span class="name"><?= $new->author; ?></span>
				<a href="<?php echo yii\helpers\Url::to(['news/detail','newid' => $new->newid]);  ?>">
				<img src="<?= $new->cover; ?>" />
				</a>
			</div>
			<?php endforeach; ?>
		</div>
		<div id="backtotop" class="totop">
			<img src="assets/img/artarrow.png" />
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
		<script src="assets/js/sy.js"></script>
		<script src="assets/js/jquery.mg-space.js"></script>
		<script type="text/javascript" src="assets/js/jquery.als-1.7.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$("#lista1").als({
					visible_items: 3,
					scrolling_items: 1,
					orientation: "horizontal",
					circular: "no",
					autoscroll: "no",
					interval: 5000,
					speed: 400,
					easing: "swing",
					direction: "right",
					start_from: 0
				});
			});
		</script>
	</body>

</html>