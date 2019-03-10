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
			<div class="zl-mid">
			<?php $form = ActiveForm::begin([
				'fieldConfig' => [
					'template' => '<label>{label}</label>{input}{error}',
				],
				'options' => [
	                    'enctype' => 'multipart/form-data'
	                ]
			]);  ?>
				<?php
					if(Yii::$app->session->hasFlash('info')){
						echo "<p style='width: 90%;margin: 10px auto 20px; color:red;'>".Yii::$app->session->getFlash('info')."</p>";
					}
				?>
				<div>
				<?= $form->field($model,'adminuser')->textarea(['class' => 'linetext']); ?>				
				</div>	
				<div>
				<?= $form->field($model,'adminpass')->textarea(['class' => 'linetext']); ?>				
				</div>
				<div>
				<?= $form->field($model,'adminemail')->textarea(['class' => 'linetext']); ?>				
				</div>
				 <div>
				<label></label>
				<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input name="auth" type="radio" value="admin" />系统管理员 </label> 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<label><input name="auth" type="radio" value="useroperator" />用户管理员 </label>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<label><input name="auth" type="radio" value="operator" />内容操作员 </label> 	 				
				</div> 					
				
				
				<div>
					<?php echo Html::submitButton('提交', ['class' => 'qr']); ?>
				</div>
				<?php ActiveForm::end(); ?>
			</div>
		</div>