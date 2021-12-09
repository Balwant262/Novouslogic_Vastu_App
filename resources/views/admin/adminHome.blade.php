@extends('admin.layout.admin_layout')
   
@section('content')
<div class="container-fluid">
    <br>
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user-friends"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Users</span>
                <span class="info-box-number"> {{ $user_count }} </span>
              </div>
              <a href="{{ route('users.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="far fa-calendar-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pending Appointment</span>
                <span class="info-box-number"> {{ $papp_count }} </span>
              </div>
              <!-- /.info-box-content -->
              <a href="{{ route('user_appointment.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="far fa-calendar-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">All Appointment</span>
                <span class="info-box-number">{{ $aapp_count }}</span>
              </div>
              <!-- /.info-box-content -->
              <a href="{{ route('user_appointment.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="far fa-calendar-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Cancelled Appointment</span>
                <span class="info-box-number">{{ $capp_count }}</span>
              </div>
              <!-- /.info-box-content -->
              <a href="{{ route('user_appointment.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
    
    <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-gradient-blue elevation-1"><i class="fas fa-video"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Videos & Tips</span>
                <span class="info-box-number"> {{ $v_count }} </span>
              </div>
              <a href="{{ route('videotips.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-gradient-indigo elevation-1"><i class="fas fa-bullhorn"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Announcement & News</span>
                <span class="info-box-number"> {{ $ann_count }} </span>
              </div>
              <a href="{{ route('news.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
    </div>
</div>

@endsection