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
        <?php foreach($donations as $donation):?>
        <tr>
            <td><?php echo $donation["ViewDonation"]["student"] ?></td>
            <td><?php echo $school["ViewDonation"]["donator"] ?></td>
            <td><?php echo $school["ViewDonation"]["status"] ?></td>
            <td><?php echo $school["ViewDonation"]["brief"] ?></td>
            <td><?php echo $school["ViewDonation"]["grade"] ?></td>
            <td><?php echo $school["ViewDonation"]["semester_startdate"] ?></td>
        </tr>
        <?php endforeach; ?>
        <?php unset($schools); ?>
    </tbody>
</table>
