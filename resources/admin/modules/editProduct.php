<?php  
    include("../function.php");
    $name="";
    $images="";
    $title="";
    $status = "";

    if(isset($_GET["id"])){
      $table="product";
      $condition = " id = ".$_GET["id"];
      $field = "*";

      $row = getById($table,$field,$condition);
      $row2 = getInfoRow("product", "*", "id = ".$_GET["id"]);

      $name = $row[1];
      $images = $row[2];
      $title = $row[3];
      $status = ($row[4])?"checked":"";

    }
    $path = "../uploads/";
      $url="uploads/";
      $urlFile ="";
    if(isset($_POST["addNew"])){
      $table = "product";
      $_POST["dateCreate"] = date("Y-m-d H:i:s");
      $id = $_GET["id"];
      if(isset($_FILES["images"]["name"])){
        if($_FILES["images"]["type"]=="image/png" ||$_FILES["images"]["type"]=="image/jpg" || $_FILES["images"]["type"]=="image/jpeg" || $_FILES["images"]["type"]=="image/gif" ){
          if($_FILES["images"]["size"] <=187696){
            //đưa file vào thư mục xác định trên server
            move_uploaded_file($_FILES["images"]["tmp_name"], $path .$_FILES["images"]["name"]);
            $urlFile .= $url.$_FILES["images"]["name"];
            $images = $url.$_FILES["images"]["name"];
          }else{
            echo "File lớn quá";
          }

        }else{
          echo "định dang file phải là ảnh";
        }
      }else{
        $images = $images;
      }
      $_POST["images"] = $images;
      save($table,$_POST,$id);
      header("location:index.php?view=listProduct");
    }
  ?>
<div class="row">
<div class="col-lg-6">
  <div class="card">
    <div class="card-header">Them moi danh muc</div>
    <div class="card-body card-block">
      <form action="" method="post" class="" enctype="multipart/form-data">
        <div class="form-group">
          <label for="cc-payment" class="control-label mb-1">Tên sản phẩm</label>
          <input id="nameProduct" name="nameProduct" class="form-control" aria-required="true" value="<?php echo $row2["nameProduct"]?>" type="text">
        </div>
        <div class="form-group">
          <label for="cc-payment" class="control-label mb-1">Ảnh sản phẩm:</label> <br>
          <div style="margin: 0px auto 20px ; width: 300px;">
            <img src="../<?php echo $row2["images"]?>" alt="" width="300px" height="auto">
          </div>
          
          <input id="images" name="images" class="form-control" aria-required="true" value="" type="file">
        </div>
        <div class="form-group">
          <label for="cc-payment" class="control-label mb-1">Giá</label>
          <input id="price" name="price" class="form-control" aria-required="true" value="<?php echo $row2["price"].'$'?>" type="text">
        </div>
        <div class="form-group">
          <label for="cc-payment" class="control-label mb-1">Giảm giá</label>
          <input id="sale_of" name="sale_of" class="form-control" aria-required="true" value="<?php echo $row2["sale_of"].'%'?>" type="text">
        </div>
        <div class="form-group">
          <label for="cc-payment" class="control-label mb-1">Loại hàng</label>
          <input id="cat_id" name="cat_id" class="form-control" aria-required="true" value="<?php  
          echo catIdToCat($row2['cat_id']) ?>" type="text">
        </div>
        <div class="form-group">
          <label for="cc-payment" class="control-label mb-1">Số lượng</label>
          <input id="amount" name="amount" class="form-control" aria-required="true" value="<?php echo $row2["amount"]?>" type="text">
        </div>
        <div class="form-group">
          <label for="cc-payment" class="control-label mb-1">Mô tả</label>
          <input id="description" name="description" class="form-control" aria-required="true" value="<?php echo $row2["description"]?>" type="text">
        </div>
        <div class="form-check">
          <div class="checkbox">
            <label for="checkbox1" class="form-check-label ">
              <input id="status" name="status" value="<?php echo $row2["status"]?>" class="form-check-input" type="checkbox">Trạng thái
            </label>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary btn-sm" name="addNew">
            <i class="fa fa-dot-circle-o"></i> Submit
          </button>
          <button type="reset" class="btn btn-danger btn-sm">
            <i class="fa fa-ban"></i> Reset
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

</div>