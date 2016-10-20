<?php print_r($student) ?>
<div class="row">
    <div class="media">
        <a class="pull-left" href="#">
            <img class="media-object" style="height:70px;width:auto" src="<?php echo $this->webroot."files/".$student_portrait?>" alt="<?php echo($student["User"]["name"])?>">
        </a>
        <div class="media-body">
            <h2 class="media-heading"><?php echo($student["User"]["name"])?></h2>
            <small>&nbsp;<?php echo($student["User"]["sid"])?></small>
        </div>
  </div>
</div>
<div class="row">
    <dl class="plane">
        <dt><span class="glyphicon glyphicon-envelope"></span>&nbsp;所在地</dt>
        <dd><?php echo($student["User"]["address"])?></dd>
        <dt><span class="glyphicon glyphicon-envelope"></span>&nbsp;联系方式</dt>
        <dd><?php echo($student["User"]["phone"])?></dd>
        <dt><span class="glyphicon glyphicon-envelope"></span>&nbsp;学校</dt>
        <?php 
            $donations = $student["StudentDonation"];
            $mySchool = "";
            $myGrade = "";
            if(!empty($donations)){
                $mySchool = $donations[0]["name"];
                $grade = $donations[0]["grade"];
                $donation_status = $donations[0]['status'];
            }
        ?>
        <dd><?php echo($mySchool." ".$grade)?></dd>
    </dl>
</div>
<div class="row">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li class="active"><a href="#contacts" role="tab" data-toggle="tab">联系方式</a></li>
      <li><a href="#schools" role="tab" data-toggle="tab">学校记录</a></li>
      <li><a href="#bankaccount" role="tab" data-toggle="tab">账户信息</a></li>
      <li><a href="#donations" role="tab" data-toggle="tab">捐助记录</a></li>
      <li><a href="#feedbacks" role="tab" data-toggle="tab">回访记录</a></li>
    </ul>
    
    <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane active" id="contacts">
        <table class="table">
             <thead>
                <tr>
                    <th>联系人</th>
                    <th>关系</th>
                    <th>电话</th>
                    <th>备注</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($student["Contact"] as $contact):?>
                <tr>
                    <td><?php echo $contact["contact"] ?></td>
                    <td><?php echo $contact["type"] ?></td>
                    <td><?php echo $contact["phone"] ?></td>
                    <td><?php echo $contact["remark"] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
      </div>
      <div class="tab-pane" id="schools">
        <table class="table">
            <thead>
                <tr>
                    <th>学校</th>
                    <th>年级</th>
                    <th>班级</th>
                    <th>学期</th>
                    <th>学期开始</th>
                    <th>学期结束</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($student["StudentDonation"] as $donation):?>
                <tr>
                    <td><?php echo $donation["name"] ?></td>
                    <td><?php echo $donation["grade"] ?></td>
                    <td><?php echo $donation["student_class"] ?></td>
                    <td><?php echo $donation["semester"] ?></td>
                    <td><?php echo $donation["semester_start"] ?></td>
                    <td><?php echo $donation["semester_end"] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
      </div>
      <div class="tab-pane" id="bankaccount">
        <table class="table">
            <thead>
                <tr>
                    <th>类型</th>
                    <th>汇款账户/地址</th>
                    <th>收款人</th>
                    <th>备注</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($student["BankAccount"] as $bankact):
                    $backact_type = $bankact["type"] == "S" ? "学校账户" : "个人账户";
                    $backact_no = $bankact["type"] == "S" ? $bankact["address"] : $bankact["bank"]." ".$bankact["account"];
                ?>
                    
                <tr>
                    <td><?php echo $backact_type ?></td>
                    <td><?php echo $backact_no ?></td>
                    <td><?php echo $bankact["account_name"] ?></td>
                    <td><?php echo $bankact["account_remark"] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
      </div>
      <div class="tab-pane" id="donations">
        <table class="table">
            <thead>
                <tr>
                    <th>捐助人</th>
                    <th>状态</th>
                    <th>学校</th>
                    <th>年级</th>
                    <th>班级</th>
                    <th>学期</th>
                    <th>学期开始</th>
                    <th>学期结束</th>
                </tr>
           </thead>
           <tbody>
           <?php foreach($student["StudentDonation"] as $donation):?>
                <tr>
                    <td><?php echo $donation["donator"] ?></td>
                    <td><?php echo $donation["brief"] ?></td>
                    <td><?php echo $donation["name"] ?></td>
                    <td><?php echo $donation["grade"] ?></td>
                    <td><?php echo $donation["student_class"] ?></td>
                    <td><?php echo $donation["semester"] ?></td>
                    <td><?php echo $donation["semester_start"] ?></td>
                    <td><?php echo $donation["semester_end"] ?></td>
                </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
       </div>
       <div id="feedbacks">
           
       </div>
     </div>