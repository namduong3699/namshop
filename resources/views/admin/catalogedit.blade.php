@extends('admin.main_admin')
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Quản lý danh mục</h1>
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
                        <form role="form" name="addcatalog" method="post" action="{{route('updatecatalog')}}">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label>Tên danh mục </label>
                                    </div>
                                    <div class="col-lg-10">
                                        <input name="id" type="hidden" class="form-control" value="{{$data->id}}">
                                        <input name="name" class="form-control" placeholder="Tên danh mục" value="{{$data->name}}">
                                    </div>
                                </div>
                                {!!session('add')!!}
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
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- nhập tên danh mục -->
<!-- /.row -->
<!-- /.row -->
</div>
            <!-- /#page-wrapper -->
@endsection