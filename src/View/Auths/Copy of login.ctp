
<div class="background">
	<?php echo $this->Html->image('LoginBG002.png',array('class' => 'stretch'));?>
</div>
<div class="login-blk panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">一村小捐助管理系统</h3>
	</div>
	<div class="login-form">
			<?php echo $this->Html->image('logo.jpeg',array('class' => 'logo center-block img-rounded','alt'=>'一村小'));?>
			<?php 
				if  ($this->Session->check('Message.auth')) $this->Session->flash('auth');
				echo $this->Form->create('Auth', array('action' => 'login')); 
			?>
				<input type="text" class="form-control" placeholder="用户名" name="username"/>
				<input type="password" class="form-control" placeholder="密码" type="password" name="password"/>
				<button type="submit" class="btn btn-primary btn-sm btn-block">登陆</button>
			<?php
				echo $this->Form->end();
			?>
	</div>
</div>
	

			