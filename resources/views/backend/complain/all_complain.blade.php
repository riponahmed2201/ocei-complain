@extends('backend.master')

@section('title', 'All Complain List')
@section('dashboard-title', 'All Complain List')
@section('breadcrumb-title', 'All Complain  Information')

@section('stylesheet')
    <!-- <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.0/dist/sweetalert2.css" rel="stylesheet"> -->
@endsection

@section('container')
<section class="content">

  <div class="card card-success card-outline">
    <div class="card-header">
      <button class="btn btn-danger btn-sm float-sm-left" id="delete_all" style="margin:5px;"><i class="fa fa-trash"></i> Delete</button>&nbsp
      <button class="btn btn-info btn-sm float-sm-left" id="active_all" style="margin:5px;"><i class="fa fa-check"></i> forward <span class="badge badge-dark right">{{$count}}</span></button>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="allComplain" class="table table-bordered table-striped">
        <tr> 
         <th style="text-align: center;" colspan="5">Complainer Information</th> 
         <th style="text-align: center;" colspan="4">Employee Information</th> 
        </tr> 
        <tr> 
          <th>#</th> 
          <th>Name</th>
          <th>Phone</th>
          <th>Gender</th> 
          <th>Reason</th> 
          <th>Employee Name</th> 
          <th>Department</th> 
          <th>Designation</th> 
          <th>Status</th>
        </tr> 

        @foreach($complains as $complain)
          <input style="display: none;" type="text" name="complainId[]" value="{{$complain->id}}">
        <tr> 
          <td>
            <input type="checkbox" name="complainId[]" value="{{$complain->id}}">
          </td> 
          <td>{{$complain->name}}</td>
          <td>{{$complain->mobile}}</td>
          <td>{{$complain->gender}}</td>
          <td>{{$complain->reason}}</td>
          <td><button class="btn btn-primary btn-xs">{{$complain->employee_name}}</button></td> 
          <td><button class="btn btn-success btn-xs">{{$complain->deptName}}</button></td>  
          <td><button class="btn btn-warning btn-xs">{{$complain->desigName}}</button></td>
          <td>
             @if($complain->status==1)
              <button class="btn btn-info btn-xs">Forward</button>
             @else
              <button class="btn btn-warning btn-xs">Not Forward</button>
             @endif
          </td> 
        </tr>
        @endforeach  
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

</section>
@endsection

@section('custom_script')
<script>
  $(function () {
      ("#allComplain").DataTable();
      // delete all selected question id
      $('#delete_all').click(function () {
          var ids = [];
          // get all selected user id
          $.each($("input[name='complainId[]']:checked"), function(){
              ids.push($(this).val());
          });
          if (ids.length!==0) {
              var url = "{{ url('delete/all/complain') }}";
              Swal.fire({
                  title: 'Are you sure?',
                  text: "You want to delete?",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, Delete it!'
              }).then(function(result) {
                  if (result.value) {
                      $.ajax({
                          url: url,
                          type: 'POST',
                          data: {"complainId": ids, "_token": "{{ csrf_token() }}"},
                          dataType: "json",
                          beforeSend:function () {
                              Swal.fire({
                                  title: 'Deleting Data.......',
                                  showConfirmButton: false,
                                  html: '<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>',
                                  allowOutsideClick: false
                              });
                          },
                          success:function (response) {
                              Swal.close();
                              console.log(response);
                              if (response==="success"){
                                  Swal.fire({
                                      title: 'Successfully Deleted',
                                      type: 'success',
                                      confirmButtonColor: '#3085d6',
                                      confirmButtonText: 'Ok'
                                  }).then(function(result) {
                                      if (result.value) {
                                          window.location.reload();
                                      }
                                  });
                              }
                          },
                          error:function (error) {
                              Swal.close();
                              console.log(error);
                          }
                      })
                  }
              });
          }else{
              Swal.fire(
                  'Error',
                  'Select The Complain First!',
                  'error'
              )
          }
      });
    });

   // activate all selected user id
  $('#active_all').click(function () {
      var ids = [];
      // get all selected user id
      $.each($("input[name='complainId[]']:checked"), function(){
          ids.push($(this).val());
      });
      if (ids.length!==0) {
          var url = "{{ url('forward/all/complain') }}";
          Swal.fire({
              title: 'Are you sure?',
              text: "You want to foward?",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, Foward'
          }).then(function(result) {
              if (result.value) {
                  $.ajax({
                      url: url,
                      type: 'POST',
                      data: {"complainId": ids, "_token": "{{ csrf_token() }}"},
                      dataType: "json",
                      beforeSend:function () {
                          Swal.fire({
                              title: 'Activating Complain.......',
                              showConfirmButton: false,
                              html: '<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>',
                              allowOutsideClick: false
                          });
                      },
                      success:function (response) {
                          Swal.close();
                          console.log(response);
                          if (response==="success"){
                              Swal.fire({
                                  title: 'Successfully Foward',
                                  type: 'success',
                                  confirmButtonColor: '#3085d6',
                                  confirmButtonText: 'Ok',
                                  allowOutsideClick: false
                              }).then(function(result) {
                                  if (result.value) {
                                      window.location.reload();
                                  }
                              });
                          }
                      },
                      error:function (error) {
                          Swal.close();
                          console.log(error);
                      }
                  })
              }
          });
      }else{
          Swal.fire(
              'Error',
              'Select The Complain First!',
              'error'
          )
      }
  });
</script>
@endsection