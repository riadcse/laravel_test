@extends('backend.master')

@section('content')
    <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            ADMIN DEPERTMENT | Staff
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-12">
                    <div class="panel panel-info">
                      <div class="panel-heading">ADD NEW STAFF</div>
                      <div class="panel-body">
                        <form class="form-horizontal" action="{{url('/')}}/addstaff" method="post">
                        {{ csrf_field() }}
                          <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">নাম</label>
                            <div class="col-sm-10">
                              <input type="text" name="name" class="form-control" id="name" placeholder="Name">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="designation" class="col-sm-2 control-label">পদবী</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="designation" name="designation" placeholder="Designation">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="dateofbirth" class="col-sm-2 control-label">জন্ম তারিখ</label>
                            <div class="col-sm-10">
                              <input type="text" data-provide="datepicker" format="dd-mm-yyyy" placeholder="DD-MM-YYYY" class="form-control" id="dateofbirth" name="dateofbirth" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="bloodgroup" class="col-sm-2 control-label">রক্তের গ্রুপ</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="bloodgroup" name="bloodgroup" placeholder="Blood Group">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="phone" class="col-sm-2 control-label">ফোন</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="address" class="col-sm-2 control-label">ঠিকানা</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address">
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                              <button type="submit" class="btn btn-success">Add Staff</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    
                        
                    </div>
                </div>

                   <div class="row">
                    <div class="col-md-12">

                    <div class="panel panel-primary">
					  <div class="panel-heading">কর্মকর্তা/কর্মচারীদের লিস্ট </div>
					  <div class="panel-body">
					      <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ক্রমিক নং</th>
                                        <th>নাম</th>
                                        <th>পদবী</th>
                                        <th>সর্বমোট পাওনা (টাকা)</th>
                                        <th>সর্বমোট পরিশোধ (টাকা)</th>
                                        <th>অপরিশোধিত পাওনা (টাকা)</th>
                                        <th>অ্যাকশন</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php ($i = 1)
								@foreach ($staffs as $staff)	
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td><a href="{{url('/')}}/staffinfo/{{$staff->id}}">{{$staff->name}}</a></td>
                                        <td>{{ $staff->designation }}</td>
                                        <td>{{ $staff->totaldue }}</td>
                                        <td>{{ $staff->totalpaid }}</td>
                                        <td>{{$staff->totaldue - $staff->totalpaid}}</td>
                                        <td>
                                        @if ( $staff->totaldue > 1)
                                        	<a href="#"><button class="btn btn-danger disabled">DELETE</button></a>
                                        @else 
                                            <a onclick="return confirm('Are you sure you want to delete this staff?');" href="{{url('/')}}/deletestaff/{{$staff->id}}"><button class="btn btn-danger">DELETE</button></a>
                                        @endif
                                         </td>
                                    </tr>
                                    @php ($i++)
								@endforeach
                                </tbody>
                            </table>
                            {{ $staffs->links() }}
                        </div>
					  </div>
					</div>

                    </div>
                </div>
                <!-- /.row -->



    </div> <!-- /.container-fluid -->
            
@endsection