@extends('admin.main_admin')
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Tables</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                     Nhập tên danh mục
                 </div>
                 <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                         <form role="form" name="product" method="post" action="{{route('updateproduct')}}" enctype="multipart/form-data" >
                         	<input type="hidden" name="_token" value="{{csrf_token()}}">
                         	<input type="hidden" name="id" value="{{$data->id}}">
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input name="name" class="form-control" placeholder="Enter text" value="{{$data->name}}">
                            </div>
                            <div class="form-group">
                                <label>Danh mục</label>
                                <select name="catalog_id" class="form-control">

                                	@foreach($dataCatalog as $value)
                                	@if($data->catalog_id==$value->id)
                                    <option value="{{$value->id}}" selected>{{$value->name}}</option>
                                    @else
                                     <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div> 
                            <input type="hidden" name="catalog_id_old" value="{{$data->catalog_id}}">
                            <div class="form-group">
                                <label>Số lượng</label>
                                <input name="count" type="number" class="form-control" placeholder="Enter text" value="{{$data->count}}">
                            </div>
                            <div class="form-group">
                                <label>Giá tiền</label>
                                <input name="price" type="number" class="form-control" placeholder="Enter text" value="{{$data->price}}">
                            </div>
                            <div class="form-group">
                                <label>Giảm giá</label>
                                <input name="discount" type="number" class="form-control" placeholder="Enter text" value="{{$data->discount}}" >
                            </div>
                            <div class="form-group">
                                <label>Kích thước</label>
                                <input name="size" class="form-control" placeholder="Enter text" value="{{$data->size}}"> 
                            </div>
                            <div class="form-group">
                                <label>Màu sắc</label>
                                <input name="color" class="form-control" placeholder="Enter text" value="{{$data->color}}">
                            </div>
                            <div class="form-group">
                                <label>Ảnh</label>
                                <input name="image[]" type="file" multiple>
                                <input type="hidden" name="folder" value="{{$data->folder}}">
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea name="description" class="form-control" rows="3">{{$data->description}}</textarea>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-default">Sửa</button>
                                <button type="reset" class="btn btn-default">Xóa hết</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.col-lg-6 (nested) -->
                    <!-- /.col-lg-6 (nested) -->
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
    <!-- /.col-lg-12 -->
</div>
</div>
            <!-- /#page-wrapper -->
@endsection
