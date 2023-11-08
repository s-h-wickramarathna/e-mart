<?php
require "connection.php";

if(isset($_GET["t"])){
    $colour = $_GET["t"];

    $colour_rs = Database::Search("SELECT * FROM `colour` WHERE `clr_name` LIKE '%".$colour."%' ");
    $colour_num = $colour_rs->num_rows;

    if($colour_num == 0){
        $add_colour = ucwords($colour);
        
        Database::iud("INSERT INTO `colour` (`clr_name`) VALUES ('".$add_colour."') ");

        $colourb_rs = Database::Search("SELECT * FROM `colour` WHERE `clr_name` LIKE '%".$colour."%' ");
        $colourb_num = $colourb_rs->num_rows;

        if($colourb_num > 0){

            $colourf_rs = Database::Search("SELECT * FROM `colour` ORDER BY `clr_id` DESC");
            $colourf_num = $colourf_rs->num_rows;

            for ($c=0; $c < $colourf_num ; $c++) { 
                $colour_data = $colourf_rs->fetch_assoc();

                ?>
                <option value="<?php echo($colour_data["clr_id"]) ?>"><?php echo($colour_data["clr_name"]) ?></option>
                <?php

            }

        }

    }else{
        echo("This Colour Already Exist ....");
    }

}

?>