<?php

require "connection.php";

if($_GET["b"]){
    $brand = $_GET["b"];

$model_rs = Database::Search("SELECT * FROM `model_has_brand` WHERE `brand_id`='".$brand."' ");
$model_num = $model_rs->num_rows;


for ($i=0; $i < $model_num ; $i++) { 
    $model_data = $model_rs->fetch_assoc();

    $m_rs = Database::Search("SELECT * FROM `model` WHERE `m_id`='".$model_data["model_id"]."' ");
    $m_num = $m_rs->num_rows;
    
    for ($x=0; $x <$m_num ; $x++) { 
        $m_data = $m_rs->fetch_assoc();
        
        ?>
         <option value="<?php echo($m_data["m_id"]) ?>"><?php echo($m_data["m_name"]) ?></option>
        
        <?php


    }


    ?>
    
    <?php
}
    
}else{
    echo("Somthing Went Wrong");
}


?>