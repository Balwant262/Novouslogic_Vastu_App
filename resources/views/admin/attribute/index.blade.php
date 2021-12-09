@extends('admin.layout.admin_layout')
   
@section('content')

<div class="modal fade" role="dialog" id="modalAddnewattribute">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title-status">Attribute Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      
      <form id="payment_request_form" action="{{ route('attribute.store') }}" method="POST">
          @csrf
        <input type="hidden" name="redirect_u" value="<?php echo $_SERVER['REQUEST_URI'] ?>">
        
        <!-- Modal body -->
        <div class="modal-body">
        <table class="table table-striped table-bordered">
          <tr>
            <th>Attribute Name</th>
            <td>
            <input type="text" class="form-control" name="name" placeholder="Attribute Name">
            </td>
          </tr>
          
          <tr>
            <th>Description</th>
            <td>
            <input type="text" class="form-control" name="description" placeholder="Description">
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

<div class="modal fade" role="dialog" id="modaleditattribute">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title-status">Attribute Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      
      <form id="payment_request_form" action="{{ route('attribute.update', 1) }}" method="POST">
          @csrf
          @method('PUT')
        <input type="hidden" name="redirect_u" value="<?php echo $_SERVER['REQUEST_URI'] ?>">
        <input type="hidden" name="id" id="id">
        <!-- Modal body -->
        <div class="modal-body">
        <table class="table table-striped table-bordered">
          <tr>
            <th>Attribute Name</th>
            <td>
                <input type="text" class="form-control" name="name" id="name" placeholder="Attribute Name">
            </td>
          </tr>
          
          <tr>
            <th>Description</th>
            <td>
                <input type="text" class="form-control" name="description" id="description" placeholder="Description">
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
      <h3 class="card-title"><i class="fas fa-users"></i> Attribute</h3>
        <div class="card-tools">
            <a class="btn btn-success btn-sm" title="Add Attribute" href="#" data-toggle="modal" data-target="#modalAddnewattribute"> 
                <i class="fas fa-plus-circle"></i> Add Attribute
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
          <th>Attribute Name</th>
          <th>Description</th>
          
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($attribute as $zon)
            <tr>
                <td>{{ $zon->name }}</td>
                <td>{{ $zon->description }}</td>
                <td>
                    <form action="{{ route('attribute.destroy', $zon->id) }}" method="POST">   
                     <input type="hidden" name="id" value="{{ $zon->id }}">  
                    <a class="btn btn-info btn-xs" href="#" data-toggle="modal" data-target="#modaleditattribute" data-id="{{ $zon->id }}" data-name="{{ $zon->name }}" data-description="{{ $zon->description }}"><i class="fas fa-edit"></i></a>   
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