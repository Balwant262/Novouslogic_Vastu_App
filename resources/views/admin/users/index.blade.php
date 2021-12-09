@extends('admin.layout.admin_layout')
   
@section('content')
<div class="card">
    <div class="card-header">
      <h3 class="card-title"><i class="fas fa-users"></i> Users</h3>
        <div class="card-tools">
            <a class="btn btn-success btn-sm" href="{{ route('users.create') }}" title="Add User"> 
                <i class="fas fa-plus-circle"></i> Add User
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
          <th>Email</th>
          <th>Contact Number</th>
          <th>FCM ID</th>
          <th>Total Report Generate</th>
          <th>UserType</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->contact_number }}</td>
                <td>{{ $user->fcm_id }}</td>
                <td>{{ $user->no_of_report_generate }}</td>
                <td><?php 
                    if($user->is_admin == 1 && $user->role == 'Superadmin') 
                        echo '<b style="color:green;">Superadmin<b>';
                    elseif($user->is_admin == 1 && $user->role == 'Agent')
                            echo '<b style="color:orange;">Agent<b>';
                    else 
                        echo '<b style="color:blue;">User<b>'; ?></td>
                
                <td><?php if($user->status == 1) echo '<b style="color:green;">Active<b>'; else echo '<b style="color:red;">Deactive<b>'; ?></td>
                
                <td>
                    <form action="{{ route('users.destroy',$user->id) }}" method="POST">   
                       
                    <a class="btn btn-info btn-xs" href="{{ route('users.edit',$user->id) }}"><i class="fas fa-edit"></i></a>   
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