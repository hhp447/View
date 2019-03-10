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
				<table class="clearfloat hsty-table">
					<tr class="th">
						<th>姓名</th>
						<th>联系方式</th>
						<th>意见</th>
						<th style="width: 300px;">反馈时间</th>
						<th>操作</th>
					</tr>
				<?php foreach($sugs as $sug): ?>
					<tr>
						<td><?= $sug->name; ?></td>
						<td><?= $sug->phone; ?></td>
						<td><?= $sug->suggest; ?></td>
						<td><?= date("Y-m-d H:m:s",$sug->createtime); ?></td>
						
						
						<td>
						<a href="<?= yii\helpers\Url::to(['suggestion/index','sugid' => $sug->sugid]); ?>">
							<button>删除</button>
						</a>
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