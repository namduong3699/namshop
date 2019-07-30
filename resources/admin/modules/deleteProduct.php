<?php  
  include("../../connection.php");
  if(isset($_GET["id"])){
    $id = $_GET["id"];
    $sqlDel = "DELETE FROM product WHERE id=".$id ;
    mysqli_query($conn,$sqlDel) or die("không xóa đc");
    header("location:../index.php?view=listProduct");
  }
?>