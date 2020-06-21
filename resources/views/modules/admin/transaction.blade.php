<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Quản lý giao dịch</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                   Quản lý giao dịch
               </div>
               <!-- /.panel-heading -->
               <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Trạng thái</th>
                                <th>Thanh toán</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Số tiền</th>
                                <th>Thanh toán</th>
                                <th>Địa chỉ</th>
                                <th>Ngày tạo</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaction as $trans)
                            <tr>
                                <td>{{$trans->id}}</td>
                                <td>
                                    @if($trans->is_shipped)
                                        đã giao
                                    @elseif($trans->is_cancelled)
                                        đã hủy
                                    @elseif($trans->is_confirmed)
                                        đã xác nhận
                                    @else
                                        chưa xác nhận
                                    @endif
                                </td>
                                <td>{{($trans->is_paied) ? 'Đã TT' : 'Chưa TT'}}</td>
                                <td>{{$trans->user_email}}</td>
                                <td>{{$trans->user_phone}}</td>
                                <td>{{number_format($trans->amount)}}</td>
                                <td>{{$trans->payment_info}}</td>
                                <td>{{implode(', ', json_decode($trans->message, true))}}</td>
                                <td>{{$trans->created_at}}</td>
                                <td>
                                    <a href="{{URL::to('admin/transaction/'.$trans->id.'/detail')}}"><i class="fa fa-eye"></i></a>
                                    @if(!$trans->is_cancelled)
                                        @if(!$trans->is_confirmed)
                                            <a href="{{URL::to('admin/transaction/confirm', $trans->id)}}"><i class="fa fa-check"></i></a>
                                        @endif
                                        <a href="{{URL::to('admin/transaction/cancel', $trans->id)}}"><i class="fa fa-trash"></i></a>
                                    @endif
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

<!-- /.row -->

<!-- /.row -->

<!-- /.row -->
</div>
            <!-- /#page-wrapper -->