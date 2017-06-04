@extends('backend.master')

@section('content')
    <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            SUPPLIER
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-12">
                    <div class="panel panel-info">
                      <div class="panel-heading">ADD NEW SUPPLIER</div>
                      <div class="panel-body">
                        <form class="form-horizontal" action="{{url('/')}}/addSupplier" method="post">
                        {{ csrf_field() }}
                          <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">নাম</label>
                            <div class="col-sm-10">
                              <input type="text" name="name" class="form-control" id="name" placeholder="Name">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="phone" class="col-sm-2 control-label">ফোন নাম্বার</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="mokam" class="col-sm-2 control-label">মোকাম</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="mokam" name="mokam" placeholder="Mokam">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="address" class="col-sm-2 control-label">ঠিকানা</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="due" class="col-sm-2 control-label">পাওনা (টাকা)</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="due" name="totaldue" value="0">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="paid" class="col-sm-2 control-label">পরিশোধ (টাকা)</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="paid" name="totalpaid" value="0">
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                              <button type="submit" class="btn btn-success">Add Supplier</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    
                        
                    </div>
                </div>

                   <div class="row">
                    <div class="col-md-12">

                    <div class="panel panel-success">
					  <div class="panel-heading">সকল ব্যাবসায়ী</div>
					  <div class="panel-body">
					      <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ক্রমিক নং</th>
                                        <th>নাম</th>
                                        <th>মোকাম</th>
                                        <th>সর্বমোট পাওনা (টাকা)</th>
                                        <th>সর্বমোট পরিশোধ (টাকা)</th>
                                        <th>অপরিশোধিত পাওনা (টাকা)</th>
                                        <th>অ্যাকশন</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php ($i = 1)
								@foreach ($suppliers as $supplier)	
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td><a href="{{url('/')}}/supplierinfo/{{$supplier->id}}">{{$supplier->name}}</a></td>
                                        <td>{{ $supplier->mokam }}</td>
                                        <td>{{ $supplier->totaldue }}</td>
                                        <td>{{ $supplier->totalpaid }}</td>
                                        <td>{{$supplier->totaldue - $supplier->totalpaid}}</td>
                                        <td>
                                        @if ( $supplier->totaldue > 1)
                                        	<a href="#"><button class="btn btn-danger disabled">DELETE</button></a>
                                        @else 
                                            <a onclick="return confirm('Are you sure you want to delete this supplier?');" href="{{url('/')}}/deleteSupplier/{{$supplier->id}}"><button class="btn btn-danger">DELETE</button></a>
                                        @endif
                                         </td>
                                    </tr>
                                    @php ($i++)
								@endforeach
                                </tbody>
                            </table>
                            {{ $suppliers->links() }}
                        </div>
					  </div>
					</div>

                    </div>
                </div>
                <!-- /.row -->



    </div> <!-- /.container-fluid -->
            
@endsection