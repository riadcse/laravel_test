@extends('backend.master')

@section('content')
    <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row header-tops">
                    <div class="col-lg-12 text-center">
                        <h2 class="page-header">MIMU JUTE MILLS LTD.</h2>
                        <h3>মিমু জুট মিলস লিঃ</h3>
                        <p>ফুলতলা, খুলনা।</p>
                        <h4><u>সিকিউরিটি গার্ডদের মাসিক বেতনের বিবরন</u></h4>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row no-print">
                    <div class="col-md-12">
                    <div class="panel panel-primary">
                      <div class="panel-heading">নতুন হিসাব</div>
                      <div class="panel-body">

                      <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="salarysheet">
                                    <tr>
                                        <th style="text-align:center; vertical-align: middle;">গার্ড</th>
                                        <th style="text-align:center; vertical-align: middle;">মোট বেতন</th>
                                        <th style="text-align:center; vertical-align: middle;">কর্তন</th>
                                        <th style="text-align:center; vertical-align: middle;">নীট বেতন</th>
                                        <th style="text-align:center; vertical-align: middle;">মন্তব্য</th>
                                        <th style="text-align:center; vertical-align: middle;"></th>
                                </thead>
                                <tbody>

                                    <tr>
                                    <form class="form-horizontal" action="{{url('/')}}/addgaurdReport" method="post">
                                    {{ csrf_field() }}
                                        <td>
                                          <select class="form-control" name="gaurd_id" style="width: inherit;">

                                          @foreach($gaurds as $gaurd)

                                            <option value="{{$gaurd->id}}">{{$gaurd->name}} ( {{$gaurd->designation}} )</option>

                                          @endforeach

                                          </select>
                                        </td>
                                        <td><input type="text" name="salary" id="salary" class="form-control" placeholder="0" onkeyup="findTotal()"></td>
                                        <td><input type="text" name="minus" id="minus" class="form-control" placeholder="0" onkeyup="findTotal()"></td>
                                        <td><input type="text" name="totalsalary" id="totalsalary" class="form-control" placeholder="0"></td>
                                        <td><input type="text" name="description" id="description" class="form-control" placeholder="..."></td>
                                        <td><button type="submit" class="btn btn-success">SAVE</button></td>
                                    </form>
                                    </tr>

                                </tbody>
                            </table>                

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
                            সিকিউরিটি গার্ডদের মাসিক বেতনের বিবরন
                        </h3>
                          <form class="navbar-form navbar-right no-print" method="post" action="{{url('/')}}/gaurdreportfilter">
                          {{ csrf_field() }}
                            <div class="form-group">
                              <input name="fromdate" type="text" class="form-control fromdate" data-provide="datepicker" format="dd-mm-yyyy" placeholder="DD-MM-YYYY">
                            </div>
                            <div class="form-group">
                              <input name="todate" type="text" class="form-control todate" data-provide="datepicker" placeholder="DD-MM-YYYY">
                            </div>
                            <button type="submit" class="btn btn-success">FILTER</button>
                          </form><br class="no-print"><br class="no-print">
                        @foreach($gaurd_reports as $curdate)
                            @if ($loop->last)
                                {{ date('d-F', strtotime($curdate->date))." থেকে "  }}
                            @endif
                        @endforeach
                        @foreach($gaurd_reports as $curdate)
                            @if ( $loop->first )
                                {{ date('d-F-Y', strtotime($curdate->date))}}
                            @endif
                        @endforeach
                           <div class="clearfix"></div>
                      </div>
					  <div class="panel-body">
						
						<div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="salarysheet">
                                    <tr>
                                        <th style="text-align:center; vertical-align: middle;">ক্রমিক নং</th>
                                        <th style="text-align:center; vertical-align: middle;">তারিখ</th>
                                        <th style="text-align:center; vertical-align: middle;">নাম</th>
                                        <th style="text-align:center; vertical-align: middle;">পদবী</th>
                                        <th style="text-align:center; vertical-align: middle;">মোট বেতন</th>
                                        <th style="text-align:center; vertical-align: middle;">কর্তন</th>
                                        <th style="text-align:center; vertical-align: middle;">নীট বেতন</th>
                                        <th style="text-align:center; vertical-align: middle;">মন্তব্য</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i=1)
                                    @php($totalsalary=0)
                                    @php($allsalary=0)
                                    @php($allminus=0)
                                    @foreach($gaurd_reports as $gaurd_report)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{ date('d-m-Y', strtotime($gaurd_report->date)) }}</td>
                                        <td><a href="{{url('/')}}/gaurdinfo/{{$gaurd_report->id}}">{{$gaurd_report->name}}</a></td>
                                        <td>{{$gaurd_report->designation}}</td>
                                        <td>{{$gaurd_report->salary}}</td>
                                        <td>{{$gaurd_report->minus}}</td>
                                        <td>{{$gaurd_report->totalsalary}}</td>
                                        <td>{{$gaurd_report->description}}</td>
                                    </tr>
                                    @php($i++)
                                    @php( $totalsalary+=$gaurd_report->totalsalary)
                                    @php($allsalary+=$gaurd_report->salary)
                                    @php($allminus+=$gaurd_report->minus)
                                    @endforeach
                                    <tr class="info">
                                        <td>TOTAL</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{$allsalary}}</td>
                                        <td>{{$allminus}}</td>
                                        <td>{{$totalsalary}}</td>
                                        <td></td>
                                    </tr>
                                </tbody>

                            </table>
                            {{ $gaurd_reports->links() }}
                        </div>	

					  </div> <!--  panel end -->
					</div>

                    </div>
                </div>
             



    </div> <!-- /.container-fluid -->

<script type="text/javascript">
	function findTotal(){
        salary = document.getElementById("salary").value;
        minus = document.getElementById("minus").value;
        totalsalary = 0;
	    totalsalary = Number(salary)-Number(minus);
	    document.getElementById("totalsalary").value = totalsalary;
    
	}
</script>

@endsection