<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('admin_style/plugins/fontawesome-free/css/all.min.css') }}">
   <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('admin_style/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin_style/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin_style/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin_style/dist/css/adminlte.min.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('admin_style/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin_style/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
<!--      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>-->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
      <li class="nav-item">
          <a data-widget="navbar-search" role="button" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
              <span>{{ __('Logout') }}</span>
            </a>
      </li>

      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{ asset('admin_style/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Vaastu App </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('admin_style/dist/img/avatar.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>

        </div>
          
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{ route('agent.home') }}" class="nav-link {{ Route::is('agent.home') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                
              </p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                User Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('agent_users.index') }}" class="nav-link {{ Route::is('users.index') ? 'active' : '' }}">
                  <i class="fas fa-user-friends nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{ route('agent_user_address.index') }}" class="nav-link {{ Route::is('user_address.index') ? 'active' : '' }}">
                  <i class="fa fa-address-book nav-icon"></i>
                  <p>User Address</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{ route('agent_user_layout.index') }}" class="nav-link {{ Route::is('user_layout.index') ? 'active' : '' }}">
                  <i class="fa fa-home nav-icon"></i>
                  <p>User Home Layout</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{ route('agent_user_appointment.index') }}" class="nav-link {{ Route::is('user_appointment.index') ? 'active' : '' }}">
                  <i class="nav-icon far fa-calendar-alt"></i>
                  <p>User Appointment</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{ route('agent_user_report.index') }}" class="nav-link {{ Route::is('user_appointment.index') ? 'active' : '' }}">
                  <i class="nav-icon fa fa-file"></i>
                  <p>User Report</p>
                </a>
              </li>
              
            </ul>
          </li>
          
          
          
          
          <li class="nav-item menu-open">
            <a href="{{ route('agent_videotips.index') }}" class="nav-link {{ Route::is('videotips.index') ? 'active' : '' }}">
              <i class="nav-icon fas fa-video"></i>
              <p>
                Videos & Tips
                
              </p>
            </a>
          </li>
          
         <li class="nav-item menu-open">
            <a href="{{ route('agent_news.index') }}" class="nav-link {{ Route::is('news.index') ? 'active' : '' }}">
              <i class="nav-icon fas fa-bullhorn"></i>
              <p>
                Announcement & News
                
              </p>
            </a>
          </li>
          
          
          
          
          <li class="nav-item">
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>{{ __('Logout') }}
              
              </p>
            </a>
               <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
               </form>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @yield('content')
    <!-- /.content-header -->

   
  </div>
  <!-- /.content-wrapper -->


  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2021 <a href="https://novuslogic.in/">NovusLogic</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('admin_style/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admin_style/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('admin_style/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin_style/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin_style/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin_style/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin_style/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('admin_style/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin_style/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('admin_style/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('admin_style/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('admin_style/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('admin_style/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('admin_style/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>


<!-- AdminLTE App -->
<script src="{{ asset('admin_style/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('admin_style/dist/js/demo.js') }}"></script>
<!-- Page specific script -->
<!-- Select2 -->
<script src="{{ asset('admin_style/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
   //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    
$('#modalAddnewzone').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
});
   
$('#modaleditzone').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal   
    var id = button.data('id');
    var name = button.data('name');
    var synonym = button.data('synonym');
    
    $('#id').val(id);
    $('#name').val(name);
    $('#synonym').val(synonym);
});

$('#modaleditactivity').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal   
    var id = button.data('id');
    var name = button.data('name');
    
    $('#id').val(id);
    $('#name').val(name);
});
$('#modalAddnewactivity').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
});


$('#modaleditpurpose').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal   
    var id = button.data('id');
    var name = button.data('name');
    
    $('#id').val(id);
    $('#name').val(name);
});
$('#modalAddnewpurpose').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
});

$('#modalAddnewattribute').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
});
$('#modaleditattribute').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal   
    var id = button.data('id');
    var name = button.data('name');
    var synonym = button.data('description');
    
    $('#id').val(id);
    $('#name').val(name);
    $('#description').val(synonym);
});

$('#modalAddnewtips').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
});
$('#modaledittips').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal   
    var id = button.data('id');
    var name = button.data('name');
    var description = button.data('description');
    var source_link = button.data('source');
    
    $('#id').val(id);
    $('#name').val(name);
    $('#description').val(description);
    $('#source_link').val(source_link);
});

$('#modalAddnewnews').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
});
$('#modaleditnews').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal   
    var id = button.data('id');
    var name = button.data('name');
    var description = button.data('description');
    var source_link = button.data('source');
    
    $('#id').val(id);
    $('#name').val(name);
    $('#description').val(description);
    $('#source_link').val(source_link);
});

$('#modalAddnewdirection_attribute').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
});
$('#modaleditdirection_attribute').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal   
    var id = button.data('id');
    var attribute_id = button.data('attribute_id');
    var zone_id = button.data('zone_id');
    
    $('#id').val(id);
    $('#zone_id').val(zone_id).trigger('change');
    $('#attribute_id').val(attribute_id).trigger('change');
});


$('#modalAddnewzone_issue').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
});
$('#modaleditzone_issue').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal   
    var id = button.data('id');
    var activity_id = button.data('activity_id');
    var zone_id = button.data('zone_id');
    var purpose_id = button.data('purpose_id');
    var issue_facing = button.data('issue_facing');
    
    $('#id').val(id);
    $('#zone_id').val(zone_id).trigger('change');
    $('#activity_id').val(activity_id).trigger('change');
    $('#purpose_id').val(purpose_id).trigger('change');
    $('#issue_facing').val(issue_facing);
});


$('#modalAddnewuser_appointment').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
});
$('#modaledituser_appointment').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal   
    var id = button.data('id');
    var user_id = button.data('user_id');
    var appointment_datetime = button.data('appointment_datetime');
    var assigned_agent_id = button.data('assigned_agent_id');
    var status = button.data('status');
    var remarks = button.data('remarks');
    
    const d = new Date(appointment_datetime);
    console.log(d.toISOString().substr(0,16));
    let text = d.toISOString().substr(0,16);
    
    
    $('#id').val(id);
    $('#user_id').val(user_id).trigger('change');
    $('#assigned_agent_id').val(assigned_agent_id).trigger('change');
    $('#status').val(status).trigger('change');
    $('#appointment_datetime').val(text);
    $('#remarks').val(remarks);
});

$('#modalAddnewuser_layout').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
});
$('#modaledituser_layout').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal   
    var id = button.data('id');
    var user_id = button.data('user_id');
    var address_id = button.data('address_id');
    var zone_id = button.data('zone_id');
    var activity_id = button.data('activity_id');

    $('#id').val(id);
    $('#user_id').val(user_id).trigger('change');
    $('#address_id').val(address_id).trigger('change');
    $('#zone_id').val(zone_id).trigger('change');
    $('#activity_id').val(activity_id).trigger('change');
});

$('#modalAddnewuser_report').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
});
$('#modaledituser_report').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal   
    var id = button.data('id');
    var user_id = button.data('user_id');
    var address_id = button.data('address_id');
    
    $('#id').val(id);
    $('#user_id').val(user_id).trigger('change');
    $('#address_id').val(address_id).trigger('change');
    
});
</script>
</body>
</html>


