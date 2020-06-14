<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user-circle-o fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$userQty}}</div>
                            <div>Người dùng</div>
                        </div>
                    </div>
                </div>
                <a href="{{URL::to('/admin/userManagement')}}">
                    <div class="panel-footer">
                        <span class="pull-left">Xem chi tiết</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$catalogQty}}</div>
                            <div>Danh mục</div>
                        </div>
                    </div>
                </div>
                <a href="{{URL::to('admin/catalog')}}">
                    <div class="panel-footer">
                        <span class="pull-left">Xem chi tiết!</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$transactionQty}}</div>
                            <div>Quản lí giao dịch</div>
                        </div>
                    </div>
                </div>
                <a href="{{URL::to('admin/transaction')}}">
                    <div class="panel-footer">
                        <span class="pull-left">Xem chi tiết</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-product-hunt fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$productQty}}</div>
                            <div>Sản phẩm</div>
                        </div>
                    </div>
                </div>
                <a href="{{URL::to('admin/product')}}">
                    <div class="panel-footer">
                        <span class="pull-left">Xem chi tiết</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-8">


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
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Màu sắc</th>
                                    <th>Kích thước</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày tạo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td>{{$loop->index}}</td>
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->transaction_id}}</td>
                                    <td>{{ $order->product->name }}</td>
                                    <td>{{$order->count}}</td>
                                    <td>{{json_decode($order->data)->color}}</td>
                                    <td>{{json_decode($order->data)->size}}</td>
                                    <td>{{($order->status) ? 'Đã giao' : 'Chưa giao'}}</td>
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
        <!-- /.col-lg-8 -->
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bell fa-fw"></i> Đánh giá sản phẩm
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="list-group">
                        @foreach($newComment as $newCmt)
                        <a href="{{URL::to('product-detail', $newCmt->product_id)}}" class="list-group-item">
                            <i class="fa fa-comment fa-fw"></i> {{$newCmt->user_name}}
                            <span class="pull-right text-muted small"><em>{{$newCmt->created_at}}</em>
                            </span>
                            <p style="margin-top: 15px;">{{ $newCmt->product->name }}</p>
                            <p>{{$newCmt->content}}</p>
                        </a>
                        @endforeach
               {{--  <a href="#" class="list-group-item">
                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                    <span class="pull-right text-muted small"><em>12 minutes ago</em>
                    </span>
                </a>
                <a href="#" class="list-group-item">
                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                    <span class="pull-right text-muted small"><em>27 minutes ago</em>
                    </span>
                </a>
                <a href="#" class="list-group-item">
                    <i class="fa fa-tasks fa-fw"></i> New Task
                    <span class="pull-right text-muted small"><em>43 minutes ago</em>
                    </span>
                </a>
                <a href="#" class="list-group-item">
                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                    <span class="pull-right text-muted small"><em>11:32 AM</em>
                    </span>
                </a>
                <a href="#" class="list-group-item">
                    <i class="fa fa-bolt fa-fw"></i> Server Crashed!
                    <span class="pull-right text-muted small"><em>11:13 AM</em>
                    </span>
                </a>
                <a href="#" class="list-group-item">
                    <i class="fa fa-warning fa-fw"></i> Server Not Responding
                    <span class="pull-right text-muted small"><em>10:57 AM</em>
                    </span>
                </a>
                <a href="#" class="list-group-item">
                    <i class="fa fa-shopping-cart fa-fw"></i> New Order Placed
                    <span class="pull-right text-muted small"><em>9:49 AM</em>
                    </span>
                </a>
                <a href="#" class="list-group-item">
                    <i class="fa fa-money fa-fw"></i> Payment Received
                    <span class="pull-right text-muted small"><em>Yesterday</em>
                    </span>
                </a> --}}
            </div>
            <!-- /.list-group -->
            <a href="{{URL::to('admin/comment')}}" class="btn btn-default btn-block">Xem tất cả bình luận</a>
        </div>
        <!-- /.panel-body -->
    </div>

    <!-- /.panel -->
    <div class="chat-panel panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-comments fa-fw"></i>
            Cần từ vấn

        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <ul class="chat">
                @foreach($needContact as $needCont)
                <li class="left clearfix">
                    <span class="chat-img pull-left">
                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    </span>

                    <div class="chat-body clearfix">
                        <div class="header">
                            <strong class="primary-font">{{$needCont->email}}</strong>
                            <small class="pull-right text-muted">
                                <i class="fa fa-clock-o fa-fw"></i> {{$needCont->created_at}}
                            </small>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>

        </div>
        <!-- /.panel-body -->
        <div class="panel-footer">
            <div class="input-group">
                <input id="btn-input" type="text" class="form-control input-sm"
                placeholder="Type your message here..."/>
                <span class="input-group-btn">
                    <button class="btn btn-warning btn-sm" id="btn-chat">
                        Send
                    </button>
                </span>
            </div>
        </div>
        <!-- /.panel-footer -->
    </div>
    <!-- /.panel .chat-panel -->
</div>
<!-- /.col-lg-4 -->
</div>
<!-- /.row -->
</div>

