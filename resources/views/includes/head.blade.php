<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta name="description" content="" />
<meta name="author" content="" />
<title>DHD Software</title>
<!-- loader-->
<!-- <link href="{{asset('assets/css/pace.min.css')}}" rel="stylesheet" /> -->
<!-- <script src="{{asset('assets/js/pace.min.js')}}"></script> -->
<!--favicon-->
<link rel="icon" href="{{asset('assets/images/favicon.ico')}}" type="image/x-icon">
<!-- Vector CSS -->
<link href="{{asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet" />
<!-- simplebar CSS-->
<link href="{{asset('assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
<!-- Bootstrap core CSS-->
<link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
<!-- animate CSS-->
<link href="{{asset('assets/css/animate.css')}}" rel="stylesheet" type="text/css" />
<!-- Icons CSS-->
<link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css" />
<!-- Sidebar CSS-->
<link href="{{asset('assets/css/sidebar-menu.css')}}" rel="stylesheet" />
<!-- Custom Style-->
<link href="{{asset('assets/css/app-style.css')}}" rel="stylesheet" />
<!-- datattable -->
<link href='https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>
<link href='https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css' rel='stylesheet' type='text/css'>

<style>
  .boldclass {
    font-weight: bold;
  }

  p {
    -webkit-user-select: all;
    /* Safari */
    -ms-user-select: all;
    user-select: all;
    margin: 0;
    white-space: pre-wrap;
  }

  .read-more-show {
    cursor: pointer;
    color: #ed8323;
  }

  .read-more-hide {
    cursor: pointer;
    color: #ed8323;
  }

  .hide_content {
    display: none;
  }

  .error {
    color: red;
  }

  .dataTables_wrapper .dataTables_length select {
    color: #fff;
  }

  .dataTables_wrapper .dataTables_filter input {
    color: #fff;
  }

  .dataTables_wrapper .dataTables_info {
    color: #fff;
  }

  .dataTables_wrapper .dataTables_paginate .paginate_button {
    color: #fff;
  }

  /* Add your styling here */
  .submenu {
    display: none;
  }

  /* Add arrow styling */
  .has-submenu>a::before {
    content: '\25B8';
    /* Unicode character for a right-pointing triangle */
    float: right;
    margin-right: 5px;
    /* Adjust spacing as needed */
  }

  .has-submenu.active>a::before {
    content: '\25BE';
    /* Unicode character for a down-pointing triangle */
  }

  .submenu.active {
    display: block;
  }

  #exTab2 h3 {
    color: white;
    padding: 5px 15px;
  }

  .dataTables_paginate {
    background-color: aliceblue;
  }
</style>
@yield('style')