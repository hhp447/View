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
						<td>艺术家</td>
						<td>ID</td>
						<td style="width: 300px;">艺术家姓名</td>
						<td>身份</td>
						<td>发布时间</td>					
						<td>操作</td>
					</tr>

					<?php foreach($arts as $art): ?>
					<tr>
						<td class="img"><img src="<?= $art->cover; ?>" ></td>
						<td><?= $art->artistid; ?></td>
						<td><?= $art->name; ?></td>
						<td><?= $art->identity; ?></td>
						<td><?= date('Y-m-d H:m:s',$art->createtime); ?></td>
						
						<td>
							<a href="<?= yii\helpers\Url::to(['artist/updateart','artistid' => $art->artistid]); ?>">
							<button>修改</button></a>
							<a href="<?= yii\helpers\Url::to(['artist/index','artistid' => $art->artistid]); ?>"><button type="submit">删除</button></a>
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
				'action' => '?r=admin/artist/create',
				'fieldConfig' => [
					'template' => '<label>{label}</label>{input}{error}',
					'options' => [
	                    'enctype' => 'multipart/form-data'
	                ],
				]
			]);  ?>
			<div>
				<?= $form->field($model,'name')->textInput(['placeholder' => '姓名不能为空']); ?>
			</div>
			<div>
				<?= $form->field($model,'abc')->textInput(['placeholder' => '首字母不能为空']); ?>
			</div>
			<div>
				<?= $form->field($model,'identity')->textInput(['placeholder' => '身份不能为空']); ?>
			</div>
			<div>				
				<?= $form->field($model,'cover')->fileInput(); ?>
			</div>
			<div class="jianj">
				<?= $form->field($model,'introduction')->textarea(['placeholder' => '个人简介']); ?>
			</div>
			<div class="sp">
				<?= $form->field($model,'career')->textarea(['placeholder' => '个人生平']); ?>
			</div>
			<div class="zp">
				<?= $form->field($model,'pics[]')->fileInput(); ?>
				<br/>
				<span class="addmoreimg_art" style="margin-left:130px">添加一个</span>
			</div>		
			<div>
				<?= Html::submitButton('确定',['class' => 'addxx']) ?>

				<?php echo Html::resetButton('取消', ['class' => 'cancel']); ?>
			</div>
			<?php ActiveForm::end(); ?>
		</div>