<?php  
include("../function.php");
$result = getAll("product");
$category = getALL("category");
?>
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <strong class="card-title">Danh sách sản phẩm</strong>
      </div>
      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Tên SP</th>
              <th>Ảnh</th>
              <th>Giá</th>
              <th>Giảm giá</th>
              <th>Loại hàng</th>
              <th>Số lượng</th>
              <th>Trạng thái</th>
              <th>Ngày cập nhật</th>
              <th>Hành động</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i=0;
            while ($row = mysqli_fetch_assoc($result)) {
              $i++;
              ?>
              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row["nameProduct"]?></td>
                <td><img src="../<?php echo $row["images"]?>" alt="" width="300px" height="auto"></td>
                <td><?php echo $row['price'].'$' ?></td>
                <td><?php echo ($row['sale_of'] == NULL)?'0%':$row['sale_of'].'%' ?></td>
                <td><?php $temp = getById("category", "name", "id = ".$row['cat_id']); echo $temp[0] ?></td>
                <td><?php echo ($row["amount"]) ?></td>
                <td><?php echo ($row["status"])?"Hiển thị":"Ẩn" ?></td>
                <td><?php echo date("d-m-Y",strtotime($row["dateCreate"])) ?></td>
                <td>
                  <div >
                    <a href="index.php?view=editProduct&id=<?php echo $row["id"] ?>">
                      <i class="fa fa-edit"></i>
                      Edit&nbsp;&nbsp; 
                    </a>
                    <a href="index.php?view=deleteProduct&id=<?php echo $row["id"] ?>">
                      <i class="fa fa-trash-o"></i>
                      <!-- Delete -->
                      <a href="modules/deleteProduct.php?id=<?php echo $row["id"] ?>">Delete</a>
                    </a>
                  </div>
                </td>
              </tr>
              <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>