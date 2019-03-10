
		<div class="content">
			<div class="top">
				<div class="top-right">
					<img src="assets/admin/img/reny.png" />
					<span><?= Yii::$app->session['admin']['adminuser']; ?></span>
					<a href="<?php echo yii\helpers\Url::to(['public/logout']) ?>">退出</a>
				</div>
			</div>
			<div class="bottom clearfloat">
				<!-- <div class="shuju clearfloat" style="margin-left: 60px;">
					<img src="assets/admin/img/liul.png" />
					<span class="num"><?= $total['sum']; ?></span><br/>
					<span class="posi">资讯总浏览量</span>
				</div> -->
				<div class="shuju clearfloat" style="margin-left: 60px;">
					<img src="assets/admin/img/user.png" />
					<span class="num"><?= $total['user_num']; ?></span><br/>
					<span class="posi">用户数</span>
				</div>
				<div class="shuju clearfloat">
					<img src="assets/admin/img/fab.png" />
					<span class="num"><?= $total['show_num']; ?></span><br/>
					<span class="posi">展览发布量</span>
				</div>
				<div class="shuju clearfloat">
					<img src="assets/admin/img/liul.png" />
					<span class="num"><?= $total['news_num']; ?></span><br/>
					<span class="posi">资讯发布量</span>
				</div>
				<div class="shuju clearfloat">
					<img src="assets/admin/img/fab.png" />
					<span class="num"><?= $total['artist_num']; ?></span><br/>
					<span class="posi">艺术家数量</span>
				</div>
				
			</div>
			<div class="clearfloat">
				<p style="width: 90%;margin: 10px auto 20px;">点击率最高的发布</p>				
				<table class="clearfloat hsty-table">
					<tr class="th">
						<td>排名</td>
						<td>标题</td>
						<td style="width: 300px;">作者</td>
						<td>发布时间</td>
						<td>浏览量</td>
					</tr>
					<?php foreach($total['news'] as $k => $new): ?>
					<tr>
						<td><?= $k+1; ?></td>
						<td><?= $new->title; ?></td>
						<td><?= $new->author; ?></td>
						<td><?= date("Y-m-d H:m:s",$new->createtime); ?></td>
						<td><?= $new->num; ?></td>
					</tr>
					<?php endforeach; ?>

				</table>
				</div>
		</div>