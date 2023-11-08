<?php

require "connection.php";

$province =  $_POST["p"];


$distric_rs = Database::Search("SELECT * FROM `distric` INNER JOIN `province` ON `distric`.`province_p_id`=`province`.`p_id` WHERE `province_p_id`='".$province."' ");
$distric_num = $distric_rs->num_rows;

for($x = 0;$x<$distric_num;$x++){
    $distric_data = $distric_rs->fetch_assoc();
    ?>
    <option value="<?php echo($distric_data["d_id"]) ?>"><?php echo($distric_data["d_name"]) ?></option>
    <?php
}

?>