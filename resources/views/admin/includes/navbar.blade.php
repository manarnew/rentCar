@php
$sys =  App\Models\Panel_settings::where('id',1)->first();
@endphp
            
<nav style="background-color:{{ $sys['theme_color'] }}; color:#fff;" class="main-header navbar navbar-expand navbar-white navbar-light navbar-fixed-top">
 <!-- Left navbar links -->
 <ul class="navbar-nav">
    <li class="nav-item">
       <a style="color:#fff;" class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
       <a style="color:#fff;" href="{{ route('admin.dashboard') }}" class="nav-link">الرئيسية</a>
    </li>
 </ul>
 <!-- SEARCH FORM -->
 <form class="form-inline ml-3" method="POST" action="{{route('admin.customer.ajax_search_genral')}}">
   @csrf
    <div class="input-group input-group-sm">
        <!--dropdown-->
       <div class="input-group-append dropdown">
 
 <select class="btn btn-navbar dropdown-toggle" name="search_type" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  
   <option class="dropdown-item" value="1">رقم الهوية</option>
      <option class="dropdown-item" value="2">رقم الرخصة</option>
      <option class="dropdown-item" value="3">  @if (1<=2)
        {{ Date('y:m:d', strtotime('-3 days'));}}
     @endif</option>
     
 </select>
</div>
<!--/dropdown-->
<input name="search_by_text" class="form-control form-control-navbar" type="search" placeholder="بحث..." aria-label="Search">
       <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
          <i class="fas fa-search"></i>
          </button>
       </div>
    </div>
 </form>

 <!-- Right navbar links -->  
 <ul class="navbar-nav ml-auto">  
    <li class="nav-item">
                <a style="color:#fff;" href="{{ route('admin.logout') }}" class="nav-link"><i class="fas fa-sign-out-alt"></i></a>
    </li>
     <li class="nav-item">
        
           <!--modal-->
          <a href="#"class="nav-link btn btn-primarys" data-toggle="modal" data-target="#exampleModal">
           <i style="color:#fff;" class="fas fa-calculator"></i>
          </a>
    </li>
 </ul>
</nav>