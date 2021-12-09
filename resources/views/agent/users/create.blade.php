@extends('agent.layout.admin_layout')
   
@section('content')

<section class="content"> 
    <div class="container-fluid">
        
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
        
        <form class="form-horizontal" action="{{ route('users.store') }}" method="POST">
             @csrf
        <div class="row">
            <div class="col-sm-6">
                <div class="card card-info">
                    <div class="card-header">
                      <h3 class="card-title">Besic Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                   
                      <div class="card-body">
                        
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">User Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" placeholder="User Name">
                          </div>
                        </div>
                          
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" placeholder="Email">
                          </div>
                        </div>
                          
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Contact Number</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" name="contact_number" placeholder="Contact Number">
                          </div>
                        </div>
                          
                          <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Password</label>
                          <div class="col-sm-10">
                              <input type="password" class="form-control" name="password" placeholder="Password">
                          </div>
                        </div>
  
                        
                      </div>
                      
                   
                </div>
            </div>
            
            
            
            
            <div class="col-sm-6">
                <div class="card card-info">
                    <div class="card-header">
                      <h3 class="card-title">Access/Other Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal">
                      <div class="card-body">
                          
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">User Type</label>
                          <div class="col-sm-10">
                              <select name="is_admin" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                                  <option value="">Select User Type</option>
                                  <option value="0">User</option>
                                  <option value="1">Agent</option>
                                  <option value="2">Superadmin</option>
                              </select>
                          </div>
                        </div>
                          
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Status</label>
                          <div class="col-sm-10">
                              <select name="status" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                                  <option value="">Select Status</option>
                                  <option value="0">Inactive</option>
                                  <option value="1">Active</option>
                              </select>
                          </div>
                        </div>
                          
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">No of Report Generate</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" name="no_of_report_generate" placeholder="No of Report Generate">
                          </div>
                        </div>
                          
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">FCM ID</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" name="fcm_id" placeholder="FCM ID">
                          </div>
                        </div>
                        
                      </div>
                      
                    </form>
                </div>
            </div>
            
            
            <div class="col text-center">
                
                <button type="submit" class="btn btn-info">Save</button>&nbsp;
                 
           
            </div>
            
            
            
        </div>    
        
    
     </form>
    </div>
</section>   
<!-- /.card -->

@endsection