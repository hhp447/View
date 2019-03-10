

			<!DOCTYPE html>
			<html>
				<head>
					<meta charset="utf-8" />
					<title>VIEW后台管理</title>
					<link rel="stylesheet" href="assets/admin/css/style.css" />
				</head>
				<body>
					<nav class="clearfloat">
						<img src="assets/admin/img/logo.png" />
						<ul>
							<li><img src="assets/admin/img/home.png" /><a href="<?= yii\helpers\Url::to(['index/index']);  ?>">首页</a></li>
							<li><img src="assets/admin/img/reny.png" /><a href="<?= yii\helpers\Url::to(['user/index']);  ?>">用户管理</a></li>
							<li><img src="assets/admin/img/reny.png" /><a href="<?= yii\helpers\Url::to(['admin/index']);  ?>">管理员管理</a></li>
							<li><img src="assets/admin/img/zlgl.png" /><a href="<?= yii\helpers\Url::to(['show/index']);  ?>">展览管理</a></li>
							<li class="active"><img src="assets/admin/img/ys.png" /><a href="<?= yii\helpers\Url::to(['artist/index']);  ?>">艺术家管理</a></li>
							<li><img src="assets/admin/img/zx.png" /><a href="<?= yii\helpers\Url::to(['news/index']);  ?>">资讯管理</a></li>
							<li><img src="assets/admin/img/home.png" /><a href="<?= yii\helpers\Url::to(['suggestion/index']);  ?>">反馈</a></li>
						</ul>
					</nav>
					

		<?= $content;?>
				
		<script src="assets/admin/js/jquery-2.2.3.min.js"></script>
		<script src="assets/admin/js/common.js"></script>
	</body>
</html>
