@extends('backend.master')

@section('content')
    <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row header-tops">
                    <div class="col-lg-12 text-center">
                        <h2 class="page-header">MIMU JUTE MILLS LTD.</h2>
                        <h3>মিমু জুট মিলস লিঃ</h3>
                        <p>ফুলতলা, খুলনা।</p>
                        <h4><u>শ্রমিক হাজিরা ও বিল</u></h4>
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
                                        <th rowspan="2" style="text-align:center; vertical-align: middle;">নির্ধারিত কর্মী</th>
                                        <th rowspan="2" style="text-align:center; vertical-align: middle;">কর্ম পালা</th>
                                        <th colspan="7" style="text-align:center;">সাপ্তাহিক হাজীরা</th>
                                        <th rowspan="2" style="text-align:center; vertical-align: middle;">মোট কর্ম ঘন্টা</th>
                                        <th rowspan="2" style="text-align:center; vertical-align: middle;">নির্ধারিত মজুরী</th>
                                        <th rowspan="2" style="text-align:center; vertical-align: middle;">বোনাস</th>
                                        <th rowspan="2" style="text-align:center; vertical-align: middle;">নাইট</th>
                                        <th rowspan="2" style="text-align:center; vertical-align: middle;">শুক্রবার</th>
                                        <th rowspan="2" style="text-align:center; vertical-align: middle;">মোট মজুরী</th>
                                        <th rowspan="2" style="text-align:center; vertical-align: middle;">অ্যাকশন</th>
                                    </tr>
                                    <tr>
                                            <th>বৃহঃ</th>
                                            <th>শুক্র</th>
                                            <th>শনি</th>
                                            <th>রবি</th>
                                            <th>সোম</th>
                                            <th>মঙ্গল</th>
                                            <th>বুধ</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                    <form class="form-horizontal" action="{{url('/')}}/addwages" method="post">
                                    {{ csrf_field() }}
                                        <td>
                                          <select class="form-control" name="workerid" style="width: inherit;">

                                          @foreach($workers as $worker)

                                            <option value="{{$worker->id}}">{{$worker->cardnumber}} {{$worker->name}}</option>

                                          @endforeach

                                          </select>
                                        </td>
                                        <td>
                                          <select class="form-control" name="shift" style="width: inherit;">

                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="G">G</option>

                                          </select> 
                                        </td>
                                        <td><input type="text" name="d1" id="d1" class="form-control" onkeyup="findTotal()"></td>
                                        <td><input type="text" name="d2" id="d2" class="form-control" onkeyup="findTotal()"></td>
                                        <td><input type="text" name="d3" id="d3" class="form-control" onkeyup="findTotal()"></td>
                                        <td><input type="text" name="d4" id="d4" class="form-control" onkeyup="findTotal()"></td>
                                        <td><input type="text" name="d5" id="d5" class="form-control" onkeyup="findTotal()"></td>
                                        <td><input type="text" name="d6" id="d6" class="form-control" onkeyup="findTotal()"></td>
                                        <td><input type="text" name="d7" id="d7" class="form-control" onkeyup="findTotal()"></td>
                                        <td><input type="text" name="totalhour" id="hour" class="form-control" value=""></td>
                                        <td><input type="text" name="wages" id="wages" class="form-control" onkeyup="findTotal()"></td>
                                        <td><input type="text" name="bonus" id="bonus" class="form-control" placeholder="0" onkeyup="findTotal()"></td>
                                        <td><input type="text" name="night" id="night" class="form-control" placeholder="0" onkeyup="findTotal()"></td>
                                        <td><input type="text" name="friday" id="friday" class="form-control" placeholder="0" onkeyup="findTotal()"></td>
                                        <td><input type="text" name="totalwages" style="width: inherit;" id="totalwages" class="form-control" placeholder="0"></td>
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
                            শ্রমিক হাজিরা ও বিল 
                        </h3>
                          <form class="navbar-form navbar-right no-print" method="post" action="{{url('/')}}/WorkerReportFilter">
                          {{ csrf_field() }}
                            <div class="form-group">
                              <input name="fromdate" type="text" class="form-control fromdate" data-provide="datepicker" format="dd-mm-yyyy" placeholder="DD-MM-YYYY">
                            </div>
                            <div class="form-group">
                              <input name="todate" type="text" class="form-control todate" data-provide="datepicker" format="dd-mm-yyyy" placeholder="DD-MM-YYYY">
                            </div>
                            <button type="submit" class="btn btn-success">FILTER</button>
                          </form><br class="no-print"><br class="no-print">
                        @foreach($worker_reports as $curdate)
                            @if ($loop->last)
                                {{ date('d-F', strtotime($curdate->created_at))." থেকে "  }}
                            @endif
                        @endforeach
                        @foreach($worker_reports as $curdate)
                            @if ( $loop->first )
                                {{ date('d-F-Y', strtotime($curdate->created_at))}}
                            @endif
                        @endforeach
                           <div class="clearfix"></div>
                      </div>
					  <div class="panel-body">
						
						<div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="salarysheet">
                                    <tr>
                                        <th rowspan="2" style="text-align:center; vertical-align: middle;">ক্রমিক নং</th>
                                        <th rowspan="2" style="text-align:center; vertical-align: middle;">কার্ড নং</th>
                                        <th rowspan="2" style="text-align:center; vertical-align: middle;">নাম</th>
                                        <th rowspan="2" style="text-align:center; vertical-align: middle;">পদবী</th>
                                        <th rowspan="2" style="text-align:center; vertical-align: middle;">কর্ম পালা</th>
                                        <th colspan="7" style="text-align:center;">সাপ্তাহিক হাজীরা</th>
                                        <th rowspan="2" style="text-align:center; vertical-align: middle;">মোট কর্ম ঘন্টা</th>
                                        <th rowspan="2" style="text-align:center; vertical-align: middle;">নির্ধারিত মজুরী</th>
                                        <th rowspan="2" style="text-align:center; vertical-align: middle;">বোনাস</th>
                                        <th rowspan="2" style="text-align:center; vertical-align: middle;">নাইট</th>
                                        <th rowspan="2" style="text-align:center; vertical-align: middle;">শুক্রবার</th>
                                        <th rowspan="2" style="text-align:center; vertical-align: middle;">মোট মজুরী</th>
                                    </tr>
                                    <tr>
                                            <th>বৃহঃ</th>
                                            <th>শুক্র</th>
                                            <th>শনি</th>
                                            <th>রবি</th>
                                            <th>সোম</th>
                                            <th>মঙ্গল</th>
                                            <th>বুধ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i=1)
                                    @php($allwages=0)
                                    @php($allhour=0)
                                    @foreach($worker_reports as $worker_report)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$worker_report->cardnumber}}</td>
                                        <td><a href="{{url('/')}}/workerinfo/{{$worker_report->workerid}}">{{$worker_report->name}}</a></td>
                                        <td>{{$worker_report->designation}}</td>
                                        <td>{{$worker_report->shift}}</td>
                                        <td>{{$worker_report->d1}}</td>
                                        <td>{{$worker_report->d2}}</td>
                                        <td>{{$worker_report->d3}}</td>
                                        <td>{{$worker_report->d4}}</td>
                                        <td>{{$worker_report->d5}}</td>
                                        <td>{{$worker_report->d6}}</td>
                                        <td>{{$worker_report->d7}}</td>
                                        <td>{{$worker_report->totalhour}}</td>
                                        <td>{{$worker_report->wages}}</td>
                                        <td>{{$worker_report->bonus}}</td>
                                        <td>{{$worker_report->night}}</td>
                                        <td>{{$worker_report->friday}}</td>
                                        <td>{{$worker_report->totalwages}}</td>
                                    </tr>
                                    @php($i++)
                                    @php($allwages+=$worker_report->totalwages)
                                    @php($allhour+=$worker_report->totalhour)
                                    @endforeach
                                    <tr class="info">
                                        <td>TOTAL</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{$allhour}}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{$allwages}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            {{ $worker_reports->links() }}
                        </div>	

					  </div> <!--  panel end -->
					</div>

                    </div>
                </div>
             



    </div> <!-- /.container-fluid -->

<script type="text/javascript">
	function findTotal(){
        d1 = document.getElementById("d1").value;
        d2 = document.getElementById("d2").value;
        d3 = document.getElementById("d3").value;
        d4 = document.getElementById("d4").value;
        d5 = document.getElementById("d5").value;
        d6 = document.getElementById("d6").value;
	    d7 = document.getElementById("d7").value;
        wages = document.getElementById("wages").value;
        bonus = document.getElementById("bonus").value;
        night = document.getElementById("night").value;
        friday = document.getElementById("friday").value;
        totalhour = 0;
	    totalhour = Number(d1)+Number(d2)+Number(d3)+Number(d4)+Number(d5)+Number(d6)+Number(d7);
	    document.getElementById("hour").value = totalhour;
        totalwages = document.getElementById("totalwages").value= (Number(totalhour)/8)*Number(wages)+(Number(bonus)+Number(night)+Number(friday));
	}
</script>

@endsection