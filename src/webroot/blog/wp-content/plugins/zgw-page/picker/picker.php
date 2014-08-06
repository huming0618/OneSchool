<?php
    $multi_site = is_multisite();
?>
<div>
<?php 
    if($multi_site){
        include_once('switch-site.php');
    }
?>
</div>