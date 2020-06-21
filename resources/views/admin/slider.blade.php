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
                    Tạo silder
                </div>
             <div class="panel-body showbody">
                <div class="row">
                <div class="col-lg-12">
                <form role="form" name="product" method="post" action="{{route('addslide')}}" enctype="multipart/form-data" >
                      <input type="hidden" name="_token" value="{{csrf_token()}}">

                <div class="col-sm-6">
                <div class="form-group">
                        <label>Tiêu đề</label>
                        <input name="title" class="form-control" placeholder="Enter text">
                </div>
                 <div class="form-group">
                    <label>Nội dung</label>
                    <input name="content" type="text" class="form-control" placeholder="Enter text">
                </div>
                <div class="form-group">
                    <label>Click</label>
                    <input name="button" type="text" class="form-control" placeholder="Enter text">
                </div>
                </div>

                <div class="col-sm-6">
                <div class="form-group">
                    <label>Link</label>
                    <input name="link" type="text" class="form-control" placeholder="Enter text">
                </div>
                <div class="form-group">
                    <label>Ảnh Slider</label>
                    <input name="image" type="file">
                </div>
                 </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-default">Thêm</button>
                    <button type="reset" class="btn btn-default">Xóa hết</button>
                </div>
            </form>
            </div>
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
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Bản sản phẩm
                <input type="checkbox"  style="
                float: right; display: block;margin-left:16px;" id='select_all' ><a href="admin/slide" id="deleteall" style="
                float: right;
                ">Delete All</a>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form action="{{route('deleteall')}}" method="post" id="deleteForm">
                 <input type="hidden" name="table" value="slide">
                 <input type="hidden" name="_token" value="{{csrf_token()}}">
                 <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tiêu đề</th>
                                <th>Mã số</th>
                                <th>Nội dung</th>
                                <th>Click</th>
                                <th>Link</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                         <?php $i=1; ?>
                         @foreach($data as $value)
                         <tr class="tr_s">
                            <th>{{$i++}}</th>
                            <th>{{$value->title}}</th>
                            <th>{{$value->content}}</th>
                            <th>{{$value->button}}</th>
                            <th>{{$value->link}}</th>
                            <th><a href="{{'images/slides/'.$value->image}}">{{$value->image}}</a></th>
                            <th><input type="checkbox" name='deleteall[]' value="{{$value->id}}"></th>
                            <th><a href="{{URL::to('admin/slide/edit', $value->id)}}" target="_blank"><i class="fa fa-edit"></i></a></th>
                            <th><a href="{{URL::to('admin/slide/delete', $value->id)}}"><i class="fa fa-trash"></i></a></th>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </form>
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
@section('js')

$(function() {
$('#deleteall').on('click',function(event) {
event.preventDefault();
$('#deleteForm').submit();
/* Act on the event */
});
$('#select_all').click(function(event) {
if(this.checked) {
// Iterate each checkbox
$(':checkbox').each(function() {
this.checked = true;
});
}
else {
$(':checkbox').each(function() {
this.checked = false;
});
}
});
});
@endsection