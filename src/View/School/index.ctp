<h1>学校列表</h1>
<table class="table">
    <thead>
        <tr>
            <th>学校</th>
            <th>所在地</th>
            <th>联系方式</th>
            <th>合作学校</th>
            <th>学生联系人</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($schools as $school):?>
        <tr>
            <td><?php echo $school["School"]["name"] ?></td>
            <td><?php echo $school["School"]["address"] ?></td>
            <td><?php echo $school["School"]["main_contact"] ?></td>
            <td><?php echo $school["School"]["cooperate"]?"是":"否" ?></td>
            <td><?php echo $school["School"]["student_contact"] ?></td>
        </tr>
        <?php endforeach; ?>
        <?php unset($schools); ?>
    </tbody>
</table>