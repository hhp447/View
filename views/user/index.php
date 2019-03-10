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
		<title>个人中心</title>
		<link rel="stylesheet" href="assets/css/common.css">
		<link rel="stylesheet" href="assets/css/hy.css" />
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
		<div class="tabs-vertical">

			<ul class="navul">
				<li>
					<a class="tab-active" data-index="0" href="#">个人资料</a>
				</li>
				<li>
					<a data-index="1" href="#">修改密码</a>
				</li>
				<li>
					<a data-index="2" href="#">订 阅</a>
				</li>
				<li>
					<a data-index="3" href="#">报名信息</a>
				</li>
				<li>
					<a data-index="4" href="#">系统消息</a>
				</li>
			</ul>

			<div class="tabs-content-placeholder">

				<div class="tab-content-active grxx item">


					<?php $form = ActiveForm::begin([
						'fieldConfig' => [
							'template' => '<span>{label}</span>{input}'
						]
					]); ?>
					<?php if(Yii::$app->session->hasFlash('info')){
						echo Yii::$app->session->getFlash('info');
						} ?>
					<div class="grtx">
						<span>头像</span>
						<img src="<?php echo $model->photo; ?>"/>
						<div>
					<?php echo $form->field($model,'photo')->fileInput(); ?> 
						</div>
					</div>
					<div class="grtx">
						<?php echo $form->field($model,'nickname')->textInput(['placeholder' => '请输入昵称','class' => 'inputname']); ?>
					</div>
					<div class="grtx">
						<?php echo $form->field($model,'username')->textInput(['placeholder' => '请输入用户名','class' => 'inputname','disabled' => true]); ?>
					</div>
					<div class="grtx">
						<?php echo $form->field($model,'useremail')->textInput(['placeholder' => '请输入电子邮箱','class' => 'inputname']) ;?>
					</div>
					
					<div class="grtx">
						<?php echo $form->field($model,'truename')->textInput(['placeholder' => '请输入真实姓名','class' => 'inputname']) ;?>
					</div>
					<div class="grtx">
						<?php echo $form->field($model,'phone')->textInput(['placeholder' => '请输入手机号码','class' => 'inputname']) ;?>
					</div>
					<div class="grtx">
						<?php echo $form->field($model,'introduction')->textInput(['placeholder' => '请输入个人简介','class' => 'inputname']) ;?>
					</div>
					<?php echo Html::submitButton('保存',['class' => 'bcun']); ?>
					<?php ActiveForm::end(); ?>
				</div>
				




				<div class="item">
				<?php $form = ActiveForm::begin([
					'fieldConfig' => [
						'template' => '<div class="grtx">{input}{error}</div>'
					]
				]);?>
					<?php echo $form->field($model,'userpass')->passwordInput(['placeholder' => '请输入原密码']); ?>
					<?php echo $form->field($model,'newuserpass')->passwordInput(['placeholder' => '请输入新密码']); ?>
					<?php echo $form->field($model,'newuserrepass')->passwordInput(['placeholder' => '请确认密码']); ?>
					<?= Html::submitButton('保存',['class' => 'bcun']); ?>
					<?php echo $form->field($model,'username')->hiddenInput(); ?>
                <?php ActiveForm::end(); ?>
				</div>


				<div class="clearfloat item">
					<div class="chose-dy">
						<a href="#zl" class="active">展览</a>
						<a href="#ysj">艺术家</a>
					</div>
					<div id="zl">


						<?php foreach($shows as $k => $show): ?>
						<div class="dyzl clearfloat">
						<a href="<?php echo yii\helpers\Url::to(['show/detail','showid' => $show->showid]); ?>">
							<p class="tit"><?php echo $show->title;?></p>
						</a>
							<p class="time"><?php echo date('Y.m.d',$show->start_time).'-'.date('m.d',$show->end_time); ?></p>
							<?php if(time() - $show->end_time < 0): ?>
								<?php if(Yii::$app->session->hasFlash('info')){
									echo Yii::$app->session->getFlash('info');
									} ?>
							<button class="td-btn" type="submit" id="<?php echo "show_".$k; ?>" onclick="out(<?php echo $show->showid; ?>);">退订</button>
							<?php else: ?>
							<button class="miss-bn" type="submit">已过期</button>
							<?php endif; ?>
						</div>
						<?php endforeach; ?>



					<!-- 	<div class="dyzl clearfloat">
							<p class="tit">约会：中法青年艺术家联展</p>
							
							<p class="time">2017.4.26-5.3</p>
							<button class="td-btn" type="submit">退订</button>
						</div>
						<div class="dyzl clearfloat">
							<p class="tit">约会：中法青年艺术家联展</p>
							
							<p class="time">2017.4.26-5.3</p>
							<button class="td-btn" type="submit">退订</button>
						</div>
						<div class="dyzl clearfloat">
							<p class="tit">约会：中法青年艺术家联展</p>
							
							<p class="time">2017.4.26-5.3</p>
							<button class="miss-bn" type="submit">已过期</button>
						</div> -->

					</div>
					<div id="ysj">


						<!-- <div class="dysj clearfloat">
							<img src="assets/img/art01.png" class="head"/>
							<span>瓦尔特·格罗皮乌斯</span>
							<button class="td-btn" type="submit">退订</button>
						</div>
						<div class="dysj clearfloat">
							<img src="assets/img/art01.png" class="head"/>
							<span>瓦尔特·格罗皮乌斯</span>
							<button class="td-btn" type="submit">退订</button>
						</div> -->

							<?php foreach($arts as $k => $art): ?>
						<div class="dysj clearfloat">
						<a href="<?php echo yii\helpers\Url::to(['artist/detail','artistid' => $art->artistid]); ?>">
							<img src="<?= $art->cover; ?>" class="head"/>
						</a>
							<span><?= $art->name; ?></span>
							<button class="td-btn" type="submit" id="<?php echo $k; ?>" onclick="out_art(<?php echo $art->artistid;?>);">取消关注</button>
							
						</div>
						<?php endforeach; ?>


					</div>
				</div>
				<div class="clearfloat item">
					<?php foreach($tickets as $ticket): ?>
					<div class="getticket">
						<p class="sj"><?php echo date('Y.m.d',$ticket->start_time).'~'.date('m.d',$ticket->end_time); ?></p>
						<h3 class="tickettltel"><?= $ticket->title; ?></h3>
						<p class="place"><?= $ticket->city.$ticket->place; ?></p>
						<p class="tip">请在展览期间以及开馆时间内前往观看</p>
					</div>
					<?php endforeach; ?>
				</div>

				<div class="item">

				<?php foreach($notifys as $k => $notify): ?>
					<p class="xinxi">
						<?php echo $k.'.'.$notify->title.' '.$notify->content.' '.date('Y/m/d',$notify->createtime); ?>
					</p>
				<?php endforeach; ?>

			</div>

		</div>
		<script>
			window.jQuery || document.write('<script src="assets/js/jquery-2.2.3.min.js"><\/script>')
		</script>

		<script>
			$(document).ready(function() {

				var widget = $('.tabs-vertical');

				var tabs = widget.find('ul a'),
					content = widget.find('.tabs-content-placeholder > div');

				tabs.on('click', function(e) {

					e.preventDefault();

					var index = $(this).data('index');

					tabs.removeClass('tab-active');
					content.removeClass('tab-content-active');

					$(this).addClass('tab-active');
					content.eq(index).addClass('tab-content-active');

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
			function out(da){
				var id = da;
				    // 下面这行代码就是你要的ID属性
				 /*   var a = $(this).attr("id");
				    $("#"+a).removeClass().addClass("miss-bn");*/

				$.post('<?php echo yii\helpers\Url::to(['user/out']); ?>',{
					"<?PHP echo Yii::$app->request->csrfParam;?>":"<?php echo yii::$app->request->csrfToken?>",
					"showid":id
				},function(data){
					alert(data);
					window.location.reload();
					/*window.location.href="index.php?r=user#zl";*/
				},'json');
			}
			function out_art(da){
				var id = da;
				$.post('<?php echo yii\helpers\Url::to(['user/out_art']); ?>',{
					"<?PHP echo Yii::$app->request->csrfParam;?>":"<?php echo yii::$app->request->csrfToken?>",
					"artid":id
				},function(data){
					alert(data);
					window.location.reload();
				},'json');
			}
		</script>
	</body>

</html>