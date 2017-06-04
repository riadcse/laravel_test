@extends('backend.master')

@section('content')
    <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            SUPPLIER INFORMATION
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-md-8">

                    <div class="panel panel-default">
					  <div class="panel-heading"></div>
					  <div class="panel-body">
						<h3>নাম: <b>{{ $supplierinfo->name }}</b></h3>
						<h4>মোকামঃ {{$supplierinfo->mokam}}</h4>
						<h4>ফোন নাম্বারঃ {{$supplierinfo->phone}}</h4>
						<h4>ঠিকানাঃ {{$supplierinfo->address}}</h4><br>
						<h4 style="color:#428bca"><b>সর্বমোট পাওনাঃ {{$supplierinfo->totaldue}} টাকা</b></h4>
						<h4 style="color:#5cb85c"><b>সর্বমোট পরিশোধঃ {{$supplierinfo->totalpaid}} টাকা</b></h4>
						<h4 style="color:#d9534f"><b>অপরিশোধিত পাওনাঃ {{$supplierinfo->totaldue - $supplierinfo->totalpaid}} টাকা</b></h4>
							

					  </div>
					</div>

                    </div>
                    <div class="col-md-4">
                        <form class="form-horizontal" action="{{url('/')}}/supplierpay/{{$supplierinfo->id}}" method="post">
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
					  <div class="panel-heading">সকল ক্রয় হিসাব</div>
					  <div class="panel-body">
						
						<div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ক্রমিক নং</th>
                                        <th>তারিখ</th>
                                        <th>লট নং</th>
                                        <th>ক্রয়কৃত পাটের পরিমান (মণ)</th>
                                        <th>পাটের দর</th>
                                        <th>মোট মূল্য</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@php($i=1)
                                    @foreach($transactions as $supplier)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{date('d-m-Y', strtotime($supplier->created_at))}}</td>
                                        <td>{{$supplier->lot}}</td>
                                        <td>{{$supplier->quantity}}</td>
                                        <td>{{$supplier->price}}</td>
                                        <td>{{$supplier->totalprice}}</td>

                                    </tr>
                                    @php($i++)
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $transactions->links() }}
                        </div>	

					  </div> <!--  panel end -->
					</div>

                    </div>
                </div>

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
                	

    </div> <!-- /.container-fluid -->
            
@endsection