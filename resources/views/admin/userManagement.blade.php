@extends('admin.main_admin')
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Quản lý người dùng</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Quản lý người dùng
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
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Quyền</th>
                                    <th>Địa chỉ</th>
                                    <th>Trong túi</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php $i=1; ?>
                            	@foreach($data as $value)
                            	<tr class="tr_s">
                                    <th>{{$i++}}</th>
                                    <th>{{$value->id}}</th>
                                    <th>{{$value->name}}</th>
                                    <th>{{$value->email}}</th>
                                    <th>{{$value->phone}}</th>
                                    <th>
                                    	@if($value->level==0)
                                    	Bình thường
                                    	@else
                                    	Admin
                                    	@endif
                                    </th>
                                    <th>
                                        @if($value->address !== null)

                                        {{json_decode($value->address, true)['tinh']}},
                                        {{json_decode($value->address, true)['huyen']}},
                                        {{json_decode($value->address, true)['xa']}}
                                        @else
                                        Không có thông tin
                                        @endif
                                    </th>
                                    <th>
                                       @if($value->inbag !== null)
                                       @foreach(json_decode($value->inbag, true) as $item => $value)
                                            @if($loop->index === 0)
                                                {{$value['name']}}
                                            @else
                                                , {{$value['name']}}
                                            @endif
                                       @endforeach
                                       @else
                                       Giỏ hàng trống
                                       @endif
                                   </th>
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