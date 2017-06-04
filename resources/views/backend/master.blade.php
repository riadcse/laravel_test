<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DASHBOARD | MIMU JUTE MILLS LTD</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{url('/')}}/backend/css/bootstrap.css" rel="stylesheet">


    <!-- Morris Charts CSS -->
    <link href="{{url('/')}}/backend/css/plugins/morris.css" rel="stylesheet">
    <link href="{{url('/')}}/backend/css/bootstrap-datepicker.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{url('/')}}/backend/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Custom CSS -->
    <link href="{{url('/')}}/backend/css/sb-admin.css" rel="stylesheet">


</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top no-print" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header no-print">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{url('/')}}/panel"><i class="fa fa-fw fa-industry"></i> Mimu Jute Mills Ltd</a>
            </div>

            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ Auth::user()->name }} <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                        	<a href="{{url('/register')}}">Create New User</a>
                        </li>
                        <li>
                            <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>



            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse no-print">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="{{url('/')}}/panel" style="color: rgb(0, 202, 234); font-weight: 600;"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#accounts" style="color: rgb(0, 202, 234); font-weight: 600;"><i class="fa fa-fw fa-list"></i> ACCOUNTS DEPT <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="accounts" class="collapse">
                        <li>
                            <a href="{{url('/')}}/reports"><i class="fa fa-fw fa-line-chart"></i> REPORTS</a>
                        </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#supplier" style="color: rgb(0, 202, 234); font-weight: 600;"><i class="fa fa-fw fa-edit"></i> JUTE DEPT <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="supplier" class="collapse">
                        <li>
                            <a href="{{url('/')}}/dailyreport"><i class="fa fa-fw fa-bar-chart"></i> DAILY REPORT</a>
                        </li>
                        <li>
                            <a href="{{url('/')}}/supplier"><i class="fa fa-fw fa-plus-circle"></i> SUPPLIER</a>
                        </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#worker" style="color: rgb(0, 202, 234); font-weight: 600;"><i class="fa fa-fw fa-users"></i> WAGES DEPT<i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="worker" class="collapse">
                        <li>
                            <a href="{{url('/')}}/workerreport"><i class="fa fa-fw fa-tasks"></i> REPORTS</a>
                        </li>
                        <li>
                            <a href="{{url('/')}}/worker"><i class="fa fa-fw fa-users"></i> WORKERS</a>
                        </li>
                        </ul>
                    </li>                    
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#staff" style="color: rgb(0, 202, 234); font-weight: 600;"><i class="fa fa-fw fa-male"></i> ADMIN DEPT<i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="staff" class="collapse">
                        <li>
                            <a href="{{url('/')}}/staffreport"><i class="fa fa-fw fa-tasks"></i> STAFF SALARY</a>
                        </li>
                        <li>
                            <a href="{{url('/')}}/staff"><i class="fa fa-fw fa-users"></i> ADD STAFFS</a>
                        </li>                        
                        <li>
                            <a href="{{url('/')}}/gaurdsreport"><i class="fa fa-fw fa-tasks"></i> GAURDS SALARY</a>
                        </li>                       
                         <li>
                            <a href="{{url('/')}}/gaurds"><i class="fa fa-fw fa-eye"></i> ADD GAURDS</a>
                        </li>
                        </ul>
                    </li>

<!--                     <li>
                        <a href="tables.html"><i class="fa fa-fw fa-table"></i> Tables</a>
                    </li>
                    <li>
                        <a href="forms.html"><i class="fa fa-fw fa-edit"></i> Forms</a>
                    </li>
                    <li>
                        <a href="bootstrap-elements.html"><i class="fa fa-fw fa-desktop"></i> Bootstrap Elements</a>
                    </li>
                    <li>
                        <a href="bootstrap-grid.html"><i class="fa fa-fw fa-wrench"></i> Bootstrap Grid</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Dropdown <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="#">Dropdown Item</a>
                            </li>
                            <li>
                                <a href="#">Dropdown Item</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="blank-page.html"><i class="fa fa-fw fa-file"></i> Blank Page</a>
                    </li>
                    <li>
                        <a href="index-rtl.html"><i class="fa fa-fw fa-dashboard"></i> RTL Dashboard</a>
                    </li> -->

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

			@yield('content')

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="{{url('/')}}/backend/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{url('/')}}/backend/js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="{{url('/')}}/backend/js/plugins/morris/raphael.min.js"></script>
    <script src="{{url('/')}}/backend/js/plugins/morris/morris.min.js"></script>
<!--     <script src="{{url('/')}}/backend/js/plugins/morris/morris-data.js"></script> -->
    <script src="{{url('/')}}/backend/js/bootstrap-datepicker.min.js"></script>
    
    <script>
    $.fn.datepicker.defaults.format = "dd-mm-yyyy";
    $('.fromdate').datepicker({
        
    });    
    $('.todate').datepicker({

    });
    </script>

@yield('scripts')


</body>

</html>
