@extends('backend.master')

@section('content')
    <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row header-tops">
                    <div class="col-lg-12 text-center">
                        <h2 class="page-header">MIMU JUTE MILLS LTD.</h2>
                        <h3>মিমু জুট মিলস লিঃ</h3>
                        <p>ফুলতলা, খুলনা।</p>
                        <h4><u>দৈনিক হিসাব প্রতিবেদন</u></h4>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row no-print">
                    <div class="col-md-12">
                        
                      <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" class="btn btn-success" href="#incm">আয় খাত</a></li>
                        <li><a data-toggle="tab" class="btn btn-danger" href="#exp">ব্যয় খাত</a></li>
                      </ul>
                <div class="tab-content">
                    <div id="incm" class="tab-pane fade in active">
                    <div class="panel panel-success">
                      <div class="panel-heading">নতুন আয় হিসাব</div>
                      <div class="panel-body">

                      <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>তারিখ</th>
                                        <th>হিসাব বিবরণী</th>
                                        <th>খাত</th>
                                        <th>প্রাপ্তি/আয়</th>
                                        <th>ব্যালেন্স/শুরু</th>
                                        <th>আপডেট ব্যালেন্স</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <form class="form-horizontal" action="{{url('/')}}/reportadd" method="post">
                                    {{ csrf_field() }}
                                        <td>
                                              <input type="text" data-provide="datepicker" format="dd-mm-yyyy" placeholder="DD-MM-YYYY" class="form-control" id="date" name="date">
                                        </td>
                                        <td>
                                            <input type="text" name="description" class="form-control" id="description" placeholder="Description">
                                        </td>
                                        <td>
                                          <select class="form-control" name="category">
                                            @foreach($sections as $section)
                                            @if($section->ie==0)
                                            <option value="{{$section->id}}" style="color: green;font-weight: bold;">{{$section->name}}</option>
                                            @endif
                                            @endforeach
                                          </select>
                                        </td>
                                        <td>
                                            <input type="text" name="income" class="form-control" id="income" onkeyup="findTotal()" placeholder="0.00">
                                        </td>                                        
                                        <td>
                                            <input type="text" name="balance" class="form-control" id="oldbalance" value="{{$lastbalance->balance}}" readonly>
                                        </td>                                        <td>
                                            <input type="text" name="balance" class="form-control" id="balance" readonly>
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-success">SAVE</button>
                                        </td>
                                    </form>
                                    </tr>
                                </tbody>
                            </table>                    

                      </div>
                    </div>
                    
                        
                    </div>
                    </div>

                    <div id="exp" class="tab-pane fade">
                    <div class="panel panel-danger">
                      <div class="panel-heading">নতুন ব্যয় হিসাব</div>
                      <div class="panel-body">

                      <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>তারিখ</th>
                                        <th>হিসাব বিবরণী</th>
                                        <th>খাত</th>
                                        <th>ব্যয়/খরচ</th>
                                        <th>ব্যালেন্স/শুরু</th>
                                        <th>আপডেট ব্যালেন্স</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <form class="form-horizontal" action="{{url('/')}}/reportadd" method="post">
                                    {{ csrf_field() }}
                                        <td>
                                              <input type="text" data-provide="datepicker" format="dd-mm-yyyy" placeholder="DD-MM-YYYY" class="form-control" id="date" name="date">
                                        </td>
                                        <td>
                                            <input type="text" name="description" class="form-control" id="description" placeholder="Description">
                                        </td>
                                        <td>
                                          <select class="form-control" name="category">
                                            @foreach($sections as $section)
                                            @if($section->ie==1)
                                            <option value="{{$section->id}}" style="color: red;font-weight: bold;">{{$section->name}}</option>
                                            @endif
                                            @endforeach
                                          </select>
                                        </td>
                                        <td>
                                            <input type="text" name="expense" class="form-control" id="expense" onkeyup="findTotal2()" placeholder="0.00">
                                        </td>                                        
                                        <td>
                                            <input type="text" name="balance" class="form-control" id="oldbalance" value="{{$lastbalance->balance}}" readonly>
                                        </td>                                        <td>
                                            <input type="text" name="balance" class="form-control" id="balance2" readonly>
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-success">SAVE</button>
                                        </td>
                                    </form>
                                    </tr>
                                </tbody>
                            </table>                    

                      </div>
                    </div>
                    
                        
                    </div>
                    </div>
                  </div>
                </div>
                </div>

                   <div class="row">
                    <div class="col-md-12">

                    <div class="panel panel-primary">

                      <div class="panel-heading">
                        <h3 class="panel-title pull-left no-print">
                            দৈনিক হিসাব প্রতিবেদন
                        </h3>
                          <form class="navbar-form navbar-right no-print" method="post" action="{{url('/')}}/ReportFilter">
                          {{ csrf_field() }}
                            <div class="form-group">
                              <input name="fromdate" type="text" class="form-control fromdate" data-provide="datepicker" format="dd-mm-yyyy" placeholder="DD-MM-YYYY">
                            </div>
                            <div class="form-group">
                              <input name="todate" type="text" class="form-control todate" data-provide="datepicker" placeholder="DD-MM-YYYY">
                            </div>
                            <button type="submit" class="btn btn-success">FILTER</button>
                          </form><br class="no-print"><br class="no-print">
                        @foreach($reports as $curdate)
                            @if ( $loop->first )
                                {{ date('d-F-Y', strtotime($curdate->date))." থেকে "}}
                            @endif
                        @endforeach
                        @foreach($reports as $curdate)
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
                                        <th>খাত</th>
                                        <th>প্রাপ্তি/আয়</th>
                                        <th>ব্যয়/খরচ</th>
                                        <th>ব্যালেন্স/শুরু</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @php($totalincome=0)
                                @php($totalexpense=0)
                                @foreach($reports as $report)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ date('d-m-Y', strtotime($report->date)) }}</td>
                                    <td style="text-align: left">{{ $report->description }}</td>
                                    <td><a href="{{url('/')}}/category/{{ $report->categoryid }}">{{ $report->category }}</a></td>
                                    <td>{{ $report->income }}</td>
                                    <td>{{ $report->expense }}</td>
                                    <td>{{ $report->balance }}</td>
                                </tr>
                                @php( $totalincome+= $report->income)
                                @php( $totalexpense+= $report->expense)
                                @php($i++)
                                @endforeach
                                <tr class="info">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ $totalincome }}</td>
                                    <td>{{ $totalexpense }}</td>
                                    <td>{{ $lastbalance->balance }}</td>
                                </tr>
                                </tbody>
                                
                            </table>
                        </div>  

                      </div> <!--  panel end -->
                    </div>

                    </div>
                </div>
             



    </div> <!-- /.container-fluid -->

<script type="text/javascript">
    function findTotal(){
        income = document.getElementById("income").value;
        oldbalance = document.getElementById("oldbalance").value;
        newbalance = Number(oldbalance)+Number(income);
        document.getElementById("balance").value = newbalance;
    }
    function findTotal2(){
        expense = document.getElementById("expense").value;
        oldbalance = document.getElementById("oldbalance").value;
        newbalance2 = Number(oldbalance)-Number(expense);
        document.getElementById("balance2").value = newbalance2;
    }
</script>



@endsection