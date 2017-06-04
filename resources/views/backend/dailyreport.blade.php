@extends('backend.master')

@section('content')
    <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row header-tops">
                    <div class="col-lg-12 text-center">
                        <h2 class="page-header">MIMU JUTE MILLS LTD.</h2>
                        <h3>মিমু জুট মিলস লিঃ</h3>
                        <p>ফুলতলা, খুলনা।</p>
                        <h4><u>পাট খরিদ, পরিশোধ ও দেনাপাওনা প্রতিবেদন</u></h4>
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
                                <thead>
                                    <tr>
                                        <th>ব্যাবসায়ী</th>
                                        <th>লট নং</th>
                                        <th>ক্রয়কৃত পাটের পরিমান (মণ)</th>
                                        <th>পাটের দর</th>
                                        <th>মোট মূল্য</th>
                                        <th>অ্যাকশন</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <form class="form-horizontal" action="{{url('/')}}/addReport" method="post">
                                    {{ csrf_field() }}
                                        <td>
                                          <select class="form-control" name="supplierid">
                                            @foreach($suppliers as $supplier)
                                            <option value="{{$supplier->id}}">{{$supplier->name}} ({{$supplier->mokam}})</option>
                                            @endforeach
                                          </select>
                                        </td>
                                        <td>
                                            <input type="text" name="lot" class="form-control" id="lot" placeholder="0">
                                        </td>
                                        <td>
                                            <input type="text" onkeyup="findTotal()" name="quantity" class="form-control" id="quantity" placeholder="0">
                                        </td>
                                        <td>
                                            <input type="text" onkeyup="findTotal()" name="price" class="form-control" id="price" placeholder="0">
                                        </td>
                                        <td>
                                            <input type="text" name="totalprice" class="form-control" id="totalprice" placeholder="0">
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

                   <div class="row">
                    <div class="col-md-12">

                    <div class="panel panel-primary">

					  <div class="panel-heading">
                        <h3 class="panel-title pull-left no-print">
                            পাট খরিদ, পরিশোধ ও দেনাপাওনা প্রতিবেদন 
                        </h3>
                          <form class="navbar-form navbar-right no-print" method="post" action="{{url('/')}}/DailyReportFilter">
                          {{ csrf_field() }}
                            <div class="form-group">
                              <input name="fromdate" type="text" class="form-control fromdate" data-provide="datepicker" format="dd-mm-yyyy" placeholder="DD-MM-YYYY">
                            </div>
                            <div class="form-group">
                              <input name="todate" type="text" class="form-control todate" data-provide="datepicker" placeholder="DD-MM-YYYY">
                            </div>
                            <button type="submit" class="btn btn-success">FILTER</button>
                          </form><br class="no-print"><br class="no-print">
                        @foreach($transactions as $curdate)
                            @if ($loop->last)
                                {{ date('d-F', strtotime($curdate->date))." থেকে "  }}
                            @endif
                        @endforeach
                        @foreach($transactions as $curdate)
                            @if ( $loop->first )
                                {{ date('d-F-Y', strtotime($curdate->date))}}
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
                                        <th>ব্যাবসায়ীর নাম</th>
                                        <th>মোকাম</th>
                                        <th>লট নং</th>
                                        <th>ওজন (মণ)</th>
                                        <th>দর</th>
                                        <th>মোট মূল্য</th>
                                        <th>সর্বমোট পাওনা</th>
                                        <th>সর্বমোট পরিশোধ</th>
                                        <th>অপরিশোধিত পাওনা</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@php($i=1)
                                    @php($dueall=0)
                                    @php($paidall=0)
                                    @foreach($transactions as $transaction)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{ date('d-m-Y', strtotime($transaction->date)) }}</td>
                                        <td><a href="{{url('/')}}/supplierinfo/{{$transaction->id}}">{{$transaction->name}}</a></td>
                                        <td>{{$transaction->mokam}}</td>
                                        <td>{{$transaction->lot}}</td>
                                        <td>{{$transaction->quantity}}</td>
                                        <td>{{$transaction->price}}</td>
                                        <td>{{$transaction->totalprice}}</td>
                                        <td>{{$transaction->totaldue}}</td>
                                        <td>{{$transaction->totalpaid}}</td>
                                        <td>{{$transaction->totaldue - $transaction->totalpaid}}</td>
                                    </tr>
                                    @php($i++)
                                    @php($dueall+=$transaction->totaldue)
                                    @php($paidall+=$transaction->totalpaid)
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
                                        <td>{{$dueall}}</td>
                                        <td>{{$paidall}}</td>
                                        <td>{{$dueall - $paidall}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            {{ $transactions->links() }}
                        </div>	

					  </div> <!--  panel end -->
					</div>

                    </div>
                </div>
             



    </div> <!-- /.container-fluid -->

<script type="text/javascript">
	function findTotal(){
	    quantity = document.getElementById("quantity").value;
	    price = document.getElementById("price").value;
	    totalprice=0;
	    totalprice = quantity*price;
	    document.getElementById("totalprice").value = totalprice;
	}
</script>



@endsection