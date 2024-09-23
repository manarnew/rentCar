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
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Amatic+SC:wght@400;700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/front/light/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/light/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/light/vendor/aos/aos.css" rel="stylesheet') }}">
    <link href="{{ asset('assets/front/light/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/light/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/front/light/css/main.css') }}" rel="stylesheet">
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
            background-color: #18146d;
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
            background-color: rgb(9, 15, 57);
            color: #fff;
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
            transform: translateY(-2px);
        }

        /* Estilos para el botón activo */
        .btn.btn-defult.filter-active {
            background-color: rgb(19, 15, 145);
            color: #fff;
        }

        .thumb-container {
            width: 300px;
            height: 200px;
            overflow: hidden;
            padding: 5px;
            border: 1px solid #e1e1e1;
            border-radius: 8px;
            margin: 20px;
        }

        .thumb-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 5px;
        }

        .thumb-image:hover {
            scale: 1.02;
            cursor: pointer;
        }

        .thumb-container:hover {
            box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
        }
    </style>
</head>

<body class="index-page">

    <header id="header" class="header fixed-top">
        <div class="topbar py-2 bg-white border-bottom">
          <div class="container">
            <div class="row align-items-center justify-content-between">
              <div class="col-auto col-md-6 contact-info">
                <a href="mailto:{{ App\Models\setting::where('id', 1)->value('email') }}" class="text-dark me-3">
                  <i class="bi bi-envelope"></i> {{ App\Models\setting::where('id', 1)->value('email') }}
                </a>
                <a href="tel:{{ App\Models\setting::where('id', 1)->value('phone') }}" class="text-dark">
                  <i class="bi bi-phone"></i> {{ App\Models\setting::where('id', 1)->value('phone') }}
                </a>
              </div>
              <div class="col-auto language-selector">
                <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-globe2 me-2"></i>
                    Language
                  </button>
                  <ul class="dropdown-menu dropdown-menu-dark">
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
    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    <main class="main">


        <!-- Menu Section -->
        <section id="menu" class="menu section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up" style="margin-top: 40px">
                <div class="text-center"
                    style="margin: 0  auto 50px auto;width:fit-content;    padding: 0 10px;    font-weight: 600; box-shadow: 2px 4px 6px 0 #f3f2f2;">
                    <h1 style="color:#070707"> 
                        @if ($langCurent::isLocale('en'))
                        {{ App\Models\setting::where('id', 1)->value('eng_name') }} 
                    @else
                    {{ App\Models\setting::where('id', 1)->value('name') }} 
                    @endif
                        <img src="{{ asset('assets/admin/uploads/1.svg') }}"
                            style="width: 50px;height: 50px;color:#f8f5f5">
                    </h1>
                </div>
                <h2>
                    @if ($langCurent::isLocale('en'))
                    Menu 
                @else
               <span style="font-family: 'Courier New', Courier, monospace;font-size: 20px;font-weight: bold"> منيو</span>
                @endif
                </h2>
                <p>
                    @if ($langCurent::isLocale('en'))
                    <span>Check Our</span> 
                    <span class="description-title">Yummy Menu</span>
                    @else
                    <span style="font-family: 'Courier New', Courier, monospace;font-size: 20px;font-weight: bold">تفضل بالاطلاع على</span> 
               <span style="font-family: 'Courier New', Courier, monospace;font-size: 20px;font-weight: bold" class="description-title"> قائمتنا اللذيذة</span>
                    @endif
                </p>
            </div><!-- End Section Title -->

            <div class="container">

                <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">

                    @foreach ($category as $item)
                        <a href="#" id="categoryadd" class="btn btn-defult hover-shadow"
                            data-id="{{ $item->id }}">
                            <li class="filter-active">
                                @if ($langCurent::isLocale('en'))
                                 {{ $item->eng_name }}
                                @else
                                {{ $item->name }}
                                @endif
                            </li>
                        </a>
                    @endforeach
                </ul>

                <div class="tab-content" data-aos="fade-up" data-aos-delay="200">

                    <div class="tab-pane fade active show" id="menu-starters">
                        <div class="row gy-5" id="divAjax" style="margin-top:10px">
                            @foreach ($data as $item)
                                <div class="col-lg-4 menu-item">
                                    <a href="#"><img
                                            src="{{ asset('assets/admin/uploads') . '/' . $item->image }}"
                                            class="glightbox" style=" box-shadow: 15px 3px 8px 1px #cbc8c8;border-radius:5%;"
                                            alt=""></a>
                                    <h4 style="margin-top:10px ">
                                        @if ($langCurent::isLocale('en'))
                                        {{ $item->eng_name }}
                                    @else
                                    {{ $item->name }}
                                    @endif
                                    </h4>
                                    <p class="ingredients">
                                        @if ($langCurent::isLocale('en'))
                                        {{ $item->eng_details }}
                                    @else
                                    {{ $item->details }}
                                    @endif
                                    </p>
                                    <p class="price" style="direction: rtl;">
                                        @if ($langCurent::isLocale('en'))
                                        {{ $item->price }} riyal 
                                    @else
                                    {{ $item->price }} ريال 
                                    @endif
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div><!-- End Dinner Menu Content -->

                </div>

            </div>

        </section><!-- /Menu Section -->

    </main>

    <footer id="footer" class="footer dark-background">

        <div class="container  text-center">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">Yummy</strong> <span>All Rights Reserved</span>
            </p>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>



    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/front/light/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/front/light/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/front/light/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/front/light/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/front/light/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/front/light/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets/front/light/js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/front/assets/js/ajax.js') }}"></script>
    <script src="{{ asset('assets/front/assets/js/ajax.js') }}"></script>
</body>

</html>
