@extends('layouts.admin')
@section('title')
الرئيسية
@endsection
@section('contentheader')
الرئيسية
@endsection
@section('contentheaderlink')
<a href="{{ route('admin.dashboard') }}"> الرئيسية </a>
@endsection
@section('contentheaderactive')
عرض
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{$available_car}}</h3>

              <p>السيارات المتاحة</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{ route('admin.dashboard.car_dashboard',1) }}" class="small-box-footer"> تفاصيل <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{$not_available_car}}</h3>
              
              <p>السيارات  المحجوزة</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ route('admin.dashboard.car_dashboard',2) }}" class="small-box-footer"> تفاصيل <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{$Customer}}</h3>

              <p>العملاء</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('admin.customer.index') }}" class="small-box-footer">تفاصيل  <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{$Contracts}}</h3>

              <p> الحجوزات </p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('contracts.index') }}" class="small-box-footer">تفاصيل  <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-secondary">
            <div class="inner">
              <h3>{{$today_reserved_car}}</h3>

              <p>حجوزات اليوم  </p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('admin.dashboard.contracts_dashboard',1) }}" class="small-box-footer">تفاصيل  <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box text-light bg-dark">
            <div class="inner">
              <h3>{{$today_end_reserved_car}}</h3>

              <p>حجوزات تنتهي اليوم  </p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('admin.dashboard.contracts_dashboard',2) }}" class="small-box-footer">تفاصيل  <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      
        
         <div class="col-lg-3 col-6">
          <!-- small box -->
           @php
 $sys =  App\Models\PanelSetting::where('id',1)->first();
 @endphp
          <div style="background-color:{{ $sys['theme_color'] }}; color:#fff;" class="small-box">
            <div class="inner">
              <h3>{{$Contracts_on_wait}}</h3>

              <p>حجوزات نشطة </p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('admin.dashboard.contracts_dashboard',3) }}" class="small-box-footer">تفاصيل  <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
          <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-light">
            <div class="inner">
              <h3>{{$debentures}}</h3>

              <p>سندات القبض</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('debentures.index') }}" class="small-box-footer">تفاصيل  <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <hr>
        <!---->
        <div class="col-lg-12 col-md5">
          <!-- 21:9 aspect ratio -->
<!--<div class="embed-responsive embed-responsive-21by9">-->
<!--  <iframe class="embed-responsive-item" src="https://printdesign1.com"></iframe>-->
<!--</div>-->

<!-- 16:9 aspect ratio -->
<!--<div class="embed-responsive embed-responsive-16by9">-->
<!--  <iframe class="embed-responsive-item" src="https://printdesign1.com"></iframe>-->
<!--</div>-->

<!-- 4:3 aspect ratio -->
<!--<div class="embed-responsive embed-responsive-4by3">-->
<!--  <iframe class="embed-responsive-item" src="https://printdesign1.com"></iframe>-->
<!--</div>-->

<!-- 1:1 aspect ratio -->
<!--<div class="embed-responsive embed-responsive-1by1">-->
<!--  <iframe class="embed-responsive-item" src="{{ $sys['country_key'] }}"></iframe>-->
<!--</div>-->
        </div>
        <!---->
        
</div>
@endsection