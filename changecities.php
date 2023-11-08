<?php

require "connection.php";

$district = $_GET["d"];

echo($district);

$city_rs = Database::Search("SELECT * FROM `city` WHERE `distric_id`='".$district."'");
$city_num = $city_rs->num_rows;

for ($i=0;$i<$city_num;$i++) { 
    $city_data = $city_rs->fetch_assoc();
    ?>
    <option value="<?php echo($city_data["ci_id"]) ?>"><?php echo($city_data["ci_name"]) ?></option>
    <?php
}


?>