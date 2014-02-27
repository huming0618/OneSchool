<?php
	$this->Html->script('jquery-2.0.3.min.js', array('block' => 'jsBlock'));
	$this->Html->script('bootstrap.js', array('block' => 'jsBlock'));
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
		<?php echo "登陆"; ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<?php
		echo $this->Html->meta('icon');
	
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('bootstrap-theme.min');
		echo $this->Html->css('site');
	?>
</head>
<body>
 	<?php echo $this->element('header') ?>
	<br>
	<div class="container" style="margin-top:40px;" name="message">
		<?php echo $this->fetch('content'); ?>
	</div>

	<?php echo $this->fetch('jsBlock'); ?>
</body>
</html>
