<header class="navbar navbar-inverse navbar-fixed-top" role="banner">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <?php echo $this->Html->link("一村小 管理系统","/message", array("class"=>"navbar-brand")); ?>
        </div>
        <div class="collapse navbar-collapse">
          <?php
            if(!isset($pageAbout)){
                $pageAbout = "Home";
            }
          ?>
          <ul class="nav navbar-nav">
            <li <?php if($pageAbout == "Message"){?>class="active"<?php } ?>>
                <?php echo $this->Html->link("消息面板","/message"); ?>
            </li>
            <li <?php if($pageAbout == "Donation"){?>class="active"<?php } ?>>
                <?php echo $this->Html->link("捐助","/donation"); ?>
            </li>
            <li <?php if($pageAbout == "Student"){?>class="active"<?php } ?>>
                <?php echo $this->Html->link("学生","/student"); ?>
            </li>
            <li <?php if($pageAbout == "Donator"){?>class="active"<?php } ?>>
                <?php echo $this->Html->link("捐助人","/donator"); ?>
            </li>
            <li <?php if($pageAbout == "School"){?>class="active"<?php } ?>>
                <?php echo $this->Html->link("学校","/school"); ?>
            </li>
            <li <?php if($pageAbout == "System"){?>class="active"<?php } ?>>
                <?php echo $this->Html->link('系统管理','/admin/manageUsers'); ?>
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