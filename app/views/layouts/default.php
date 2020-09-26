<?php
use Core\Session;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title><?= $this->siteTitle('Home'); ?></title>

		<!-- Bootstrap -->
		<link href="<?=PROOT?>css/bootstrap.min.css" rel="stylesheet">
		<link href="<?=PROOT?>css/custom.css" rel="stylesheet">
		<script src="<?=PROOT?>js/jquery-3.2.1.min.js"></script>
		<script src="<?=PROOT?>js/bootstrap.min.js"></script>

		<?= $this->content('head'); ?>
	</head>
	<body>
		<?php include 'main_menu.php'; ?>
		<div class="container-fluid" style="min-height: cal(100% - 125px);">
			<?= Session::displayMsg(); ?>
			<?= $this->content('body'); ?>
		</div>
	</body>
</html>