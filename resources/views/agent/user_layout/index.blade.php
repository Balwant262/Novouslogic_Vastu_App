@extends('agent.layout.admin_layout')
   
@section('content')

<div class="modal fade" role="dialog" id="modalAddnewuser_layout">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title-status">User Layout Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      
      <form id="payment_request_form" action="{{ route('user_layout.store') }}" method="POST">
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
                    @foreach ($users as $pur)
                        <option value="{{ $pur->id }}">{{ $pur->name }}</option>
                    @endforeach
                </select>
            </td>
          </tr>
          
          <tr>
            <th>User Address</th>
            <td>
                <select name="address_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                    <option value="">Select User Address</option>
                    @foreach ($address as $addr)
                        <option value="{{ $addr->id }}">{{ $addr->address_name }}</option>
                    @endforeach
                </select>
            </td>
          </tr>
          
          <tr>
            <th>Activity Name</th>
            <td>
                <select name="activity_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                    <option value="">Select Activity Name</option>
                    @foreach ($activitys as $attr)
                        <option value="{{ $attr->id }}">{{ $attr->activity_name }}</option>
                    @endforeach
                </select>
            </td>
          </tr>
          
          <tr>
            <th>Zone Name</th>
            <td>
                <select name="zone_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                    <option value="">Select Zone Name</option>
                    @foreach ($zones as $zon)
                        <option value="{{ $zon->id }}">{{ $zon->direction_name }}</option>
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

<div class="modal fade" role="dialog" id="modaledituser_layout">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title-status">User Layout Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      
      <form id="payment_request_form" action="{{ route('user_layout.update', 1) }}" method="POST">
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
                    @foreach ($users as $pur)
                        <option value="{{ $pur->id }}">{{ $pur->name }}</option>
                    @endforeach
                </select>
            </td>
          </tr>
          
          <tr>
            <th>User Address</th>
            <td>
                <select name="address_id" id="address_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                    <option value="">Select User Address</option>
                    @foreach ($address as $addr)
                        <option value="{{ $addr->id }}">{{ $addr->address_name }}</option>
                    @endforeach
                </select>
            </td>
          </tr>
          
          <tr>
            <th>Activity Name</th>
            <td>
                <select name="activity_id" id="activity_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                    <option value="">Select Activity Name</option>
                    @foreach ($activitys as $attr)
                        <option value="{{ $attr->id }}">{{ $attr->activity_name }}</option>
                    @endforeach
                </select>
            </td>
          </tr>
          
          <tr>
            <th>Zone Name</th>
            <td>
                <select name="zone_id" id="zone_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                    <option value="">Select Zone Name</option>
                    @foreach ($zones as $zon)
                        <option value="{{ $zon->id }}">{{ $zon->direction_name }}</option>
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
      <h3 class="card-title"><i class="fas fa-users"></i> User Layout</h3>
        <div class="card-tools">
            <a class="btn btn-success btn-sm" title="Add User Layout" href="#" data-toggle="modal" data-target="#modalAddnewuser_layout"> 
                <i class="fas fa-plus-circle"></i> Add User Layout
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
          <th>User Name</th>
          <th>Address Name</th>
          <th>Activity Name</th>
          <th>Zone Name</th>
          
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($user_layout as $zon)
            <tr>
                <td>{{ $zon->name }}</td>
                <td>{{ $zon->address_name }}</td>
                <td>{{ $zon->activity_name }}</td>
                <td>{{ $zon->zone_name }}</td>
                <td>
                    <form action="{{ route('user_layout.destroy', $zon->id) }}" method="POST">   
                     <input type="hidden" name="id" value="{{ $zon->id }}">  
                    <a class="btn btn-info btn-xs" href="#" data-toggle="modal" data-target="#modaledituser_layout" data-id="{{ $zon->id }}" 
                       data-user_id="{{ $zon->user_id }}" data-address_id="{{ $zon->address_id }}" data-zone_id="{{ $zon->zone_id }}" data-activity_id="{{ $zon->activity_id }}"><i class="fas fa-edit"></i></a>   
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