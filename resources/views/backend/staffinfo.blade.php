@extends('backend.master')

@section('content')
    <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           INDIVIDUAL STAFF INFORMATION
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                   <div class="row">

                    <div class="col-md-8">

                    <div class="panel panel-default">
					  <div class="panel-heading"></div>
					  <div class="panel-body">
						<h3>নাম: <b>{{ $staffinfo->name }}</b></h3>
						<h4>পদবী: {{$staffinfo->designation}}</h4>
                        <h4>জন্ম তারিখ: {{ date('d-m-Y', strtotime($staffinfo->dateofbirth)) }}</h4>
                        <h4>বয়স: {{ date('Y')-date('Y', strtotime($staffinfo->dateofbirth)) }} বছর</h4>
                        <h4>রক্তের গ্রুপ: {{$staffinfo->bloodgroup}}</h4>
						<h4>ফোন নাম্বারঃ {{$staffinfo->phone}}</h4>
						<h4>ঠিকানাঃ {{$staffinfo->address}}</h4><br>
						<h4 style="color:#428bca"><b>সর্বমোট পাওনাঃ {{$staffinfo->totaldue}} টাকা</b></h4>
						<h4 style="color:#5cb85c"><b>সর্বমোট পরিশোধঃ {{$staffinfo->totalpaid}} টাকা</b></h4>
						<h4 style="color:#d9534f"><b>অপরিশোধিত পাওনাঃ @if($staffinfo->totaldue>=1) {{$staffinfo->totaldue - $staffinfo->totalpaid}} @else {{0}} @endif টাকা</b></h4>
					  </div>
					</div>

                    </div>
                    <div class="col-md-4">
                        <form class="form-horizontal" action="{{url('/')}}/staffpay/{{$staffinfo->id}}" method="post">
                        {{ csrf_field() }}

                        <div class="input-group">
                          <span class="input-group-addon">৳</span>
                          <input type="text" name="amount" class="form-control" aria-label="Amount" placeholder="0.00">
                          <span class="input-group-btn">
                            <button class="btn btn-success" type="submit">PAY</button>
                          </span>
                        </div>
                        </form>
                    </div>

                </div>


                   <div class="row">
                    <div class="col-md-12">

                    <div class="panel panel-success">
					  <div class="panel-heading">কর্মকর্তা/কর্মচারীদের বেতনের বিবরন</div>
					  <div class="panel-body">
						
						<div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="salarysheet">
                                    <tr>
                                        <th style="text-align:center; vertical-align: middle;">ক্রমিক নং</th>
                                        <th style="text-align:center; vertical-align: middle;">তারিখ</th>
                                        <th style="text-align:center; vertical-align: middle;">মোট বেতন</th>
                                        <th style="text-align:center; vertical-align: middle;">কর্তন</th>
                                        <th style="text-align:center; vertical-align: middle;">নীট বেতন</th>
                                        <th style="text-align:center; vertical-align: middle;">মন্তব্য</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i=1)
                                    @foreach($staff_reports as $staff_report)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{ date('d-m-Y', strtotime($staff_report->created_at)) }}</td>
                                        <td>{{$staff_report->salary}}</td>
                                        <td>{{$staff_report->minus}}</td>
                                        <td>{{$staff_report->totalsalary}}</td>
                                        <td>{{$staff_report->description}}</td>
                                    </tr>
                                    @php($i++)
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $staff_reports->links() }}
                        </div>	

					  </div> <!--  panel end -->
					</div>

                    </div>
                </div>  <!-- row end -->

                <div class="row">
                    <div class="col-md-12">

                        <div class="panel panel-primary">
                          <div class="panel-heading">টাকা পরিশোধ এর হিসাব</div>
                          <div class="panel-body">
                            
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="salarysheet">
                                        <tr>
                                            <th style="text-align:center; vertical-align: middle;">ক্রমিক নং</th>
                                            <th style="text-align:center; vertical-align: middle;">তারিখ</th>
                                            <th style="text-align:center;">টাকার পরিমান</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php($i=1)
                                        @foreach($payments as $payment)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{date('d-m-Y', strtotime($payment->created_at))}}</td>
                                            <td>{{$payment->amount}}</td>

                                        </tr>
                                        @php($i++)
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $payments->links() }}
                            </div>  

                          </div>
                        </div>
                    </div>
                </div>
                	             		
                </div>
                </div>

    </div> <!-- /.container-fluid -->
            
@endsection