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
				<table class="clearfloat hsty-table">
					<tr class="th">
						<th>ID</th>
						<th>管理员</th>					
						<!-- <th>密码</th> -->
						<th>注册时间</td>
						<th>操作</td>
					</tr>
					<?php foreach($admins as $admin): ?>
					<tr>
						<td><?= $admin->id; ?></td>
						<td><?= $admin->adminuser; ?></td>						
						<!-- <td><?= $admin->adminpass; ?></td> -->
						<td><?= date('Y-m-d H:m:s',$admin->createtime);?></td>
						<td>
						<a href="<?= yii\helpers\Url::to(['admin/index','adminid' => $admin->id]); ?>">
							<button type="submit">删除</button>
						</a>
						<a href="<?= yii\helpers\Url::to(['admin/updateadmin','adminid' => $admin->id]); ?>">
							<button type="submit">修改</button>
						</a>
						</td>
					</tr>
					<?php endforeach; ?>

				</table>
				<div class="page">
				<?php
				echo yii\widgets\LinkPager::widget([
							'pagination' => $pager,/*
							'prevPageLabel' => '&#8249;',
							'nextPageLabel' => '&#8250;'*/
						]);

				?>
					<!-- <button>
						<img src="assets/admin/img/arrow-pre.png" />
					</button>
					<button>
						<img src="assets/admin/img/arrow-next.png" />
					</button> -->
				</div>
				</div>
				<div class="checkct">
				<?php $form = ActiveForm::begin([
				'action' => '?r=admin/admin/create',
				'fieldConfig' => [
					'template' => '<label>{label}</label>{input}{error}',
					'options' => [
	                    'enctype' => 'multipart/form-data'
	                ],
				]
			]);  ?>
					<div>
						<?= $form->field($model,'adminuser')->textInput(['placeholder' => '请输入用户名,不能为空']); ?>
					</div>
					<div>
						<?= $form->field($model,'adminpass')->passwordInput(['placeholder' => '请输入密码,不能为空']); ?>
					</div>
					<div>
						<?= $form->field($model,'adminemail')->textInput(['placeholder' => '请输入邮箱,不能为空且格式正确']); ?>
					</div>
					<div>
					<?= Html::submitButton('确定',['class' => 'addxx']) ?>
					<?= Html::resetButton('取消', ['class' => 'cancel']); ?>
					</div>
				<?php ActiveForm::end(); ?>
				</div>
		</div>
