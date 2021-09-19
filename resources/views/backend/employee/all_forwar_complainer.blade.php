@extends('backend.master')

@section('title', 'All Forward Complainer List')
@section('dashboard-title', 'All Forward Complainer List')
@section('breadcrumb-title', 'All Forward Complainer  Information')

@section('stylesheet')
    <!-- <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.0/dist/sweetalert2.css" rel="stylesheet"> -->
@endsection
@section('container')
<section class="content">

  <div class="card card-success card-outline">
    <div class="card-header">
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="allvisitor" class="table table-bordered table-striped">
        <tr> 
          <th>Serial No</th> 
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Reason</th> 
          <th>Date & Time</th>
          <th>Status</th>
        </tr> 
        @foreach($forwardingComplains as $forwardingComplain)
        <tr> 
          <td>{{$loop->iteration}}</td> 
          <td>{{$forwardingComplain->name}}</td>
          <td>{{$forwardingComplain->email}}</td>
          <td>{{$forwardingComplain->mobile}}</td>
          <td>{{$forwardingComplain->reason}}</td>
          <td>{{$forwardingComplain->created_at}}</td>
          <td>
             @if($forwardingComplain->status==1)
              <button class="btn btn-info btn-xs">Forward by admin</button>
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
  
</script>
@endsection