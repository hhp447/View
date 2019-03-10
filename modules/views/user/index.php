<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\HTML;
?>
		<div class="content">
			<div class="top">
				<div class="top-right">
				<img src="assets/admin/img/reny.png" />
				<span><?= Yii::$app->session['admin']['adminuser']; ?></span>
				<a href="<?php echo yii\helpers\Url::to(['public/logout']) ?>">退出</a>
				</div>
			</div>
			
			<div class="clearfloat">
				<?php
				if(Yii::$app->session->hasFlash('info')){
					echo "<p style='width: 90%;margin: 10px auto 20px; color:red;'>".Yii::$app->session->getFlash('info')."</p>";
				}
				?>
				<button class="add">添加</button>
				<div class="for-se clearfloat">
				<input type="text" class="seacrch" />
				<img src="assets/admin/img/search.png" class="seacrch-img"/>
				</div>
				<table class="clearfloat hsty-table">
					<tr class="th">
						<th>ID</th>
						<th>用户名</th>
						<th style="width: 200px;">邮箱</th>
						<!-- <th>密码</th> -->
						<th>注册时间</td>
						<th>最近登录时间</td>
						<th>操作</td>
					</tr>

					<?php foreach($users as $user):?>
					<tr>
						<td><?= $user->userid; ?></td>
						<td><?= $user->username; ?></td>
						<td><?= $user->useremail; ?></td>						
						<!-- <td><?= $user->userpass; ?></td> -->
						<td><?= date('Y-m-d H:m:s',$user->createtime); ?></td>
						<td><?= date('Y-m-d H:m:s',$user->lastlogin); ?></td>
						<td>
							<a href="<?= yii\helpers\Url::to(['user/index','userid' => $user->userid]); ?>"><button type="submit">删除</button></a>
							<a href="<?= yii\helpers\Url::to(['user/updateuser','userid' => $user->userid]); ?>">
							<button type="submit">修改</button></a>
						</td>
					</tr>
					<?php endforeach; ?>
					
				</table>
				<div class="page">
					<!-- <button><img src="assets/admin/img/arrow-pre.png" /></button>
					<button>1</button>
					<button>2</button>
					<button>3</button>
					<button><img src="assets/admin/img/arrow-next.png" /></button> -->

					<?php 
						echo yii\widgets\LinkPager::widget([
							'pagination' => $pager,/*
							'prevPageLabel' => '&#8249;',
							'nextPageLabel' => '&#8250;'*/
						]); 
					?>


				</div>
				</div>
				<div class="checkct">
				<?php $form = ActiveForm::begin([
						'action' => '?r=admin/user/create',
						'fieldConfig' => [
							'template' => '<label> </label>{input}{error}',
							'options' => [
			                    'enctype' => 'multipart/form-data'
			                ],
						]
					]);  ?>
					<div>
						<?= $form->field($model,'username')->textInput(['placeholder' => '请输入用户名']); ?>
					</div>
					<div>
						<?= $form->field($model,'useremail')->textInput(['placeholder' => '请输入电子邮箱']); ?>
					</div>
					<div>
						<?= $form->field($model,'userpass')->passwordInput(['placeholder' => '请输入用户密码']); ?>
					</div>
					<div>
						<?= $form->field($model,'userrepass')->passwordInput(['placeholder' => '请确认密码']); ?>
					</div>
					

					<div>
					<?= Html::submitButton('确定',['class' => 'addxx']) ?>
					<?= Html::resetButton('取消', ['class' => 'cancel']); ?>
					</div>

					<?php ActiveForm::end(); ?>
				</div>
		</div>
