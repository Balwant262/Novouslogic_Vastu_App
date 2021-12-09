@extends('admin.layout.admin_layout')
   
@section('content')

<div class="modal fade" role="dialog" id="modalAddnewanswer">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title-status">QuestionnairQuestion Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      
      <form id="payment_request_form" action="{{ route('user_questionnair_answer.store') }}" method="POST">
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
            <th>Question</th>
            <td>
                <select name="question_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                    <option value="">Select Question</option>
                    @foreach ($questions as $pur)
                        <option value="{{ $pur->id }}">{{ $pur->question }}</option>
                    @endforeach
                </select>
            </td>
          </tr>
          
           <tr>
            <th>Answer</th>
            <td>
                <input type="text" class="form-control" name="answer" placeholder="Enetr Answer">
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

<div class="modal fade" role="dialog" id="modaleditanswer">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title-status">QuestionnairQuestion Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      
      <form id="payment_request_form" action="{{ route('user_questionnair_answer.update', 1) }}" method="POST">
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
            <th>Question</th>
            <td>
                <select name="question_id" id="question_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                    <option value="">Select Question</option>
                    @foreach ($questions as $pur)
                        <option value="{{ $pur->id }}">{{ $pur->question }}</option>
                    @endforeach
                </select>
            </td>
          </tr>
          
           <tr>
            <th>Answer</th>
            <td>
                <input type="text" class="form-control" name="answer" id="answer" placeholder="Enetr Answer">
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
            <a class="btn btn-success btn-sm" title="Add QuestionnairQuestion" href="#" data-toggle="modal" data-target="#modalAddnewanswer"> 
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
          <th>User Name</th>
          <th>Question</th>
          <th>Answer</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($anss as $zon)
            <tr>
                <td>{{ $zon->name }}</td>
                <td>{{ $zon->question }}</td>
                <td>{{ $zon->answer }}</td>
                <td>
                    <form action="{{ route('user_questionnair_answer.destroy', $zon->id) }}" method="POST">   
                     <input type="hidden" name="id" value="{{ $zon->id }}">  
                    <a class="btn btn-info btn-xs" href="#" data-toggle="modal" data-target="#modaleditanswer"  data-answer="{{ $zon->answer }}"
                       data-id="{{ $zon->id }}" data-question_id="{{ $zon->question_id }}" data-user_id="{{ $zon->user_id }}"><i class="fas fa-edit"></i></a>   
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