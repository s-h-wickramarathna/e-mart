<?php
require "connection.php";

$itm = $_GET["sitems"];

echo($itm);

$rs = Database::Search("SELECT * FROM `Product` WHERE `title` LIKE '%". $itm . "%' AND `qty`<>'0' AND `status_s_id`='1' AND `admin_status`='1' LIMIT 8 ");
$n = $rs->num_rows;

for ($x = 0; $x < $n; $x++) {
    $d = $rs->fetch_assoc();
?>

   <div class="row p-2 g-2" id="productListText">
       <a class="col-10 cursor text-decoration-none" href="searchProduct.php?text=<?php echo($d["title"])?>"><?php echo($d["title"]); ?></a>
       <div class="col-1 d-flex justify-content-center align-items-center" onclick="searchproducttext('<?php echo($d['title']) ?>');"><i class="bi bi-box-arrow-in-up-left cursor"></i></div>
   </div>

<?php
}

?>