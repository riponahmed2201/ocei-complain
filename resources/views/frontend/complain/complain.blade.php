@extends('frontend.master')
@section('title','Complain Form')
@section('stylesheet')
    
@endsection
@section('contain')
<div class="col-md-12 col-sm-8 col-xs-12">
  <div class="row registration-page-wrapper">
        <div class="col-xs-12">
            <div id="messageSection" class="alert alert-success hide">
                <button class="close" data-dismiss="alert">×</button>
                <div id="messageBody">
                </div>
            </div>
            <h3 class="page-heading">
                <span>Complain Form</span>
            </h3>
            <div class="col-md-12 offset-2 mt-2">
                  @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block text-center">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong class="text-center">{{ $message }}</strong>
                    </div>
                  @endif

                  @if ($message = Session::get('danger'))
                    <div class="alert alert-danger alert-block text-center">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>{{ $message }}</strong>
                    </div>
                  @endif
            </div>
            <section class="content">
              <div class="container-fluid">
                <div class="row">
                     <form method="post" action="{{route('store.complain')}}" class="form clearfix">
                     @csrf
                      <!-- left column -->
                      <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                          <div class="card-header">
                            <h3 style="font-weight: bold;" class="card-title"><u>Complainer Info</u></h3>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
                            <div class="card-body">
                              <div class="form-group">
                                <label for="NAME">Name :<span id="mark">&nbsp;*</span></label>
                                <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}" placeholder="Enter your name">
                                @if($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                              </div>
                              <div class="form-group">
                                <label for="email">Email:<span id="mark">&nbsp;*</span></label>
                                <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}" placeholder="sample@email.com">
                                @if($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                              </div>
                              <div class="form-group">
                                <label>Mobile Number<span id="mark">&nbsp;*</span></label>
                                <input type="text" class="form-control" name="mobile" id="mobile" value="{{old('mobile')}}" placeholder="01xxxxxxxxx">
                                @if($errors->has('mobile'))
                                    <span class="text-danger">{{ $errors->first('mobile') }}</span>
                                @endif
                              </div>
                              <div class="form-group">
                                <label>Gender :<span id="mark">&nbsp;*</span></label>
                                <select name="gender" class="form-control select2bs4">
                                    <option value="">----Select Gender----</option>
                                    <option value="Male" @if (old('gender') == "Male") {{ 'selected' }} @endif>Male</option>
                                    <option value="Female" @if (old('gender') == "Female") {{ 'selected' }} @endif>Female</option>
                                </select>
                                @if($errors->has('gender'))
                                    <span class="text-danger">{{ $errors->first('gender') }}</span>
                                @endif
                              </div>
                              <div class="form-group">
                               <label for="exampleFormControlTextarea1">Your Complain :<span id="mark">&nbsp;* (Complain)</span></label>
                                    <textarea class="form-control" name="reason" id="reason" rows="3"></textarea>
                              </div>
                            </div>
                            <!-- /.card-body -->
                          
                        </div>
                      </div>
                      <!--/.col (left) -->
                      <!-- right column -->
                      <div class="col-md-6">
                        <!-- Form Element sizes -->
                        <div class="card card-success">
                          <div class="card-header">
                            <h3 style="font-weight: bold;" class="card-title"><u>To Info</u></h3>
                          </div>
                          <div class="card-body">
                            <div class="form-group">
                                <label for="NAME">Employee Name :<span id="mark">&nbsp;*</span></label>
                                <select name="employee_id" class="form-control select2bs4" id="employee_id">
                                    <option value="">----Select Employee Name----</option>
                                    @foreach($employees as $employee)
                                    <option value="{{$employee->employee_id}}" {{ old('employee_id') == $employee->employee_id ? "selected" :""}}>{{$employee->first_name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('employee_id'))
                                    <span class="text-danger">{{ $errors->first('employee_id') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="NAME">Department :<span id="mark">&nbsp;*</span></label>
                                <select class="form-control select2bs4" name="department_id" id="department_id">
                                    <option value="">----Select Department----</option>
                                    @foreach($departments as $department)
                                    <option value="{{$department->department_id}}">{{$department->department_name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('department_id'))
                                    <span class="text-danger">{{ $errors->first('department_id') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="NAME">Designation :<span id="mark">&nbsp;*</span></label>
                                <select name="designation_id" class="form-control select2bs4" id="designation_id">
                                    <option value="">----Select Designation----</option>
                                    @foreach($designations as $designation)
                                    <option value="{{$designation->designation_id}}" {{ old('designation_id') == $designation->designation_id ? "selected" :""}}>{{$designation->designation_name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('designation_id'))
                                    <span class="text-danger">{{ $errors->first('designation_id') }}</span>
                                @endif
                            </div>
                          </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- /.card -->
                      </div>
                      <!--/.col (right) -->
                      <div class="form-group">
                        <div class="col-xs-12">
                            <div class="text-right">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
                   </form>
                   <div class="form-group">
                        <div style="margin-bottom:2px!important;" class="col-md-12">
                            <span>Are you already registered? Please</span>
                            <a class="light-green" href="{{route('complainer.login')}}">
                               login
                            </a>
                        </div>
                   </div>
                </div>
                <!-- /.row -->
              </div><!-- /.container-fluid -->
            </section>
        </div><!--/.col-xs-12.col-sm-9-->
    </div> 
</div>
@endsection

@section('custom_script')
<script>
    $(function () {
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  })
</script>
@endsection