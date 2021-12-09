@extends('admin.layout.admin_layout')
   
@section('content')

<div class="modal fade" role="dialog" id="modalAddnewactivity">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title-status">Activity Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      
      <form action="{{ route('activity.store') }}" method="POST">
          @csrf
        <input type="hidden" name="redirect_u" value="<?php echo $_SERVER['REQUEST_URI'] ?>">
        
        <!-- Modal body -->
        <div class="modal-body">
        <table class="table table-striped table-bordered">
          <tr>
            <th>Activity Name</th>
            <td>
            <input type="text" class="form-control" name="activity_name" placeholder="Activity Name">
            </td>
          </tr>
          
                   
        </table>

       
        </div>
         <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" >Save</button>
      </div>
    </form>
     

    </div>
  </div>
</div> 

<div class="modal fade" role="dialog" id="modaleditactivity">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title-status">Activity Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      
      <form action="{{ route('activity.update', 1) }}" method="POST">
          @csrf
          @method('PUT')
        <input type="hidden" name="redirect_u" value="<?php echo $_SERVER['REQUEST_URI'] ?>">
        <input type="hidden" name="id" id="id">
        <!-- Modal body -->
        <div class="modal-body">
        <table class="table table-striped table-bordered">
          <tr>
            <th>Activity Name</th>
            <td>
                <input type="text" class="form-control" name="activity_name" id="name" placeholder="Activity Name">
            </td>
          </tr>

        </table>

       
        </div>
         <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" >Save</button>
      </div>
    </form>
     

    </div>
  </div>
</div> 



<div class="card">
    <div class="card-header">
      <h3 class="card-title"><i class="fas fa-users"></i> Activity</h3>
        <div class="card-tools">
            <a class="btn btn-success btn-sm" title="Add Activity" href="#" data-toggle="modal" data-target="#modalAddnewactivity"> 
                <i class="fas fa-plus-circle"></i> Add Activity
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
          <th>Activity Name</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($activity as $zon)
            <tr>
                <td>{{ $zon->activity_name }}</td>
                
                <td>
                    <form action="{{ route('activity.destroy', $zon->id) }}" method="POST">   
                     <input type="hidden" name="id" value="{{ $zon->id }}">  
                    <a class="btn btn-info btn-xs" href="#" data-toggle="modal" data-target="#modaleditactivity" data-id="{{ $zon->id }}" data-name="{{ $zon->activity_name }}"><i class="fas fa-edit"></i></a>   
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