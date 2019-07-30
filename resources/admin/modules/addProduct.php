<?php  
    include("../function.php");
    if(isset($_POST["addNew"])){
      $table = "product";
      $_POST["dateCreate"] = date("Y-m-d H:i:s");
      $path = "../uploads/product/";
      $url="uploads/product/";
      $urlFile ="";
      if(isset($_FILES["images"]["name"])){
        if($_FILES["images"]["type"]=="image/png" ||$_FILES["images"]["type"]=="image/jpg" || $_FILES["images"]["type"]=="image/jpeg" || $_FILES["images"]["type"]=="image/gif" ){
          if($_FILES["images"]["size"] <=187696){
            //đưa file vào thư mục xác định trên server
            move_uploaded_file($_FILES["images"]["tmp_name"], $path .$_FILES["images"]["name"]);
            $urlFile .= $url.$_FILES["images"]["name"];
          }else{
            echo "File lớn quá";
          }

        }else{
          echo "định dang file phải là ảnh";
        }
      }else{
        echo "Không tồn tại file";
      }
      $_POST["images"]=$urlFile;
      save($table,$_POST);
      header("location:index.php?view=listProduct");
    }
  ?>
<!-- <div class="row">
<div class="col-lg-6">
  <div class="card">
    <div class="card-header">Thêm mới sản phẩm</div>
    <div class="card-body card-block">
      <form action="" method="post" class="" enctype="multipart/form-data">
        <div class="form-group">
          <label for="cc-payment" class="control-label mb-1">Tên sản phẩm</label>
          <input id="nameProduct" name="nameProduct" class="form-control" aria-required="true" value="" type="text">
        </div>
        <div class="form-group">
          <label for="cc-payment" class="control-label mb-1">Ảnh sản phẩm</label>
          <input id="images" name="images" class="form-control" aria-required="true" value="" type="file">
        </div>
        <div class="form-group">
          <label for="cc-payment" class="control-label mb-1">Giá</label>
          <input id="price" name="price" class="form-control" aria-required="true" value="" type="text">
        </div>
        <div class="form-group">
          <label for="cc-payment" class="control-label mb-1">Mô tả</label>
          <input id="description" name="description" class="form-control" aria-required="true" value="" type="text">
        </div>
        <div class="form-check">
          <div class="checkbox">
            <label for="checkbox1" class="form-check-label ">
              <input id="status" name="status" value="1" class="form-check-input" type="checkbox">Trạng thái
            </label>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary btn-sm" name="addNew">
            <i class="fa fa-dot-circle-o"></i> Thêm sản phẩm
          </button>
          <button type="reset" class="btn btn-danger btn-sm">
            <i class="fa fa-ban"></i> Tải lại
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

</div> -->

<div class="row">
<div class="col-lg-6">
  <div class="card">
    <div class="card-header">Them moi danh muc</div>
    <div class="card-body card-block">
      <form action="" method="post" class="" enctype="multipart/form-data">
        <div class="form-group">
          <label for="cc-payment" class="control-label mb-1">Tên sản phẩm</label>
          <input id="nameProduct" name="nameProduct" class="form-control" aria-required="true" value="" type="text">
        </div>
        <div class="form-group">
          <label for="cc-payment" class="control-label mb-1">Ảnh sản phẩm:</label> <br>
          <div style="margin: 0px auto 20px ; width: 300px;">
            <img src="" alt="" width="300px" height="auto">
          </div>
          
          <input id="images" name="images" class="form-control" aria-required="true" value="" type="file">
        </div>
        <div class="form-group">
          <label for="cc-payment" class="control-label mb-1">Giá</label>
          <input id="price" name="price" class="form-control" aria-required="true" value="" type="text">
        </div>
        <div class="form-group">
          <label for="cc-payment" class="control-label mb-1">Giảm giá</label>
          <input id="sale_of" name="sale_of" class="form-control" aria-required="true" value="" type="text">
        </div>
        <div class="form-group">
          <label for="cc-payment" class="control-label mb-1">Loại hàng</label>
          <input id="cat_id" name="cat_id" class="form-control" aria-required="true" value="" type="text">
        </div>
        <div class="form-group">
          <label for="cc-payment" class="control-label mb-1">Số lượng</label>
          <input id="amount" name="amount" class="form-control" aria-required="true" value="" type="text">
        </div>
        <div class="form-group">
          <label for="cc-payment" class="control-label mb-1">Mô tả</label>
          <input id="description" name="description" class="form-control" aria-required="true" value="" type="text">
        </div>
        <div class="form-check">
          <div class="checkbox">
            <label for="checkbox1" class="form-check-label ">
              <input id="status" name="status" value="" class="form-check-input" type="checkbox">Trạng thái
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