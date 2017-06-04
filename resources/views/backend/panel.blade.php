@extends('backend.master')

@section('content')
    <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  Welcome to <strong>Mimu Jute Mills Ltd</strong> Dashboard
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <div>TOTAL SUPPLIERS</div>
                                        <div class="huge">{{$numofsupplier}}</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{url('/')}}/supplier">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
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
                                    <div>AMOUNT OF JUTE( x40 kg)</div>
                                        <div class="huge">{{$amountofjute}}</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{url('/')}}/dailyreport">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
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
                                        <i class="fa fa-users fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <div>SUPPLIERS DUE(TK)</div>
                                        <div class="huge">{{$totaldue}}</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{url('/')}}/dailyreport">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
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
                                        <i class="fa fa-users fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                     <div>TOTAL WORKERS</div>
                                        <div class="huge">{{$numofworker}}</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{url('/')}}/worker">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> BALANCE STATUS (Running Month)</h3>
                            </div>
                            <div class="panel-body">
                                <div id="morris-area-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i> Financial Status of this Month</h3>
                            </div>
                            <div class="panel-body">
                                <div id="morris-donut-chart"></div>
                                <div class="text-right">
                                    <a href="{{url('/')}}/reports">View Details <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Report Summary</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>তারিখ</th>
                                        <th>প্রাপ্তি আয়</th>
                                        <th>ব্যয়/খরচ</th>
                                        <th>ব্যালেন্স/শুরু</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @php($totalincome=0)
                                @php($totalexpense=0)
                                @foreach($chartdatas->slice(0, 8) as $chartdata)
                                <tr>
                                    <td>{{ date('d-m-Y', strtotime($chartdata->created_at)) }}</td>
                                    <td>{{ $chartdata->income }}</td>
                                    <td>{{ $chartdata->expense }}</td>
                                    <td>{{ $chartdata->balance }}</td>
                                </tr>
                                @php( $totalincome+= $chartdata->income)
                                @php( $totalexpense+= $chartdata->expense)
                                @php($i++)
                                @endforeach
                                </tbody>
                                
                            </table>
                                </div>
                                <div class="text-right">
                                    <a href="{{url('/')}}/reports">View All <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>               

                 <div class="row">
                    <div class="col-lg-6">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i> আয় খাত সমূহ</h3>
                            </div>
                            <div class="panel-body">
                            @foreach($incomecategory as $incomec)
                                <a href="{{url('/')}}/category/{{$incomec->id}}" class="btn btn-lg btn-success" style="margin-bottom:5px;  font-size:26px; background-color: #005a00;">{{$incomec->name}}</a>
                            @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> ব্যয় খাত সমূহ</h3>
                            </div>
                            <div class="panel-body">
                                @foreach($expensecategory as $expensec)
                                    <a href="{{url('/')}}/category/{{$expensec->id}}" class="btn btn-info btn-lg" style="margin-bottom: 5px; font-size:26px; color: #000; background-color: #fcb11b;">{{$expensec->name}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->


    </div> <!-- /.container-fluid -->
            
@endsection

    @php($i=1)
    @php($totalincome=0)
    @php($totalexpense=0)
    @foreach($chartdatas as $chartdata)
    @php( $totalincome+= $chartdata->income)
    @php( $totalexpense+= $chartdata->expense)
    @php($i++)
    @endforeach


@php($incomes=0)
@php($expenses=0)
@section('scripts')
    <script>
    // Area Chart
    Morris.Area({
        element: 'morris-area-chart',
        data: [
        @foreach($chartdatas as $chartdata)
        {
            date: '{{ date('Y-m-d', strtotime($chartdata->created_at)) }}',
            @php($incomes+= $chartdata->income)
            @php($expenses+= $chartdata->expense)
            income:{{$incomes}},
            expense:{{$expenses}},
            balance: {{$chartdata->balance}} @if(empty($chartdata->balance)) 0 @endif,
        }, 
        @endforeach
        ],
        xkey: 'date', 
        ykeys: ['expense', 'income', 'balance'], 
        labels: ['expense', 'income', 'balance'],
        pointSize: 2,
        hideHover: 'auto',
        lineColors:['#fcb11b', '#69d300', '#00aded'],
        resize: true
    });

    Morris.Donut({
  element: 'morris-donut-chart',
  data: [
    {label: "Current Balance", value: {{ $lastbalance->balance }}},
    {label: "Total Income", value: {{ $totalincome }}},
    {label: "Total Expense", value: {{ $totalexpense }}}
  ],
  colors:['#00aded', '#69d300', '#fcb11b']
});



</script>
@endsection