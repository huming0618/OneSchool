<?php //print_r($school) ?>
<div class="row">
    <ol class="breadcrumb">
        <li><a href="#">学校列表</a></li>
        <li><a href="#" class="large"><?php echo($school["School"]["name"])?></a></li>
    </ol>
</div>
<div class="row">
    <dl class="plane">
        <dt><span class="glyphicon glyphicon-envelope"></span>&nbsp;地址</dt>
        <dd><?php echo($school["School"]["address"])?></dd>
        <dt><span class="glyphicon glyphicon-home"></span>&nbsp;汇款地址</dt>
        <dd><?php echo($school["School"]["bankact_address"])?></dd>
        <dt><span class="glyphicon glyphicon-phone-alt"></span>&nbsp;主要联系人</dt>
        <dd><?php echo($school["School"]["main_contact"])?></dd>
        <dt><span class="glyphicon glyphicon-phone-alt"></span>&nbsp;其他联系人</dt>
        <dd><?php echo($school["School"]["other_contact"])?></dd>
    </dl>
</div>
<div class="row">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li class="active"><a href="#donations" role="tab" data-toggle="tab">学生捐助记录</a></li>
      <li><a href="#schedule" role="tab" data-toggle="tab">学期管理</a></li>
      <li><a href="#profile" role="tab" data-toggle="tab">回访记录</a></li>
      <li><a href="#about" role="tab" data-toggle="tab">学校简介</a></li>
    </ul>
    
    <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane active" id="donations">
        <table class="table">
            <thead>
                <tr>
                    <th>学生</th>
                    <th>捐助人</th>
                    <th>状态</th>
                    <th>备注</th>
                    <th>年级</th>
                    <th>学期</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($school["SchoolDonation"] as $donation):?>
                <tr>
                    <td><?php echo $donation["student"] ?></td>
                    <td><?php echo $donation["donator"] ?></td>
                    <td><?php echo $donation["status"] ?></td>
                    <td><?php echo $donation["brief"] ?></td>
                    <td><?php echo $donation["grade"] ?></td>
                    <td><?php echo $donation["semester"] ?></td>
                </tr>
                <?php endforeach; ?>
                <?php unset($schools); ?>
            </tbody>
        </table>
      </div>
      <div class="tab-pane" id="schedule">
        <table class="table">
            <thead>
                <tr>
                    <th>学年</th>
                    <th>年级</th>
                    <th>学期</th>
                    <th>开始日期</th>
                    <th>结束日期</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($school["SchoolSchedules"] as $donation):?>
                <tr>
                    <td><?php echo $donation["year"] ?></td>
                    <td><?php echo $donation["grade"] ?></td>
                    <td><?php echo $donation["semester"] ?></td>
                    <td><?php echo $donation["startdate"] ?></td>
                    <td><?php echo $donation["enddate"] ?></td>
                </tr>
                <?php endforeach; ?>
                <?php unset($schools); ?>
            </tbody>
        </table>
      </div>
      <div class="tab-pane" id="messages">
          
      </div>
      <div class="tab-pane" id="about">
          <?php echo($school["School"]["size"])?>
      </div>
    </div>
</div>