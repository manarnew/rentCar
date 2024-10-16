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
            <a href="{{ route('admin.car.index') }}" class="small-box-footer"> تفاصيل <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{$not_available_car}}</h3>
              
              <p>السيارات الغير المتاحة</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ route('admin.car.index') }}" class="small-box-footer"> تفاصيل <i class="fas fa-arrow-circle-right"></i></a>
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
            <a href="{{ route('contracts.index') }}" class="small-box-footer">تفاصيل  <i class="fas fa-arrow-circle-right"></i></a>
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
            <a href="{{ route('contracts.index') }}" class="small-box-footer">تفاصيل  <i class="fas fa-arrow-circle-right"></i></a>
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
        <div class="embed-responsive embed-responsive-1by1">
          <form method="POST" action="https://madartech.net/authentication/store" accept-charset="UTF-8" class="form"><input name="_token" type="hidden" value="Q9NjBArX6EFpWFM2mo932pD2wh3RUy88XImJuasp">
             @csrf
            <div class="form-group">
                <input class="form-control" placeholder="Email" id="sign-in-form-email" name="email" type="email">
            </div>
            
            <div class="form-group">
                <input class="form-control" placeholder="Password" id="sign-in-form-password" name="password" type="password" value="">
            </div>
            
            
                <div class="form-group">
                    <div class="checkbox">
                        <input checked="checked" name="remember_me" type="checkbox" value="1">
                        <label>Remember me</label>
                    </div>
                </div>
            
            <button class="btn btn-lg btn-primary btn-block" name="Submit" value="Login" type="Submit">Sign in</button>
            
            <hr>
            
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12">
                        <a href="https://madartech.net/password_reminder" class="btn btn-block btn-lg btn-default">Forgot password?</a>
                    </div>
                    <div class="col-sm-12">
                                </div>
                </div>
            </div>
            
            </form>
        </div>
</div>
@endsection