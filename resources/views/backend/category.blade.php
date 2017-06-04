@extends('backend.master')

@section('content')
    <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           {{$categoryname->name}}
                        </h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> AVARAGE STATUS </h3>
                            </div>
                            <div class="panel-body">
                                <div id="morris-area-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                   <div class="row">
                    <div class="col-md-12">

                    <div class="panel panel-primary">

                      <div class="panel-heading">
                        <h3 class="panel-title pull-left">
                            খাত ভিত্তিক প্রতিবেদন | {{$categoryname->name}}
                        </h3>
                          {{ csrf_field() }}
                          </form><br><br>
                        @foreach($categoryinfos as $curdate)
                            @if ( $loop->first )
                                {{ date('d-F-Y', strtotime($curdate->date))." থেকে "}}
                            @endif
                        @endforeach
                        @foreach($categoryinfos as $curdate)
                            @if ($loop->last)
                                {{ date('d-F', strtotime($curdate->date))  }}
                            @endif
                        @endforeach
                           <div class="clearfix"></div>
                      </div>
                      
                      <div class="panel-body">
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ক্রমিক নং</th>
                                        <th>তারিখ</th>
                                        <th>হিসাব বিবরণী</th>
                                        <th>প্রাপ্তি আয়</th>
                                        <th>ব্যয়/খরচ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @php($totalincome=0)
                                @php($totalexpense=0)
                                @foreach($categoryinfos as $categoryinfo)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ date('d-m-Y', strtotime($categoryinfo->date)) }}</td>
                                    <td style="text-align: left">{{ $categoryinfo->description }}</td>
                                    <td>{{ $categoryinfo->income }}</td>
                                    <td>{{ $categoryinfo->expense }}</td>
                                </tr>
                                @php( $totalincome+= $categoryinfo->income)
                                @php( $totalexpense+= $categoryinfo->expense)
                                @php($i++)
                                @endforeach
                                <tr class="info">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ $totalincome }}</td>
                                    <td>{{ $totalexpense }}</td>
                                </tr>
                                </tbody>
                                
                            </table>
                        </div>  

                      </div> <!--  panel end -->
                    </div>

                    </div>
                </div>

    </div> <!-- /.container-fluid -->
            
@endsection
@section('scripts')
    <script>
    // Area Chart
    Morris.Area({
        element: 'morris-area-chart',
        data: [
        @foreach($categoryinfos as $categoryinfo)
        {
            date: '{{ date('Y-m-d', strtotime($categoryinfo->date)) }}',
            income:{{$categoryinfo->income}} @if(empty($categoryinfo->income)) 0 @endif,
            expense:{{$categoryinfo->expense}} @if(empty($categoryinfo->expense)) 0 @endif,
        }, 
        @endforeach
        ],
        xkey: 'date', 
        ykeys: ['income', 'expense'], 
        labels: ['income', 'expense'],
        pointSize: 2,
        hideHover: 'auto',
        lineColors:['rgba(0, 174, 255, 0.8)'],
        resize: true
    });

</script>
@endsection