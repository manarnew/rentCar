@php
$driver_license_end_date_count = 0;
$number_of_km_mantince = 0;
$sys =  App\Models\PanelSetting::where('id',1)->first();
$data =  App\Models\Car::select('driver_license_end_date','km_for_mantince')->get();

foreach($data as $info){
if($info->driver_license_end_date  <= Date("Y-m-d")){
$driver_license_end_date_count++ ;
}
if($info->km_for_mantince  >= $sys->number_of_km_mantince){
$number_of_km_mantince++ ;
}
}
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
 
 <select style="width: 30px" class="btn btn-navbar dropdown-toggle" name="search_type" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <!--<option class="dropdown-item">حدد</option>-->
      <option class="dropdown-item" value="1">رقم الهوية</option>
      <option class="dropdown-item" value="2">رقم الرخصة</option>
      <option class="dropdown-item" value="3">رقم الحجز</option>
 </select>
</div>
<!--/dropdown-->
<input style="" name="search_by_text" class="form-control form-control-navbar" type="search" placeholder="بحث..." aria-label="Search">
       <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
          <i class="fas fa-search"></i>
          </button>
       </div>
    </div>
 </form>
 <!-- Right navbar links -->
   <ul class="navbar-nav ml-auto">
     <!-- Messages Dropdown Menu -->
   
     <!-- Notifications Dropdown Menu -->
     <li class="nav-item dropdown">
        <a style="color:#fff;" class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge"><div style="padding-top:0px;">{{$driver_license_end_date_count + $number_of_km_mantince}}</div></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
 <span class="dropdown-header">لوحة الإشعارات {{$driver_license_end_date_count + $number_of_km_mantince}}</span>
           <div class="dropdown-divider"></div>
           <a href="{{route('admin.car.license_end_date')}}" class="dropdown-item">
           <i class="fas fa-envelope mr-2 text-warning"></i>تجديد التراخيص {{ $driver_license_end_date_count }} 
           <span class="float-right text-muted text-sm">3 دقيقة</span>
           </a>
           <div class="dropdown-divider"></div>
           <a href="{{route('admin.car.mantince_notf')}}" class="dropdown-item">
           <i class="fas fa-users mr-2 text-danger"></i>وقت الصيانة {{$number_of_km_mantince}}
           <span class="float-right text-muted text-sm">12 ساعة</span>
           </a>
           <div class="dropdown-divider"></div>
           <!--<a href="#" class="dropdown-item">-->
           <!--<i class="fas fa-file mr-2 text-success"></i> 3 اشعارات النظام-->
           <!--<span class="float-right text-muted text-sm">2 يوم</span>-->
           <!--</a>-->
           <!--<div class="dropdown-divider"></div>-->
         <center><a href="#" class="dropdown-item dropdown-footer">معاينة الكل</a></center>
        </div>
     </li>
 <!-- </ul>-->
 <!--<ul class="navbar-nav ml-auto">-->
    <li class="nav-item">
                <a style="color:#fff;" href="{{ route('admin.logout') }}" class="nav-link"><i class="fas fa-sign-out-alt"></i></a>
</li>
       <!--lng-->
    
       <!--/lng-->
       
    </li>
     <li class="nav-item">
        
           <!--modal-->
          <a href="#"class="nav-link btn btn-primarys" data-toggle="modal" data-target="#exampleModal">
           <i style="color:#fff;" class="fas fa-calculator"></i>
          </a>
    </li>
 </ul>
</nav>