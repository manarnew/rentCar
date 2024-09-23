<!DOCTYPE html>
<html lang="en">
  @php
  $langCurent = "Illuminate\Support\Facades\App";
@endphp
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>
      @if ($langCurent::isLocale('en'))
      {{ App\Models\setting::where('id', 1)->value('eng_name') }} 
  @else
  {{ App\Models\setting::where('id', 1)->value('name') }} 
  @endif
    </title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/front/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/assets/vendor/aos/aos.css" rel="styleshee') }}t">
    <link href="{{ asset('assets/front/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/amiri.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css">
  <!-- Main CSS File -->
  <link href="{{ asset('assets/front/assets/css/main.css') }}" rel="stylesheet">
  @if ($langCurent::isLocale('ar'))
           <style>
             /* app-rtl.css */
body {
    direction: rtl;
    text-align: right;
}

.float-end {
    float: left !important;
}

.float-start {
    float: right !important;
}

.me-4 {
    margin-left: 1.5rem !important;
    margin-right: 0 !important;
}

.ms-4 {
    margin-right: 1.5rem !important;
    margin-left: 0 !important;
}

/* Add more CSS rules as needed to reverse the layout direction */
           </style>
        @endif
  <style>
     
    .btn.btn-defult {
  background-color: #444242;
  color: #f8f5f5;
  border: none;
  padding: 2px 5px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 4px;
  transition: all 0.3s ease;
}

/* Estilos de hover para los botones */
.btn.btn-defult.hover-shadow:hover {
  background-color: #333;
  color: #fff;
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
  transform: translateY(-2px);
}

/* Estilos para el botón activo */
.btn.btn-defult.filter-active {
  background-color: #333;
  color: #fff;
}
@import url(https://fonts.googleapis.com/earlyaccess/droidarabicnaskh.css);
body{
  font-family: 'Droid Arabic Naskh', serif;
}
  </style>
  <!-- =======================================================
  * Template Name: Restaurantly
  * Template URL: https://bootstrapmade.com/restaurantly-restaurant-template/
  * Updated: Jun 29 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">
 
  <header id="header" class="header fixed-top">
    <div class="topbar py-2 " style="background-color:#0c0b09;height: 80px;">
      <div class="container">
        <div class="row align-items-center justify-content-between">
          <div class="col-auto col-md-6 contact-info">
            <a href="mailto:{{ App\Models\setting::where('id', 1)->value('email') }}" class=" me-3">
              <i class="bi bi-envelope"></i> {{ App\Models\setting::where('id', 1)->value('email') }}
            </a>
            <a href="tel:{{ App\Models\setting::where('id', 1)->value('phone') }}" >
              <i class="bi bi-phone"></i> {{ App\Models\setting::where('id', 1)->value('phone') }}
            </a>
          </div>
          <div class="col-auto language-selector" style="margin-top: 5px">
            <div >
              <button class="btn btn-secondary dropdown-toggle" style="background-color:#0c0b09" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-globe2 me-2"></i>
                Language
              </button>
              <ul class="dropdown-menu dropdown-menu-dark" style="background-color:#0c0b09">
                <li><a class="dropdown-item" href="{{route('langConverter','en')}}">
                  <img src="https://cdn.jsdelivr.net/npm/country-flag-emoji-json@2.0.0/dist/images/US.svg" alt="English" class="me-2" width="20" height="20">
                  English
                </a></li>
                <li><a class="dropdown-item" href="{{route('langConverter','ar')}}">
                  <img src="https://cdn.jsdelivr.net/npm/country-flag-emoji-json@2.0.0/dist/images/SA.svg" alt="Arabic" class="me-2" width="20" height="20">
                  العربية
                </a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <main class="main">
    <!-- Menu Section -->
    <section id="menu" class="menu section" style="margin-top: 35px">
      
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
       
        <h2>
          
          @if ($langCurent::isLocale('en'))
          Menu 
      @else
     <span style="font-family: 'Courier New', Courier, monospace;font-size: 20px;font-weight: bold"> منيو </span>
      @endif
          
        </h2>
      </div><!-- End Section Title -->
      
      <div class="container isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
        <div class="text-center" style="margin: 0  auto 50px auto;width:fit-content;    padding: 0 10px;    font-weight: 600; box-shadow: 2px 4px 6px 0 #3e3d3d;">
          <h1 style="color:#cda45e">   
         
            @if ($langCurent::isLocale('en'))
            {{ App\Models\setting::where('id', 1)->value('eng_name') }} 
        @else
        {{ App\Models\setting::where('id', 1)->value('name') }} 
        @endif
            <img src="{{ asset('assets/admin/uploads/1.svg') }}" style="width: 50px;height: 50px;color:#f8f5f5" ></h1>
          </div>
    <input type="hidden" id="token_search" value="{{ csrf_token() }}">
    <input type="hidden" id="ajax_search_url" value="{{ route('menu.ajax_search') }}">
    <div class="row" data-aos="fade-up" data-aos-delay="100">
      <div class="col-lg-12 d-flex justify-content-center">
        <ul class="menu-filters isotope-filters">
          @foreach ($category as $item)
          <a href="#" id="categoryadd" class="btn btn-defult btn-sm hover-shadow"  data-id="{{ $item->id }}"> <li  class="filter-active">
            @if ($langCurent::isLocale('en'))
            {{ $item->eng_name }}
        @else
        <span style="font-family: 'Courier New', Courier, monospace;font-weight: bold"> {{ $item->name }}</span>
        @endif
          </li></a> @endforeach
        </ul>
      </div>
    </div><!-- Menu Filters -->

    <div class="row
        isotope-container" data-aos="fade-up" data-aos-delay="200" id="divAjax">
    @foreach ($data as $item)
        <div class="col-lg-6 menu-item isotope-item filter-starters">
            <img src="{{ asset('assets/admin/uploads') . '/' . $item->image }}" class="menu-img" alt="" 
            style="min-width: 170px;max-width: 170px;min-height: 170px;max-height: 170px">
            <div class="menu-content">

                <span>
                    @if ($langCurent::isLocale('en'))
                        {{ $item->eng_name }}
                    @else
                    {{ $item->name }}
                    @endif
                </span><span style="direction: rtl">
                  @if ($langCurent::isLocale('en'))
                  {{ $item->price }} riyal 
              @else
              {{ $item->price }} ريال 
              @endif
                   
                  </span>
            </div>
            <div class="menu-ingredients">
              @if ($langCurent::isLocale('en'))
              {{ $item->eng_details }}
          @else
          {{ $item->details }}
          @endif
            </div>
        </div><!-- Menu Item -->
    @endforeach
    </div><!-- Menu Container -->

    </div>

    </section><!-- /Menu Section -->
    </main>

    <footer id="footer" class="footer">
        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">Restaurantly</strong> <span>All Rights
                    Reserved</span></p>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                Designed by <a href="https://bootstrapmade.com/">ManarSoft</a>
            </div>
        </div>

    </footer>


    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
     
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/front/assets/js/ajax.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>


    <!-- Main JS File -->


    </body>

</html>
