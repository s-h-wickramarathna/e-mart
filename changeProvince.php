<?php
require "connection.php";


$cntry = $_GET["c"];


$p_rs = Database::Search("SELECT * FROM `province` INNER JOIN `country_has_province` ON `province`.`p_id`=`country_has_province`.`province_p_id`
INNER JOIN `country` ON `country_has_province`.`Country_cntry_id`=`country`.`cntry_id` WHERE `cntry_id`='".$cntry."' ");
$p_num = $p_rs->num_rows;

for($x = 0;$x<$p_num;$x++){
    $p_data = $p_rs->fetch_assoc();

    ?>
    <option value="<?php echo($p_data["p_id"]);?>"><?php echo($p_data["p_name"]) ?></option>
    <?php

}

?>