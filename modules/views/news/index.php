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
						<th>封面</th>
						<th>ID</th>
						<th>标题</th>
						<th>浏览量</th>
						<th style="width: 300px;">发布时间</th>
						<th>操作</th>
					</tr>
					<?php foreach($news as $new): ?>
					<tr>
						<td class="img"><img src="<?= $new->cover; ?>" ></td>
						<td><?= $new->newid; ?></td>
						<td><?= $new->title; ?></td>
						<td><?= $new->num; ?></td>
						<td><?= date('Y-m-d H:m:s',$new->createtime); ?></td>
						<td>
							<a href="<?= yii\helpers\Url::to(['news/updatenews','newid' => $new->newid]); ?>">
							<button>修改</button></a>
							<a href="<?= yii\helpers\Url::to(['news/index','newid' => $new->newid]); ?>"><button type="submit">删除</button></a>
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
			'action' => '?r=admin/news/create',
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
			<?= $form->field($model,'author')->textInput(['placeholder' => '作者不能为空']); ?>
			</div>
			<div>
			<?= $form->field($model,'cover')->fileInput(); ?>
			</div>
			<div>
			<?= $form->field($model,'content')->textarea(['placeholder' => '内容不能为空']); ?>
            </textarea>
            </div>
            <div class="zximg">
            	<?= $form->field($model,'pics[]')->fileInput(); ?>
				<span class="addmoreimg_news" style="margin-left:130px">添加一个</span>
            </div>
			<div>
            <?= Html::submitButton('确定',['class' => 'addxx']) ?>
			<?= Html::resetButton('取消', ['class' => 'cancel']); ?>
            </div>
            <?php ActiveForm::end(); ?>
		</div>
		
