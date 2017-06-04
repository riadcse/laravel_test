@extends('backend.master')

@section('content')
    <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            ADMIN DEPERTMENT | Security Gaurds
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-12">
                    <div class="panel panel-info">
                      <div class="panel-heading">ADD NEW Security GAURD</div>
                      <div class="panel-body">
                        <form class="form-horizontal" action="{{url('/')}}/addgaurd" method="post">
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
                              <button type="submit" class="btn btn-success">Add Security Gaurd</button>
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
					  <div class="panel-heading">সিকিউরিটি গার্ডদের লিস্ট  </div>
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
								@foreach ($gaurds as $gaurd)	
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td><a href="{{url('/')}}/gaurdinfo/{{$gaurd->id}}">{{$gaurd->name}}</a></td>
                                        <td>{{ $gaurd->designation }}</td>
                                        <td>{{ $gaurd->totaldue }}</td>
                                        <td>{{ $gaurd->totalpaid }}</td>
                                        <td>{{$gaurd->totaldue - $gaurd->totalpaid}}</td>
                                        <td>
                                        @if ( $gaurd->totaldue > 1)
                                        	<a href="#"><button class="btn btn-danger disabled">DELETE</button></a>
                                        @else 
                                            <a onclick="return confirm('Are you sure you want to delete this gaurd?');" href="{{url('/')}}/deletegaurd/{{$gaurd->id}}"><button class="btn btn-danger">DELETE</button></a>
                                        @endif
                                         </td>
                                    </tr>
                                    @php ($i++)
								@endforeach
                                </tbody>
                            </table>
                            {{ $gaurds->links() }}
                        </div>
					  </div>
					</div>

                    </div>
                </div>
                <!-- /.row -->



    </div> <!-- /.container-fluid -->
            
@endsection