<?php  
    include("../function.php");
    if(isset($_POST["addNew"])){
      $table = "color";
      $_POST["dateCreate"] = date("Y-m-d H:i:s");
      save($table,$_POST);
      header("location:index.php");
    }
  ?>
<div class="row">
<div class="col-lg-6">
  <div class="card">
    <div class="card-header">Them moi mau</div>
    <div class="card-body card-block">
      <form action="" method="post" class="">
        <div class="form-group">
          <label for="cc-payment" class="control-label mb-1">Ten mau</label>
          <input id="name" name="name" class="form-control" aria-required="true" value="" type="text">
        </div>
        <div class="form-group">
          <label for="cc-payment" class="control-label mb-1">ma mau</label>
          <input id="code" name="code" class="form-control" aria-required="true" value="" type="color">
        </div>
        <div class="form-check">
          <div class="checkbox">
            <label for="checkbox1" class="form-check-label ">
              <input id="status" name="status" value="1" class="form-check-input" type="checkbox">Trang thai
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