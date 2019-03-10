<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\HTML;
?>
		<div class="content">
			<div class="top">
				<div class="top-right">
				<img src="assets/admin/assets/admin/img/reny.png" />
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
				<?= $form->field($model,'num')->textarea(['class' => 'linetext']); ?>				
				</div>
				
				<div>
				<?= $form->field($model,'author')->textarea(['class' => 'linetext']); ?>				
				</div>

				<div>
				<?= $form->field($model,'content')->textarea([]); ?>				
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
					<img src="http://<?php echo $pic; ?>">
                    <a href="<?php echo yii\helpers\Url::to(['news/removepic', 'key' => $k, 'newid' => $model->newid]) ?>">删除</a>
					<?php endforeach; ?>
					<div class="btn-box">
					<span class="addmoreimg_news">添加一个</span>
					</div>
				</div>



				<div>
					<?php echo Html::submitButton('提交', ['class' => 'qr']); ?>
				</div>
				<?php ActiveForm::end(); ?>
			</div>
		</div>
