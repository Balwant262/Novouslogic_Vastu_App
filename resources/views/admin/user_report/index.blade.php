@extends('admin.layout.admin_layout')
   
@section('content')

<div class="modal fade" role="dialog" id="modalAddnewuser_report">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title-status">User Report Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      
      <form id="payment_request_form" action="{{ route('user_report.store') }}" method="POST">
          @csrf
        <input type="hidden" name="redirect_u" value="<?php echo $_SERVER['REQUEST_URI'] ?>">
        
        <!-- Modal body -->
        <div class="modal-body">
        <table class="table table-striped table-bordered">
          <tr>
            <th>User Name</th>
            <td>
                <select name="user_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                    <option value="">Select User Name</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </td>
          </tr>
          
          <tr>
            <th>User Address</th>
            <td>
                <select name="address_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                    <option value="">Select User Address</option>
                    @foreach ($addrs as $addr)
                        <option value="{{ $addr->id }}">{{ $addr->address_name }}</option>
                    @endforeach
                </select>
            </td>
          </tr>
          
          
          
        </table>

       
        </div>
         <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary add_btn_self" >Save</button>
      </div>
    </form>
     

    </div>
  </div>
</div> 

<div class="modal fade" role="dialog" id="modaledituser_report">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title-status">User Report Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      
      <form id="payment_request_form" action="{{ route('user_report.update', '1') }}" method="POST">
          @csrf
          @method('PUT')
        <input type="hidden" name="redirect_u" value="<?php echo $_SERVER['REQUEST_URI'] ?>">
        <input type="hidden" name="id" id="id">
        <!-- Modal body -->
        <div class="modal-body">
        <table class="table table-striped table-bordered">
           <tr>
            <th>User Name</th>
            <td>
                <select name="user_id" id="user_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                    <option value="">Select User Name</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </td>
          </tr>
          
          <tr>
            <th>User Address</th>
            <td>
                <select name="address_id" id="address_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                    <option value="">Select User Address</option>
                    @foreach ($addrs as $addr)
                        <option value="{{ $addr->id }}">{{ $addr->address_name }}</option>
                    @endforeach
                </select>
            </td>
          </tr>

          
        </table>

       
        </div>
         <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary add_btn_self" >Save</button>
      </div>
    </form>
     

    </div>
  </div>
</div> 



<div class="card">
    <div class="card-header">
      <h3 class="card-title"><i class="fas fa-users"></i> User Report</h3>
        <div class="card-tools">
            <a class="btn btn-success btn-sm" href="#" data-toggle="modal" data-target="#modalAddnewuser_report" title="Add User Report"> 
                <i class="fas fa-plus-circle"></i> Add User Report
            </a>    
        </div>
    </div>
    
    
   @if ($errors->any())
        <div class="alert alert-default-danger">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
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
          <th>ID</th>
          <th>User Name</th>
          <th>Address Name</th>
          <th>Address</th>
          <th>Generated Report</th>
          
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($user_report as $zon)
            <tr>
                <td>{{ $zon->id }}</td>
                <td>{{ $zon->name }}</td>
                <td>{{ $zon->address_name }}</td>
                <td>{{ $zon->address_line_1 }},{{ $zon->address_line_2 }},{{ $zon->address_line_3 }}</td>
                <td><a target="_blank" href="/{{ $zon->generate_report }}">Download</a></td>
            
                <td>
                    <form action="{{ route('user_report.destroy', $zon->id) }}" method="POST">   
                     <input type="hidden" name="id" value="{{ $zon->id }}">  
                    <a class="btn btn-info btn-xs" href="#" data-toggle="modal" data-target="#modaledituser_report" data-id="{{ $zon->id }}" 
                       data-user_id="{{ $zon->user_id }}" data-address_id="{{ $zon->address_id }}" ><i class="fas fa-edit"></i></a>   
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