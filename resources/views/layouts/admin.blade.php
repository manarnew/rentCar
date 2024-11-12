 @php
 $sys =  App\Models\PanelSetting::where('id',1)->first();
 @endphp
<!DOCTYPE html>
<!--
   This is a starter template page. Use this page to start your new project from
   scratch. This page gets rid of all links and provides the needed markup only.
   -->
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <meta name="theme-color" content="{{ $sys['theme_color'] }}">
      <meta name="msapplication-navbutton-color" content="{{ $sys['theme_color'] }}">
      <meta name="apple-mobile-web-app-status-bar-style" content="{{ $sys['theme_color'] }}">
      <title>@yield('title')</title>
      <!--logo header-->
       <link rel="icon" href="{{ asset('assets/admin/imgs/icon.ico') }}">
      <!-- Font Awesome Icons -->
      <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
      <!-- Theme style -->
      <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/adminlte.min.css')}}">
      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="{{ asset('assets/admin/css/no-print.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/admin/fonts/SansPro/SansPro.min.css')}}">
      <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap_rtl-v4.2.1/bootstrap.min.css')}}">
      <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap_rtl-v4.2.1/custom_rtl.css')}}">
      <link rel="stylesheet" href="{{ asset('assets/admin/css/mycustomstyle.css')}}">
      <!--google font-->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">
      @yield('css')
 <style>
       *{
        font-family: "Tajawal", sans-serif;
        font-weight: 700;
        font-style: normal;
        }
        
       #ajax_responce_serarchDiv{
     overflow-x:auto;
        }

           label {
            
            padding: 0.1rem;
            font-family: sans-serif;
            border-radius: 0.3rem;
            cursor: pointer;
            margin-top: 1rem;
            color: {{ $sys['theme_color'] }};
            /*background-color: {{ $sys['theme_color'] }};*/
         }
   </style>
   <!---->
   <style>
/*h1 {*/
/*  text-align: center;*/
/*  font: bold 80px Sans-Serif;*/
/*  padding: 40px 0;*/
/*}*/

.simple {
  background: #91877b;
  text-shadow: 0 1px 0 rgba(255, 255, 255, 0.4);
}

/*label {*/
/* color: #000;*/
/* }*/
/* label{*/
/*  text-shadow: 0 1px 0 #ccc,*/
/*               0 2px 0 #c9c9c9,*/
/*               0 3px 0 #bbb,*/
/*               0 4px 0 #b9b9b9,*/
/*               0 5px 0 #aaa,*/
/*               0 6px 1px rgba(0,0,0,.1),*/
/*               0 0 5px rgba(0,0,0,.1),*/
/*               0 1px 3px rgba(0,0,0,.3),*/
/*               0 3px 5px rgba(0,0,0,.2),*/
/*               0 5px 10px rgba(0,0,0,.25),*/
/*               0 10px 10px rgba(0,0,0,.2),*/
/*               0 20px 20px rgba(0,0,0,.15);*/
               /*background:#91877b;*/
/*}*/

.relief {
  background-color: #3a50d9;
  color: #e0eff2;
  font: italic bold 100px Georgia, Serif;
  text-shadow: -4px 3px 0 #3a50d9, -14px 7px 0 #0a0e27;
}

.close {
  background-color: #fff; 
  color: #202c2d;
  text-shadow:
    0 1px #808d93,
    -1px 0 #cdd2d5,
    -1px 2px #808d93,
    -2px 1px #cdd2d5,
    -2px 3px #808d93,
    -3px 2px #cdd2d5,
    -3px 4px #808d93,
    -4px 3px #cdd2d5,
    -4px 5px #808d93,
    -5px 4px #cdd2d5,
    -5px 6px #808d93,
    -6px 5px #cdd2d5,
    -6px 7px #808d93,
    -7px 6px #cdd2d5,
    -7px 8px #808d93,
    -8px 7px #cdd2d5;
}

.printers {
  background-color: #edde9c;
  color: #bc2e1e;
  text-shadow:
    0 1px 0px #378ab4,
    1px 0 0px #5dabcd,
    1px 2px 1px #378ab4,
    2px 1px 1px #5dabcd,
    2px 3px 2px #378ab4,
    3px 2px 2px #5dabcd,
    3px 4px 2px #378ab4,
    4px 3px 3px #5dabcd,
    4px 5px 3px #378ab4,
    5px 4px 2px #5dabcd,
    5px 6px 2px #378ab4,
    6px 5px 2px #5dabcd,
    6px 7px 1px #378ab4,
    7px 6px 1px #5dabcd,
    7px 8px 0px #378ab4,
    8px 7px 0px #5dabcd;
}

.glow {
  color: #444;
  text-shadow: 
    1px 0px 1px #ccc, 0px 1px 1px #eee, 
    2px 1px 1px #ccc, 1px 2px 1px #eee,
    3px 2px 1px #ccc, 2px 3px 1px #eee,
    4px 3px 1px #ccc, 3px 4px 1px #eee,
    5px 4px 1px #ccc, 4px 5px 1px #eee,
    6px 5px 1px #ccc, 5px 6px 1px #eee,
    7px 6px 1px #ccc;
}

.vamp {
  color: #92a5de;
  background: red;
  text-shadow:0px 0px 0 rgb(137,156,213),1px 1px 0 rgb(129,148,205),2px 2px 0 rgb(120,139,196),3px 3px 0 rgb(111,130,187),4px 4px 0 rgb(103,122,179),5px 5px 0 rgb(94,113,170),6px 6px 0 rgb(85,104,161),7px 7px 0 rgb(76,95,152),8px 8px 0 rgb(68,87,144),9px 9px 0 rgb(59,78,135),10px 10px 0 rgb(50,69,126),11px 11px 0 rgb(42,61,118),12px 12px 0 rgb(33,52,109),13px 13px 0 rgb(24,43,100),14px 14px 0 rgb(15,34,91),15px 15px 0 rgb(7,26,83),16px 16px 0 rgb(-2,17,74),17px 17px 0 rgb(-11,8,65),18px 18px 0 rgb(-19,0,57),19px 19px 0 rgb(-28,-9,48), 20px 20px 0 rgb(-37,-18,39),21px 21px 20px rgba(0,0,0,1),21px 21px 1px rgba(0,0,0,0.5),0px 0px 20px rgba(0,0,0,.2);
}
</style>
   </head>
   
   <body class="hold-transition sidebar-mini">
      
      <div class="wrapper">
         <!-- Navbar -->
         @include('admin.includes.navbar')
         <!-- /.navbar -->
         <!-- Main Sidebar Container -->
         @include('admin.includes.sidebar')
         <!--  End Main Sidebar Container -->
         <!-- Content Wrapper. Contains page content -->
         @include('admin.includes.content')
         <!-- /.content-wrapper -->
         @include('admin.includes.footer')
         <!-- Main Footer -->
      </div>
      <!-- ./wrapper -->
      <!-- REQUIRED SCRIPTS -->
      <!-- jQuery -->
      <script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>
      <!-- Bootstrap 4 -->
      <script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <!-- AdminLTE App -->
      <script src="{{ asset('assets/admin/dist/js/adminlte.min.js') }}"></script>
      <script src="{{ asset('assets/admin/js/general.js') }}"></script>
      @yield('script')
   </body>
</html>