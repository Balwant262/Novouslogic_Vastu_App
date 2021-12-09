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
        
        <form class="form-horizontal" action="{{ route('user_address.update',$userAddress->id) }}" method="POST">
             @csrf
             @method('PUT')
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
                          <label for="inputEmail3" class="col-sm-2 col-form-label">Select User</label>
                          <div class="col-sm-10">
                              <select name="user_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                                <option value="">Select User</option>
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}" <?php if($user->id == $userAddress->user_id) echo 'selected'; ?>>{{ $user->name }}</option>
                                @endforeach
                              </select>
                          </div>
                        </div>
                          
                        
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Address Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="address_name" value="{{ $userAddress->address_name }}" placeholder="Address Name">
                          </div>
                        </div>
                          
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Address Line 1</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="address_line_1" value="{{ $userAddress->address_line_1 }}" placeholder="Email">
                          </div>
                        </div>
                          
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Address Line 2</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" name="address_line_2" value="{{ $userAddress->address_line_2 }}" placeholder="Address Line 2">
                          </div>
                        </div>
                          
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Address Line 3</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="address_line_3" value="{{ $userAddress->address_line_3 }}" placeholder="Address Line 3">
                          </div>
                        </div>
                          
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Select City</label>
                          <div class="col-sm-10">
                              <select name="city_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                                <option value="">Select City</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}" <?php if($city->id == $userAddress->city_id) echo 'selected'; ?>>{{ $city->name }}</option>
                                @endforeach
                              </select>
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
                          <label class="col-sm-2 col-form-label">Status</label>
                          <div class="col-sm-10">
                              <select name="status" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                                  <option value="">Select Status</option>
                                  <option value="0" <?php if(0 == $userAddress->status) echo 'selected'; ?>>Inactive</option>
                                  <option value="1" <?php if(1 == $userAddress->status) echo 'selected'; ?>>Active</option>
                              </select>
                          </div>
                        </div>
                          
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Is Default</label>
                          <div class="col-sm-10">
                              <select name="is_default" class="form-control select2 select2-hidden-accessible" style="width: 100%;">
                                  <option value="">Select Is Default</option>
                                  <option value="0" <?php if(0== $userAddress->is_default) echo 'selected'; ?>>No</option>
                                  <option value="1" <?php if(1 == $userAddress->is_default) echo 'selected'; ?>>Yes</option>
                              </select>
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