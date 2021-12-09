@extends('admin.layout.admin_layout')
   
@section('content')

<div class="modal fade" role="dialog" id="modalAddnewquestions">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title-status">QuestionnairQuestion Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      
      <form id="payment_request_form" action="{{ route('questionnair_questions.store') }}" method="POST">
          @csrf
        <input type="hidden" name="redirect_u" value="<?php echo $_SERVER['REQUEST_URI'] ?>">
        
        <!-- Modal body -->
        <div class="modal-body">
        <table class="table table-striped table-bordered">
          <tr>
            <th>Questionnair Question Name</th>
            <td>
            <textarea name="question" id="" cols="30" rows="4" class="form-control"></textarea>
            </td>
          </tr>
          
<!--          <tr>
            <th>Question Answer Type</th>
            <td>
                <select name="type" id="type" class="form-control ">
                    <option value="" disabled="" selected="">Please Select here</option>
                    <option value="radio_opt">Single Answer/Radio Button</option>
                    <option value="check_opt">Multiple Answer/Check Boxes</option>
                    <option value="textfield_s">Text Field/ Text Area</option>
                </select>
            </td>
          </tr>-->
          

          
          
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

<div class="modal fade" role="dialog" id="modaleditquestions">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title-status">QuestionnairQuestion Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      
      <form id="payment_request_form" action="{{ route('questionnair_questions.update', 1) }}" method="POST">
          @csrf
          @method('PUT')
        <input type="hidden" name="redirect_u" value="<?php echo $_SERVER['REQUEST_URI'] ?>">
        <input type="hidden" name="id" id="id">
        <!-- Modal body -->
        <div class="modal-body">
        <table class="table table-striped table-bordered">
          <tr>
            <th>Questionnair Question Name</th>
            <td>
            <textarea name="question" id="question" cols="30" rows="4" class="form-control"></textarea>
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
      <h3 class="card-title"><i class="fas fa-users"></i> Questionnair Question</h3>
        <div class="card-tools">
            <a class="btn btn-success btn-sm" title="Add QuestionnairQuestion" href="#" data-toggle="modal" data-target="#modalAddnewquestions"> 
                <i class="fas fa-plus-circle"></i> Add Questionnair Question
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
          <th>Question Name</th>
          
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($questions as $zon)
            <tr>
                <td>{{ $zon->question }}</td>
                
                <td>
                    <form action="{{ route('questionnair_questions.destroy', $zon->id) }}" method="POST">   
                     <input type="hidden" name="id" value="{{ $zon->id }}">  
                    <a class="btn btn-info btn-xs" href="#" data-toggle="modal" data-target="#modaleditquestions" data-id="{{ $zon->id }}" data-name="{{ $zon->question }}"><i class="fas fa-edit"></i></a>   
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