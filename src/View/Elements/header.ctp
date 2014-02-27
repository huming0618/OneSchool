<header class="navbar navbar-inverse navbar-fixed-top" role="banner">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">一村小 管理系统</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#message">消息</a></li>
            <li><a href="#donation">捐助</a></li>
            <li>
            	<?php 
            		echo $this->Html->link('系统','/admin/manageUsers');
				?>
            </li>
          </ul>
          <form class="navbar-form navbar-right" role="search">
		  <div class="form-group">
		    <input type="text" class="form-control" placeholder="查询">
		  </div>
		  <button type="button" class="btn btn-default">Submit</button>
		  </form>
        </div><!--/.nav-collapse -->


      </div>
    </header>