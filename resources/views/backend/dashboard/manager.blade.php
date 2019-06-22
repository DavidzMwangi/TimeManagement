@extends('backend.layouts.master')
@section('style')
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/iCheck/flat/blue.css')}}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/morris/morris.css')}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/datepicker/datepicker3.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/daterangepicker/daterangepicker-bs3.css')}}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v2</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">

                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{count(\App\User::where('user_type',2)->get())}}<sup style="font-size: 20px"></sup></h3>

                            <p>Regular Users</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{count(\App\User::all())}}</h3>

                            <p>All Users </p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-7 connectedSortable">

                </section>
                <!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->

            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('script')
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="{{asset('admilte/plugins/morris/morris.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{asset('adminlte/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
    <!-- jvectormap -->
    <script src="{{asset('adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{asset('adminlte/plugins/knob/jquery.knob.js')}}"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="{{asset('adminlte/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- datepicker -->
    <script src="{{asset('adminlte/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
    <!-- Slimscroll -->
    <script src="{{asset('adminlte/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('adminlte/plugins/fastclick/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('adminlte/dist/js/adminlte.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('adminlte/dist/js/pages/dashboard.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('adminlte/dist/js/demo.js')}}"></script>


@endsection