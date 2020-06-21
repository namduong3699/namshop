<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <base href="{{asset('')}}public/">
    <title>Quản lý website</title>

    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/startmin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{URL::to('admin')}}">Admin</a>
            </div>

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Top Navigation: Left Menu -->
            <ul class="nav navbar-nav navbar-left navbar-top-links">
                <li><a href="{{URL::to('index')}}"><i class="fa fa-home fa-fw"></i> Website</a></li>
            </ul>

            <!-- Top Navigation: Right Menu -->
            <ul class="nav navbar-right navbar-top-links">
                <li class="dropdown navbar-inverse">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i> <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> {{ Auth::user()->name }} <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="{{URL::to('account')}}"><i class="fa fa-user fa-fw"></i> Thông tin người dùng</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-fw"></i>
                            Đăng xuất
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Left -->
        <div class="navbar-default sidebar" role="navigation" >
            <div class="sidebar-nav navbar-collapse ">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Tìm kiếm...">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        <!-- /input-group -->
                    </li>
                    <li>
                        <a href="{{URL::to('admin')}}"><i class="fa fa-dashboard fa-fw"></i> Tổng hợp</a>
                    </li>
                    <li>
                        <a href="{{URL::to('admin/catalog')}}"><i class="fa fa-database fa-fw"></i> Quản lý danh mục</a>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="{{URL::to('admin/product')}}"><i class="fa fa-table fa-fw"></i> Quản lý sản phẩm</a>
                    </li>
                    <li>
                        <a href="{{URL::to('admin/transaction')}}"><i class="fa fa-cart-plus fa-fw"></i> Quản lý giao dịch</a>
                    </li>
                    <li>
                        <a href="{{URL::to('admin/comment')}}"><i class="fa fa-comment-o fa-fw"></i>Quản lý bình luận</a>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="{{URL::to('admin/slide')}}"><i class="fa fa-sitemap fa-fw"></i> Quản lý slide</a>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="{{URL::to('admin/userManagement')}}"><i class="fa fa-user-o fa-fw"></i> Quản lý người dùng</a>
                        <!-- /.nav-second-level -->
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    @yield('content')

</div>

<!-- jQuery -->
<script src="js/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="js/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="js/dataTables/jquery.dataTables.min.js"></script>
<script src="js/dataTables/dataTables.bootstrap.min.js"></script>

<script src="js/startmin.js"></script>
<script src="js/me.js"></script>
<script>
   $(document).ready(function() {
    $('#dataTables').DataTable({
        responsive: true
    });
});
</script>
<script>
    @yield('js')
</script>
</body>
</html>
