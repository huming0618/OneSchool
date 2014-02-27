
<?php
	$this->layout = 'login_layout';
?>
<div class="login-blk row">
	<div class="left-img col-md-8">
		<?php echo $this->Html->image('LoginBG002.png',array('class' => 'stretch'));?>
	</div>
	<div class="login-form-panel panel panel-default col-md-3">
		<div class="panel-heading">
			<h3 class="panel-title">一村小捐助管理系统</h3>
		</div>
		<?php echo $this->Html->image('logo.jpeg',array('class' => 'logo center-block img-rounded','alt'=>'一村小'));?>
		<div class="login-form">
			
			<?php 
				if  ($this->Session->check('Message.auth')) $this->Session->flash('auth');
				echo $this->Form->create('Auth', array('action' => 'login')); 
			?>
			<input type="text" class="form-control" placeholder="用户名" name="username"/>
			<input type="password" class="form-control" placeholder="密码" name="password"/>
			<button type="submit" class="btn btn-primary btn-sm btn-block">登&nbsp;&nbsp;陆</button>
			<?php
					echo $this->Form->end();
			?>
		</div>
	</div>
</div>

			