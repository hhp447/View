<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>展览再终版页面</title>
		<link rel="stylesheet" href="assets/css/common.css" />
		<link rel="stylesheet" href="assets/css/style.css" />
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
			                 <?php echo \Yii::$app->session['user']['username']; ?> ,</a> <a href="<?php echo yii\helpers\Url::to(['index/logout']); ?>">退出</a>
			            <?php else: ?>
			                <a href="<?php echo yii\helpers\Url::to(['index/loginre']); ?>">登录</a>
			            <?php endif; ?>
					</li>
				</ul>
			</nav>
		</div>
		<div class="mg-space-init container vert default">
			<div class="mg-rows row row-flex">
				<div class="lg-3 time">
					<span>今天是</span>
					<span>24,04,2017<a href=""><img data-original="assets/img/arrow-down.png" class="day-arrow down mg-trigger"></a></span>
				</div>
				<div class="time lg-3">
					<span>你在</span>
					<span>全球 <img data-original="assets/img/arrow-down.png" id="globa-arr" class="down mg-trigger"></span>
				</div>
			</div>
			<div class="mg-targets row">
				<div class="container row row-flex the-date">
					<span class="months">4</span>
					<ul>
						<li id="li1"><a href="<?php echo yii\helpers\Url::to(['show/da_pl','day' => '100']); ?>">不限</a></li>
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
					您选择的是：<span style="color:red"><?php
						echo Yii::$app->session['day']?Yii::$app->session['day']:'不限';
					?></span>
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
					您选择的是：<span style="color:red"><?php
						echo Yii::$app->session['place']?Yii::$app->session['place']:'不限';
					?></span>
				</div>
			</div>
		</div>
		
		<div class="czl-box clearfloat" id="as">

			<?php foreach($model as $show):  ?>
			<div class="zlbox">
				<a href="<?= yii\helpers\Url::to(['show/detail','showid' => $show->showid]);  ?>">
				<img data-original="<?php echo $show->cover;  ?>" class="thumb">
				</a>
				<p class="justify ms-txt">
					<?= $show->smalltitle; ?>
				</p>
				<p class="place"><?= $show->city.'，'.'结束于'.date('Y.m.d',$show->end_time); ?></p>
			</div>
			<?php endforeach; ?>

		</div>

		<div class="loadmore">
			<button class="btn-more" id="more_show">更多</button>
		</div>
		
		<div id="totop">
			<img src="assets/img/artarrow.png" />
		</div>
		
		<script src="assets/js/jquery-2.2.3.min.js"></script>
		<script src="assets/js/lazoyd.js"></script>
		<script src="assets/js/jquery.mg-space.js"></script>
		<script src="assets/js/zlan.js"></script>
		<script>
			$("#more_show").click(function(){
				$.post("<?php echo yii\helpers\Url::to(['show/more']); ?>",{
					"<?PHP echo Yii::$app->request->csrfParam;?>":"<?php echo yii::$app->request->csrfToken?>"
				},function(data){
					var a = document.getElementById("as").innerHTML;
					for(var i=0;i<data.length;i++)
					{
						a+=data[i];
					}
					$("#as").html(a);
				},"json")
			});
		</script>

	</body>

</html>