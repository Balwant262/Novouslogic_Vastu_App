@extends('admin.layout.admin_layout')
   
@section('content')
<div class="card">
    <div class="card-header">
      <h3 class="card-title"><i class="fas fa-users"></i> User Address</h3>
        <div class="card-tools">
            <a class="btn btn-success btn-sm" href="{{ route('user_address.create') }}" title="Add User Address"> 
                <i class="fas fa-plus-circle"></i> Add User Address
            </a>    
        </div>
    </div>
    
    
    @if ($message = Session::get('success'))
        <div class="alert alert-default-success">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <p>{{ $message }}</p>
            
        </div>
    @endif
    
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>User Name</th>
          <th>Property Name</th>
          <th>Property Type</th>
<!--          <th>Address Line 2</th>
          <th>Address Line 3</th>
          <th>City Name</th>-->
          <th>Status</th>
          <th>Is Derault</th>
          
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($user_address as $addrs)
            <tr>
                <td>{{ $addrs->name }}</td>
                <td>{{ $addrs->address_name }}</td>
                <td>{{ $addrs->address_type }}</td>
<!--                <td>{{ $addrs->address_line_2 }}</td>
                <td>{{ $addrs->address_line_3 }}</td>
                <td>{{ $addrs->city_name }}</td>-->
                <td><?php if($addrs->status == 1) echo '<b style="color:green;">Active<b>'; else echo '<b style="color:red;">Deactive<b>'; ?></td>
                <td><?php if($addrs->is_default == 1) echo '<b style="color:green;">Yes<b>'; else echo '<b style="color:red;">No<b>'; ?></td>
                <td>
                    <form action="{{ route('user_address.destroy',$addrs->id) }}" method="POST">   
                       
                    <a class="btn btn-info btn-xs" href="{{ route('user_address.edit',$addrs->id) }}"><i class="fas fa-edit"></i></a>   
                    @csrf
                    @method('DELETE')      
                    <button class="btn btn-danger btn-xs" type="submit" class=""><i class="fas fa-trash"></i></button>
                </form>
                </td>
            </tr>
        @endforeach
         </tfoot>
    </table>
        
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->

@endsection