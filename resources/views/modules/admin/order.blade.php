<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Đơn đặt hàng</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Đơn đặt hàng
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Mã đơn</th>
                                    <th>Mã giao dịch</th>
                                    <th>Mã sản phẩm</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Màu sắc</th>
                                    <th>Kích thước</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày tạo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orderPro as $order)
                                    <tr>
                                        <td>{{$loop->index}}</td>
                                        <td>{{$order->id}}</td>
                                        <td>{{$order->transaction_id}}</td>
                                        <td>{{$order->product_id}}</td>
                                        <td>{{DB::select("select `name` from product where id = ?" ,[$order->product_id])[0]->name}}</td>
                                        <td>{{$order->count}}</td>
                                        <td>{{json_decode($order->data)->color}}</td>
                                        <td>{{json_decode($order->data)->size}}</td>
                                        <td>{{($order->status) ? 'Đã giao' : 'Chưa giao'}}</td>
                                        <td>{{$order->createat}}</td>
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