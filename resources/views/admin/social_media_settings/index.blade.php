@extends('admin.layout.admin_layout')
   
@section('content')

<div class="modal fade" role="dialog" id="modalAddnewsocial_media_settings">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title-status">SocialMediaSettings Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      
      <form id="payment_request_form" action="{{ route('social_media_settings.store') }}" method="POST">
          @csrf
        <input type="hidden" name="redirect_u" value="<?php echo $_SERVER['REQUEST_URI'] ?>">
        
        <!-- Modal body -->
        <div class="modal-body">
        <table class="table table-striped table-bordered">
          <tr>
            <th>SocialMediaSettings Name</th>
            <td>
            <input type="text" class="form-control" name="direction_name" placeholder="SocialMediaSettings Name">
            </td>
          </tr>
          
          <tr>
            <th>Synonym</th>
            <td>
            <input type="text" class="form-control" name="synonym" placeholder="Synonym">
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

<div class="modal fade" role="dialog" id="modaleditsocial">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title-status">Social Media Settings Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      
      <form id="payment_request_form" action="{{ route('social_media_settings.update', 1) }}" method="POST">
          @csrf
          @method('PUT')
        <input type="hidden" name="redirect_u" value="<?php echo $_SERVER['REQUEST_URI'] ?>">
        <input type="hidden" name="id" id="id">
        <!-- Modal body -->
        <div class="modal-body">
        <table class="table table-striped table-bordered">
          <tr>
            <th>Show in the Application</th>
            <td>
                <input type="text" class="form-control" name="show_in_the_application" id="main" placeholder="Show in the Application">
            </td>
          </tr>
          
          <tr>
            <th>Youtube Page</th>
            <td>
                <input type="text" class="form-control" name="youtube_page" id="youtube" placeholder="Youtube Page">
            </td>
          </tr>
          
          <tr>
            <th>Facebook Page</th>
            <td>
                <input type="text" class="form-control" name="facebook_page" id="facebook" placeholder="Facebook Page">
            </td>
          </tr>
          
          <tr>
            <th>Instagram Page</th>
            <td>
                <input type="text" class="form-control" name="instagram_page" id="insta" placeholder="Instagram Page">
            </td>
          </tr>
          
          <tr>
            <th>LinkedIn Page</th>
            <td>
                <input type="text" class="form-control" name="linkedIn_page" id="linkedin" placeholder="LinkedIn Page">
            </td>
          </tr>
          
          <tr>
            <th>Tweeter Page</th>
            <td>
                <input type="text" class="form-control" name="tweeter_page" id="tweet" placeholder="Tweeter Page">
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
      <h3 class="card-title"><i class="fas fa-users"></i> SocialMediaSettings</h3>
        <div class="card-tools">
<!--            <a class="btn btn-success btn-sm" title="Add SocialMediaSettings" href="#" data-toggle="modal" data-target="#modalAddnewsocial_media_settings"> 
                <i class="fas fa-plus-circle"></i> Add SocialMediaSettings
            </a>    -->
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
          <th>Main Video</th>
          <th>Youtube</th>
          <th>facebook</th>
          <th>instagram</th>
          <th>linkedIn</th>
          <th>tweeter</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($social_media_settings as $zon)
            <tr>
                <td><a target="_blank" href="{{ $zon->show_in_the_application}}">Open</td>
                <td><a target="_blank" href="{{ $zon->youtube_page}}">Open</td>
                <td><a target="_blank" href="{{ $zon->facebook_page}}">Open</td>
                <td><a target="_blank" href="{{ $zon->instagram_page}}">Open</td>
                <td><a target="_blank" href="{{ $zon->linkedIn_page}}">Open</td>
                <td><a target="_blank" href="{{ $zon->tweeter_page}}">Open</td>
                
                <td>
                    <form action="{{ route('social_media_settings.destroy', $zon->id) }}" method="POST">   
                     <input type="hidden" name="id" value="{{ $zon->id }}">  
                    <a class="btn btn-info btn-xs" href="#" data-toggle="modal" data-target="#modaleditsocial" data-id="{{ $zon->id }}" 
                       data-main="{{ $zon->show_in_the_application }}" data-youtube="{{ $zon->youtube_page }}" data-facebook="{{ $zon->facebook_page }}"
                       data-insta="{{ $zon->instagram_page }}" data-linkedin="{{ $zon->linkedIn_page }}" data-tweet="{{ $zon->tweeter_page }}"><i class="fas fa-edit"></i></a>   
                    @csrf
                    @method('DELETE')      
<!--                    <button class="btn btn-danger btn-xs" type="submit" class=""><i class="fas fa-trash"></i></button>-->
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