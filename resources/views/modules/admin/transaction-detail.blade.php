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
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Giá</th>
                                    <th>Màu sắc</th>
                                    <th>Kích thước</th>
                                    <th>Ngày tạo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transaction->orders as $order)
                                    <tr>
                                        <td>{{$order->transaction_id}}</td>
                                        <td>{{ $order->product->name }}</td>
                                        <td>{{$order->count}}</td>
                                        <td>{{ number_format($order->amount) }}</td>
                                        <td>{{json_decode($order->data)->color}}</td>
                                        <td>{{json_decode($order->data)->size}}</td>
                                        <td>{{$order->created_at}}</td>
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