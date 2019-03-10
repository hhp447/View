<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\HTML;
?>
			<div class="content">
					<div class="top">
						<div class="top-right">
						<img src="assets/admin/img/reny.png" />
						<span><?= Yii::$app->session['admin']['adminuser']; ?></span>
						<a href="<?php echo yii\helpers\Url::to(['public/logout']); ?>">退出</a>
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
						<th>封面</th>
						<th>ID</th>
						<th style="width: 300px;">标题</th>
						<th>入场费用</th>
						<th>展览城市</th>
						<th>展览开始时间</th>
						<th>展览结束时间</th>
						<th>操作</th>
					</tr>

					<?php foreach($shows as $show): ?>
					<tr>
						<td class="img"><img src="<?= $show->cover; ?>" ></td>
						<td><?= $show->showid; ?></td>
						<td><?= $show->title; ?></td>
						<td><?= $show->pay; ?></td>
						<td><?= $show->city; ?></td>
						<td><?= date('Y-m-d H:m:s',$show->start_time); ?></td>
						<td><?= date('Y-m-d H:m:s',$show->end_time); ?></td>
						
						<td>
							<a href="<?= yii\helpers\Url::to(['show/updateshow','showid' => $show->showid]); ?>">
							<button>修改</button></a>
							<a href="<?= yii\helpers\Url::to(['show/index','showid' => $show->showid]); ?>">
							<button type="submit">删除</button></a>
						</td>
					</tr>
					<?php endforeach; ?>	
									

				</table>
				</div>
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
			'action' => '?r=admin/show/create',
			'fieldConfig' => [
				'template' => '<label>{label}</label>{input}{error}',
				'options' => [
                    'enctype' => 'multipart/form-data'
                ],
			]
		]);  ?>
			<div>
			    <?= $form->field($model,'title')->textInput(['placeholder' => '标题不能为空']); ?>
			</div>
			<div>
				<?= $form->field($model,'smalltitle')->textInput(['placeholder' => '小标题不能为空']); ?>
			</div>
			<div> 
			<?= $form->field($model,'start_time')->textInput(['placeholder' => '展览开始时间不能为空,格式为 2017-01-01']); ?>
			</div>
			<div>
			<?= $form->field($model,'end_time')->textInput(['placeholder' => '展览结束时间不能为空,格式为 2017-01-01']); ?>
			</div>
			<div>
			<?= $form->field($model,'day_time')->textInput(['placeholder' => '每日开始时间不能为空']); ?>
			</div>
			<div>
			<?= $form->field($model,'artistid')->textInput(['placeholder' => '有关艺术家ID不能为空']); ?>
			</div>
			<div>				
			<?= $form->field($model,'pay')->textInput(['placeholder' => '费用不能为空']); ?>
			</div>
			<div>
			<?= $form->field($model,'city')->textInput(['placeholder' => '城市不能为空']); ?>
			</div>
			<div>
			<?= $form->field($model,'place')->textInput(['placeholder' => '地点不能为空']); ?>
			</div>
			<div>
			<?= $form->field($model,'sponsor')->textInput(); ?>
			</div>
			<div>
			<?= $form->field($model,'cover')->fileInput(); ?>
			</div>
			<div>
				<?= $form->field($model,'pics[]')->fileInput(); ?>
				<br/>
				<span class="addmoreimg" style="margin-left:130px">添加一个</span>
			</div>
			<div>
			<?= $form->field($model,'introduction')->textarea(['placeholder' => '标题不能为空']); ?>
			
			<?= Html::submitButton('确定',['class' => 'addxx']) ?>
			<?= Html::resetButton('取消', ['class' => 'cancel']); ?>
			</div>
			<?php ActiveForm::end(); ?>
		</div>
