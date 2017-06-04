@extends('backend.master')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Graphs and Charts Testing
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Area Line Graph Example with Tooltips</h3>
                </div>
                <div class="panel-body">
                    <div id="morris-area-chart"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Area Line Graph Example with Tooltips</h3>
                </div>
                <div class="panel-body">
                    <div id="donut-example"></div>
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



@section('scripts')
    <script>
    // Area Chart
    Morris.Area({
        element: 'morris-area-chart',
        data: [
        @foreach($chartdatas as $chartdata)
        {
            date: '{{ date('Y-m-d', strtotime($chartdata->created_at)) }}',
            income: {{$chartdata->income}} @if(empty($chartdata->income)) 0 @endif,
            expense: {{$chartdata->expense}} @if(empty($chartdata->expense)) 0 @endif,
            balance: {{$chartdata->balance}} @if(empty($chartdata->balance)) 0 @endif
        }, 
        @endforeach
        ],
        xkey: 'date', 
        ykeys: ['income', 'expense', 'balance'], 
        labels: ['income', 'expense', 'balance'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });

    Morris.Donut({
  element: 'donut-example',
  data: [
    {label: "Current Balance", value: {{ $lastbalance->balance }}},
    {label: "Total Income", value: {{ $totalincome }}},
    {label: "Total Expense", value: {{ $totalexpense }}}
  ]
});



</script>
@endsection