 @php
 $sys =  App\Models\PanelSetting::where('id',1)->first();
 @endphp
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <meta name="theme-color" content="{{ $sys['theme_color'] }}" media="(prefers-color-scheme: light)">
      <!--<meta name="theme-color" content="#0b3e05" media="(prefers-color-scheme: dark)">-->
      <title>تسجيل الدخول</title>
      <!--icon header-->
      <link rel="icon" href="{{ asset('assets/admin/imgs/icon.ico') }}">
      <!-- Tell the browser to be responsive to screen width -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
      <!-- Ionicons -->
      <link rel="stylesheet" href="{{ asset('assets/admin/fonts/ionicons/2.0.1/css/ionicons.min.css') }}">
      <!-- icheck bootstrap -->
      <link rel="stylesheet" href="{{ asset('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
      <!-- Theme style -->
      <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/adminlte.min.css') }}">
      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="{{ asset('assets/admin/fonts/SansPro/SansPro.min.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap_rtl-v4.2.1/bootstrap.min.css')}}">
      <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap_rtl-v4.2.1/custom_rtl.css')}}">
      
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">
      <style>
      *{
        font-family: "Tajawal", sans-serif;
        font-weight: 700;
        font-style: normal;
        }
      #ajax_responce_serarchDiv{
       overflow-x:auto;
      }
      </style>

      <style>
         .login-box-msg, .register-box-msg {
         margin: 0;
         padding: 0 20px 20px;
         text-align: center;
         color: brown;
         font-size: 1.5vw;
         }
         span.fas {
         color: brown;
         }
         /**/
         
         
::-webkit-scrollbar {
    width: 6px;
	height: 6px
}

::-webkit-scrollbar-track {
    background: #fff;
	border-radius:2px;
	box-shadow: inset 0 0 10px rgba(0, 0, 0, 0, 25);
}

::-webkit-scrollbar-thumb {
    background: #A52A2A;
	border-radius:5px;
	
}

::-webkit-scrollbar-thumb:hover {
    background: #A52A2A;
}
   
    thead{
    background-color:#ccc;
    color:#000;
}
table{
  border: 1px solid #ccc;
  border-radius: 10px;
}

      </style>
   </head>
   <body class="hold-transition login-page" style="
   background-image: url({{ asset('assets/admin/imgs/backgruond.webp') }}) ;
   background-repeat: no-repeat; background-attachment: fixed; background-size: cover;">
       
      <div class="col-lg-3 col-xs-6 text-center login-box">
 
         <!-- /.login-logo -->
         <center>
             @php
$sys =  App\Models\PanelSetting::where('id',1)->first();
@endphp
   <!-- Brand Logo -->
   <a href="{{ route('admin.dashboard') }}" class="brand-link">
          <img class="brand-images img-circles eelevation-3" style="opacity: .8" src="{{ asset('assets/admin/uploads').'/'.$sys->photo }}"   width="250px" height="" alt="لوجو الشركة"><br>      
   <br><span class="brand-text font-weight-light" > 
<b style="font-weight: bold; padding:10px; background-color:#; color:#2E7E7C;">{{$sys->system_name}}</b>
</span>
   </a> 
   
         </center>
         <div class="card" >
            <div class="card-body login-card-body">
               @if(Session::has('error'))
               <div class="alert alert-danger" role="alert">
                  {{  Session::get('error') }}
               </div>
               @endif
               <b class="login-box-mseg">تسجيل الدخول</b>
               <form action="{{ route('admin.login') }}" method="post">
                  @csrf
                  <div class="input-group mb-3"> 
                  <div class="input-group-append">
                        <div class="input-group-text">
                           <span class="fas fa-envelope"></span>
                        </div>
                     </div>
                     <input  type="text" name="username" class="form-control" placeholder="username">
                    
                  </div>
                  @error('username')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                  <div class="input-group mb-3">
                    <div class="input-group-append">
                        <div class="input-group-text">
                           <span class="fas fa-lock"></span>
                        </div>
                     </div>
                     <input type="password" name="password" class="form-control" placeholder="Password">
                     
                  </div>
                  @error('password')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                  <div class="row">
                     <!-- /.col -->
                     <div class="col-lg-12 col-sm-3 col-xs-6 text-center">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">دخول </button>
                     </div>
                     <!-- /.col -->
                  </div>
                  <!--<center>-->
                  <!--   <p>username: admin</p>-->
                  <!--   <p>password: 12345678</p>-->
                  <!--  </center>-->
               </form>
            </div>
            <!-- /.login-card-body -->
         </div>
      </div>
      <!-- /.login-box -->
      <!-- jQuery -->
      <script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>
      <!-- Bootstrap 4 -->
      <script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
   </body>
</html>