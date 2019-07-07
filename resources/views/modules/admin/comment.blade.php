@extends('admin.main_admin')
@section('content')
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Quản lý bình luận</h1>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          Đánh giá sản phẩm từ người dùng
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-4">
              <input type="text" id="search" class="form-control" style="margin-bottom: 16px;">
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="dataTables">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Mã số người dùng</th>
                  <th>Tên</th>
                  <th>Mã số sản phẩm</th>
                  <th>Tên sản phẩm</th>
                  <th>Ảnh</th>
                  <th>Đánh giá</th>
                  <th>Nội dung</th>
                  <th>Thời gian</th>
                </tr>
              </thead>
              <tbody>
               @foreach($comment as $cmt)
               <tr class="tr_s">
                <td>{{$loop->index}}</td>
                <td>{{$cmt->user_Id}}</td>
                <td>{{$cmt->user_name}}</td>
                <td>{{$cmt->product_Id}}</td>
                <td>{{DB::select("select `name` from product where id = ?" ,[$cmt->product_Id])[0]->name}}</td>
                <td>
                  <a href="{{URL::to('product-detail', $cmt->product_Id)}}" style="color: black"><img src="{{DB::select("select `image_link` from product where id = ?" ,[$cmt->product_Id])[0]->image_link}}" alt="product-image" width="100px"></a>
                </td>
                <td>
                  @if($cmt->rate === 0) 
                  Không đánh giá
                  @else
                  @for($i = 0; $i < $cmt->rate; $i++)
                  <i class="zmdi zmdi-star" style="color: #f1c40f"></i>
                  @endfor
                  @endif
                </td>
                <td>
                 <a href="{{URL::to('product-detail', $cmt->product_Id)}}" style="color: black">{{$cmt->content}}</a>
               </td>
               <td>
                {{$cmt->time}}
              </td>

            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.table-responsive -->
    </div>
    <!-- /.panel-body -->
  </div>
  <!-- /.panel -->
</div>
<!-- /.col-lg-12 -->
</div>
</div>
<!-- /#page-wrapper -->
@endsection