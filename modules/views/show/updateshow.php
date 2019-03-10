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
				<?= $form->field($model,'title')->textarea(['class' => 'linetext']); ?>				
				</div>
				<div>
				<?= $form->field($model,'smalltitle')->textarea(['class' => 'linetext']); ?>				
				</div>
				<!-- <div>
				<?= $form->field($model,'start_time')->textarea(['class' => 'linetext']); ?>
				</div>
				<div>
				<?= $form->field($model,'end_time')->textarea(['class' => 'linetext']); ?>
				</div>
				<div>
				<?= $form->field($model,'day_time')->textarea(['class' => 'linetext']); ?>
				</div> -->
				<div>
				<?= $form->field($model,'isCover')->textarea(['class' => 'linetext']); ?>
				</div>
				<div>
				<?= $form->field($model,'artistid')->textarea(['class' => 'linetext']); ?>
				</div>
				<div>
				<?= $form->field($model,'city')->textarea(['class' => 'linetext']); ?>
				</div>
				<div>
				<?= $form->field($model,'place')->textarea(['class' => 'linetext']); ?>
				</div>
				<div>
				<?= $form->field($model,'pay')->textarea(['class' => 'linetext']); ?>
				</div>
				<div>
				<?= $form->field($model,'num')->textarea(['class' => 'linetext']); ?>
				</div>
				<div>
				<?= $form->field($model,'sponsor')->textarea(['class' => 'linetext']); ?>
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




				<div class="xximg">
				<?= $form->field($model,'pics[]')->fileInput([]); ?>

					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<?php
                        foreach((array)json_decode($model->pics, true) as $k=>$pic):
                    ?>
					<img src="http://<?php echo $pic ?>">
                    <a href="<?php echo yii\helpers\Url::to(['show/removepic', 'key' => $k, 'showid' => $model->showid]) ?>">删除</a>
					<?php endforeach; ?>
					<div class="btn-box">
					<span class="addmoreimg">添加一个</span>
					</div>
				</div>


				
				<div>
				<?php echo Html::submitButton('提交', ['class' => 'qr']); ?>
					
				</div>
				<?php ActiveForm::end(); ?>
			</div>
		</div>