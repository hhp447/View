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
		<title>展览详细页</title>
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
			                 <?php echo \Yii::$app->session['user']['username']; ?> ,</a> <a href="<?php echo yii\helpers\Url::to(['index/logout']); ?>">退出</a>
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

		<div class="zlxx-content clearfloat">
			<div class="zlxx-left">
				<img src="assets/img/zlxxtr.png" />
				<span class="zlxx-title"><?= $detail->title; ?></span>
				<p class="sj" style="margin-top: 40px;">时间</p>
				<p class="sj-txt">
				<?php echo date('Y年m月d日',$detail->start_time).'~'.date('Y年m月d日',$detail->end_time).' '.$detail->day_time; ?></p>
				<p class="sj">地点</p>
				<p class="sj-txt"><?= $detail->city.' '.$detail->place;?></p>
				<p class="sj">费用</p>
				<p class="sj-txt"><?= $detail->pay; ?>(展览通票)　<!-- 10元(优惠票) -->
				<?php if(Yii::$app->session->hasFlash('info')){
					echo Yii::$app->session->getFlash('info');
					} ?>
				<!-- <button type="submit" id="dinggou" class="noclick"><strong>+ </strong>报名</button> -->
				<button type="button" id="dinggou" class="noclick"><strong>+ </strong>报名</button>
					<div class="phone">
					<!-- 	<div class="phonediv"><input type="text" placeholder="请输入手机号" /></div>
					
						<div class="phonediv"><button type="submit" class="queren">确定</button></div> -->

						<?php $form = ActiveForm::begin([
						'fieldConfig' => [
							'template' => '{input}{error}'
						]
					]); ?>
						<?php echo $form->field($ticket,'email')->textInput(['placeholder' => '请输入电子邮件']); ?>
						<?php echo $form->field($ticket,'showid')->hiddenInput(['value' => $detail->showid]); ?>
						<?php echo $form->field($ticket,'userid')->hiddenInput(['value' => $email->userid]); ?>
						<?php echo Html::submitButton('确认报名',['class' => 'queren']); ?>
					<?php ActiveForm::end(); ?> 


					</div>
				</p>
				<p class="sj">主办方</p>
				<p class="sj-txt"><?= $detail->sponsor; ?></p>

				<!-- <p class="zl-txt">
					“约会”项目是由里昂当代美术馆主办，基于里昂双年展“国际青年特别项目”的国际交流展览，旨在探索法国乃至世界其它地区青年艺术家的创作，力图一定程度上反映当代青年艺术的现实面貌和未来趋势。参展的法方艺术家是从近几届的里昂双年展中挑选而出，主要为在法国工作与生活并具有跨文化背景的优秀青年艺术家。除主办方外，展览也获得里昂当代艺术研究院和里昂国立美术学院的艺术指导和学术支持。
				</p>
				<p class="zl-txt">
					每次“约会”展都会选取法国以外的城市举办，不仅展示法国艺术家的作品，也邀请展览发生地的策展人一同策划，将当地艺术家纳入策展的视野，构成不同文化、社会、艺术观念间的交流与对话。此次在中央美术学院美术馆的展览，将展出中法青年艺术家的近40件作品，涉及绘画、雕塑、摄影、装置等多种形式。
				</p> -->
				<p class="zl-txt">
					<?= $detail->introduction; ?>
				</p>
				<img src="assets/img/zlxxtran.png" class="zlxxtran" />
			</div>
			<div class="zlxx-right">
				<!-- <div class="zlxx-box" style="margin-top: 80px;"><img src="assets/img/zlxx01.png" /></div>
				<div class="zlxx-box"><img src="assets/img/zlxx02.png" /></div>
				<div class="zlxx-box"><img src="assets/img/zlxx03.png" /></div>
				<div class="zlxx-box min-box"><img src="assets/img/zlxx04.png" /></div> -->
				<?php foreach((array)json_decode($detail->pics) as $k => $pic): ?>
				<?php if($k==0): ?>
				<div class="zlxx-box" style="margin-top: 80px;"><img src="http://<?php echo $pic; ?>" /></div>
				<?php endif; ?>
				<div class="zlxx-box"><img src="http://<?php echo $pic; ?>" /></div>
			<?php endforeach; ?>
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
		<script src="assets/js/zxxx.js"></script>
		<script>
			$('#dinggou').click(function() {
				if($('#dinggou').hasClass('noclick')) {
					$('.phone').css('display', 'block');
					$('#dinggou').removeClass('noclick');
				}
				else {
					$('.phone').css('display', 'none');
					$('#dinggou').addClass('noclick');
				}
				
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
		</script>
	</body>

</html>