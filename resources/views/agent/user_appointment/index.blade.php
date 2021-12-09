@extends('agent.layout.admin_layout')
   
@section('content')

<div class="modal fade" role="dialog" id="modalAddnewuser_appointment">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title-status">User Appointment Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      
      <form id="payment_request_form" action="{{ route('user_appointment.store') }}" method="POST">
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
            <th>Assigned Agent Name</th>
            <td>
                <select name="assigned_agent_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                    <option value="">Select Agent Name</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </td>
          </tr>
          
          
          
          <tr>
            <th>Appointment Datetime</th>
            <td>
                <input type="datetime-local" class="form-control" name="appointment_datetime" placeholder="Appointment Datetime">
            </td>
          </tr>
          
          <tr>
            <th>Appointment Status</th>
            <td>
                <select name="status" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                    <option value="">Select Appointment Status</option>
                    <option value="1">Pending For Agent Assign</option>
                    <option value="2">Assigned Agent</option>
                    <option value="3">In-Progress</option>
                    <option value="4">Appointment Completed</option>
                    <option value="5">Appointment Deleted</option>
                </select>
            </td>
          </tr>
          
          <tr>
            <th>Remarks</th>
            <td>
                <input type="datetime" class="form-control" name="remarks" placeholder="Remarks">
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

<div class="modal fade" role="dialog" id="modaledituser_appointment">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title-status">User Appointment Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      
      <form id="payment_request_form" action="{{ route('user_appointment.update', 1) }}" method="POST">
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
            <th>Assigned Agent Name</th>
            <td>
                <select name="assigned_agent_id" id="assigned_agent_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                    <option value="">Select Agent Name</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </td>
          </tr>
          
          
          
          <tr>
            <th>Appointment Datetime</th>
            <td>
                <input type="datetime-local" class="form-control" name="appointment_datetime" id="appointment_datetime" placeholder="Appointment Datetime">
            </td>
          </tr>
          
          <tr>
            <th>Appointment Status</th>
            <td>
                <select name="status" class="form-control select2 select2-hidden-accessible" id="status" style="width: 100%;">
                    <option value="">Select Appointment Status</option>
                    <option value="1">Pending For Agent Assign</option>
                    <option value="2">Assigned Agent</option>
                    <option value="3">In-Progress</option>
                    <option value="4">Appointment Completed</option>
                    <option value="5">Appointment Deleted</option>
                </select>
            </td>
          </tr>
          
          <tr>
            <th>Remarks</th>
            <td>
                <input type="datetime" class="form-control" name="remarks" id="remarks" placeholder="Remarks">
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
      <h3 class="card-title"><i class="fas fa-users"></i> User Appointment</h3>
        <div class="card-tools">
            <a class="btn btn-success btn-sm" href="#" data-toggle="modal" data-target="#modalAddnewuser_appointment" title="Add User Appointment"> 
                <i class="fas fa-plus-circle"></i> Add User Appointment
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
          <th>Appointment Datetime</th>
          <th>Assigned Agent Name</th>
          <th>Status</th>
          <th>Remark</th>
          
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($user_appointment as $zon)
            <tr>
                <td>{{ $zon->name }}</td>
                <td>{{  date("d-m-Y h:s", strtotime($zon->appointment_datetime)); }}</td>
                <td>{{ $zon->assigned_agent_name }}</td>
                <td><?php if($zon->status == 1) echo '<b style="color:red;">Pending For Agent Assign<b>'; 
                    elseif($zon->status == 2) echo '<b style="color:orange;">Assigned Agent<b>';
                    elseif($zon->status == 3) echo '<b style="color:blue;">In-Progress<b>';
                    elseif($zon->status == 4) echo '<b style="color:green;">Appointment Completed<b>';
                    else echo '<b style="color:red;">Appointment Deleted<b>'; ?></td>
                <td>{{ $zon->remarks }}</td>
            
               
                <td>
                    <form action="{{ route('user_appointment.destroy', $zon->id) }}" method="POST">   
                     <input type="hidden" name="id" value="{{ $zon->id }}">  
                    <a class="btn btn-info btn-xs" href="#" data-toggle="modal" data-target="#modaledituser_appointment" data-id="{{ $zon->id }}" 
                       data-user_id="{{ $zon->user_id }}" data-appointment_datetime="{{ $zon->appointment_datetime }}" data-assigned_agent_id="{{ $zon->assigned_agent_id }}" 
                       data-status="{{ $zon->status }}" data-remarks="{{ $zon->remarks }}" ><i class="fas fa-edit"></i></a>   
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