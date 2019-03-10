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
				<?= $form->field($model,'name')->textarea(['class' => 'linetext']); ?>				
				</div>
				<div>
				<?= $form->field($model,'identity')->textarea(['class' => 'linetext']); ?>				
				</div>							
				<div>
				<?= $form->field($model,'introduction')->textarea([]); ?>				
				</div>


				<div class="xximg">
				<?= $form->field($model,'cover')->fileInput([]); ?>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?php if(!empty($model->cover)): ?>
					<img src="<?php echo $model->cover; ?>" />
				<?php endif; ?>
				</div>

				
				<!-- <div class="xximg">
					<label>作品</label>
					<div class="forimg">
					<img src="assets/admin/img/zlxx01.png" />
					<img src="assets/admin/img/zlxx02.png" />
					<img src="assets/admin/img/zlxx03.png" />
					<img src="assets/admin/img/zlxx04.png" />
					</div>
					<div class="btn-box">
					<div class="inline-button"><button class="btn">删除图片</button></div>
					<div class="inline-button"><button class="btn adimg">添加</button></div>
					<span class="moread">click</span>
					</div>
					
				</div>
				<div class="xximg">
					<label>展览信息</label>
					<div class="forimg">
					<img src="assets/admin/img/zlxx01.png" />
		
					</div>
					<div class="btn-box">
					<div class="inline-button"><button class="btn">删除展览</button></div>
					<div class="inline-button"><button class="btn adimg">添加</button></div>
					<span class="moreads">click</span>
					</div>
					
				</div> -->
				<div>
					<?php echo Html::submitButton('提交', ['class' => 'qr']); ?>
				</div>
				<?php ActiveForm::end(); ?>
			</div>
		</div>