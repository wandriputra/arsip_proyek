<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@section('title_pages') Aplikasi Arsip Proyek Indarung VI @show</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{url('asset/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('asset/dist/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{url('asset/dist/css/ionicons.min.css')}}">
    
    @yield('costom_style_pages')

    <link rel="stylesheet" href="{{url('asset/dist/css/AdminLTE.css')}}">
    <link rel="stylesheet" href="{{url('asset/dist/css/skins/skin-red.css')}}">
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-red layout-top-nav">
    <div class="wrapper">
      
      <header class="main-header">
      @section('header_pages')
        <nav class="navbar navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <a href="{{url('/')}}" class="navbar-brand"><b>ARSIP INDARUNG-VI</b></a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
              </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
              <!-- <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                  <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
                </div>
              </form> -->
            </div><!-- /.navbar-collapse -->

            <!-- Navbar Right Menu -->
              <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                  <!-- Notifications Menu -->
                @if(Auth::user()->role_user_id === 1)
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Administrator Menu <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="{{url('/dokumen/upload')}}">Upload Dokumen</a></li>
                      <li><a href="{{url('/sap/upload-excel')}}">Upload Excel SAP</a></li>
                      <li><a href="{{url('/dokumen/detail')}}">Contoh Detail Dokumen</a></li>
                      <li class="divider"></li>
                      <li><a href="#">Separated link</a></li>
                      <li class="divider"></li>
                      <li><a href="#">One more separated link</a></li>
                    </ul>
                  </li>
                @endif
                  <li class="dropdown notifications-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-bell-o"></i> Notifikasi
                      <span class="label label-success">10</span>
                    </a>
                    <ul class="dropdown-menu">
                      <li class="header">Notifikasi Approval Dokumen</li>
                      <li>
                        <!-- Inner Menu: contains the notifications -->
                        <ul class="menu">
                          <li><!-- start notification -->
                            <a href="#">
                              <i class="fa fa-book text-aqua"></i> Permintaan Approval Dokumen Pengadaan Radio HT
                            </a>
                          </li><!-- end notification -->
                        </ul>
                      </li>
                      <li class="footer"><a href="#">View all</a></li>
                    </ul>
                  </li>

                  <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <!-- The user image in the navbar-->
                      <img src="{{url('asset/dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
                      <!-- hidden-xs hides the username on small devices so only the image appears. -->
                      <span class="hidden-xs">Admin AFIS (ICT) <span class="caret"></span></span>
                    </a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{url('logout')}}">Logout</a></li>
                  </ul>
                </li>

                </ul>
              </div><!-- /.navbar-custom-menu -->
          </div><!-- /.container-fluid -->
        </nav>
      @show
      </header>

      @section('content_pages')
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container">
          <!-- Content Header (Page header) -->
          <!-- <section class="content-header">
            <h1>
              Top Navigation
              <small>Example 2.0</small>
            </h1>
            <ol class="breadcrumb">
              @section('breadcrumb')
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li><a href="#">Layout</a></li>
              <li class="active">Top Navigation</li>
              @show
            </ol>
          </section> -->

          <!-- Main content -->
          <section class="content">
            @section('content_main_pages')
            @show
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      @show

      @section('footer_pages')
      <footer class="main-footer">
        <div class="container">
          <div class="pull-right hidden-xs">
            <b>Version</b> 2.3.0
          </div>
          <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
        </div><!-- /.container -->
      </footer>
      @show

    </div><!-- ./wrapper -->
    
    <!-- jQuery 2.1.4 -->
    <script src="{{url('asset/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{url('asset/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- SlimScroll -->
    <script src="{{url('asset/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{url('asset/plugins/fastclick/fastclick.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{url('asset/dist/js/app.js')}}"></script>
    @yield('costom_js_pages')

  </body>
</html>
