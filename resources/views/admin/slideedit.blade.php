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
                    Nhập slide
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                           <form role="form" name="product" method="post" action="{{route('updateslide')}}" enctype="multipart/form-data" >
                              <input type="hidden" name="_token" value="{{csrf_token()}}">
                              <input type="hidden" name="id" value="{{$data->id}}">
                              
                                <div class="form-group">
                                    <label>Tiêu đề</label>
                                    <input name="title" class="form-control" placeholder="Enter text" value="{{$data->title}}">
                                </div>
                                <div class="form-group">
                                    <label>Nội dung</label>
                                    <input name="content" type="text" class="form-control" placeholder="Enter text" value="{{$data->content}}">
                                </div>
                                <div class="form-group">
                                    <label>Click</label>
                                    <input name="button" type="text" class="form-control" placeholder="Enter text" value="{{$data->button}}">
                                </div>
                                <div class="form-group">
                                    <label>Link</label>
                                    <input name="link" type="text" class="form-control" placeholder="Enter text" value="{{$data->link}}">
                                </div>
                                <div class="form-group">
                                    <label>Ảnh Slider</label>
                                    <input name="image" type="file">
                                </div>
                                <div class="form-group">
                                    <label>Ảnh Slider thumb (Ảnh nhỏ)</label>
                                    <input name="thumb" type="file" >
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
