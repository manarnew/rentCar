<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="theme-color" content="#096667">
<meta name="msapplication-navbutton-color" content="#096667">
<meta name="apple-mobile-web-app-status-bar-style" content="#096667">
<title>Contracts Invoice on {{$data->id}}</title>
<link rel="icon" href="{{ asset('assets/admin/imgs/icon.ico') }}">
<!-- style-invoice -->
<link type="text/css" href="{{ asset('assets/admin/css/style.nvoice.css') }}" rel="stylesheet" media="all" />
<!-- font -->
      <!--<link rel="preconnect" href="https://fonts.googleapis.com">-->
      <!--<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>-->
      <!--<link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">-->
<!--qr-->
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.3/dist/JsBarcode.all.min.js"></script>
              <script type="text/javascript">
				  $(document).ready(function () {
					JsBarcode(".barcode").init();
				  });
              </script>
              <style type="text/css">
              .barcode {
              	float: right;
              }
			  .qrcode {
              	float: right;
              }
              .img-thumbnail{
                  padding:4px;
                  line-height:1.42857143;
                  background-color:#fff;
                  border:1px solid #ddd;
                  border-radius:4px;
                  -webkit-transition:all .2s ease-in-out;
                  -o-transition:all .2s ease-in-out;
                  transition:all .2s ease-in-out;
                  display:inline-block;
                  max-width:100%;height:auto
                  
              }
              .img-thumbnail{max-width:none}
              p{text-align: justify; text-justify: inter-word;}
              </style>
<!--qr-->

<script src="https://kendo.cdn.telerik.com/2023.1.425/js/jquery.min.js"></script>
<script src="https://kendo.cdn.telerik.com/2023.1.425/js/kendo.all.min.js"></script>
    
<style>
   #table-id {
 /*font-family: "Tajawal", sans-serif;*/
  border-collapse: collapse;
  width: 100%;
}

#table-id td, #table-id th, tr {
  border: 1px solid #ddd;
  padding: 1px;
}

#table-id tr:nth-child(even){background-color: #f2f2f2;}

#table-id tr:hover {background-color: #ddd;}

#table-id th {
  /*padding-top: 12px;*/
  /*padding-bottom: 12px;*/
  text-align: center;
  background-color: #fff;
  color: #000;
}
</style>

</head>
<body style="
<!--background-image: url('{{ asset('assets/admin/imgs/roiya.net.jpg')}}');-->
background-repeat: no-repeat;
background-attachment: fixed;  
background-size: cover;
  ">
<center>
    

<div class="container">
    
<table id="table-id">
        <tr>
          <td style="padding-left: 7px;" dir="ltr" lang="en" style="width: %;">
                @php
             $sys =  App\Models\Panel_settings::where('id',1)->first();
             @endphp
             
             <b>C.R: {{ $sys['cr_number'] }}</b><br>
             <b>Mobile number: {{ $sys['phone_one'] }}</b><br>
             <b>Email: {{ $sys['email'] }}</b><br>
             <b>Vat number: {{ $sys['tax_number'] }}</b><br>
             <b>{{ $sys['address_two'] }}</b>
             
         </td> 
         <th style="width: %;" style="text-align: center;">
             <img style="width: 80px" src="{{ asset('assets/admin/uploads').'/'.$sys->photo }}" alt="logo" class="img-responsive" /><br>
            {{$sys->system_name}}<br><b style="background-color: #B6DEDD; color:#000;">
         RENT A CAR AGREEMENT | عقد تأجير سيارة</b>
         </th>
         
         <td style="padding-right: 7px;" dir="rtl" lang="ar">
         
             <b>سجل تجاري: {{ $sys['cr_number'] }}</b><br>
             <b>رقم الجوال: {{ $sys['phone_one'] }}</b><br>
             <b>البريد الالكتروني: {{ $sys['email'] }}</b><br>
             <b>الرقم الضريبي: {{ $sys['tax_number'] }}</b><br>
             <b>{{ $sys['address'] }}</b>
             
     </td>
        </tr>
      </table>
      
      
    
  <div style="page-break-after: always;">
  
    <table class="table table-bordered">
      <thead class="thead-light">
        <tr style="background-color: {{ $sys['theme_color'] }}; color:#fff;">
            
          <th style="width: 35%;"><b>بيانات السيارة</b></th>
          <th colspan="2" style="width: 35%;">بيانات المستأجر</th>
         
        </tr>
      </thead>
      <tbody>
        <tr>
          <th style="width: 50%;">
             <table id="table-id" class="stable">
      <thead>
      <tr>
      <th scope="col">{{$data->car->plate_number}} </th>
      <th scope="col">:رقم اللوحة </th>
      <th scope="col">{{$data->car->type->name}} </th>
      <th scope="col">:نوع السيارة </th>
      </tr>
      <tr>
      <th scope="col">{{$data->car->car_color}}</th>
      <th scope="col">:لون السيارة</th>
      <th scope="col"><input style="pointer-events:none;" type="checkbox" @if($data->car->full_insurance == 1) checked @endif ></th>
      <th scope="col">:تأمين شامل</th>
      </tr>
      <tr>
      <th scope="col"><input style="pointer-events:none;" type="checkbox" @if($data->car->third_party == 1) checked @endif ></th>
      <th scope="col">:طرف ثالث</th>
      <th scope="col"><input  style="pointer-events:none;" type="checkbox" @if($data->car->full_cover == 1) checked @endif ></th>
      <th scope="col">:التغطية الشاملة </th>
      </tr>
      <tr>
      <th scope="col"><input  style="pointer-events:none;" type="checkbox" @if($data->car->UAE == 1) checked @endif ></th>
      <th scope="col">:الإمارات العربية</th>
      <th scope="col"><input  style="pointer-events:none;" type="checkbox" @if($data->car->oman == 1) checked @endif ></th>
      <th scope="col">:داخل سلطنة عمان</th>
      </tr>
      <tr>
      <th colspan="2" scope="col">{{$data->car->insurance}}</th>
      <th colspan="2" scope="col">:التأمين</th>
      </tr>
     </thead>
     </table>
     
      </th>
      <th style="width: 50%;">
      <table id="table-id" class="stable">
      <thead>
      <tr>
      <th scope="col"> {{$data->driver_name}}</th>
      <th scope="col">:اسم السائق</th>
      <th scope="col">{{$data->customer->name}} </th>
      <th scope="col">:اسم المستاجر</th>
      </tr>
      <tr>
      <th scope="col">{{$data->customer->address}}</th>
      <th scope="col">:العنوان</th>
      <th scope="col"> {{$data->customer->phone}}</th>
      <th scope="col">:الهاتف</th>
      </tr>
      <tr>
      <th scope="col">{{$data->customer->word_address}}</th>
      <th scope="col">:عنوان العمل</th>
      <th scope="col">{{$data->customer->driver_license_number}}</th>
      <th scope="col">:رخصة القيادة</th>
      </tr>
      <tr>
      <th scope="col">{{$data->customer->driver_license_release_date}}</th>
      <th scope="col">:تاريخ الإصدار</th>
      <th scope="col">{{$data->customer->driver_license_release_date}}</th>
      <th scope="col">تاريخ الإنتهاء</th>
      </tr>
      <tr>
      <th colspan="2" scope="col">{{$data->customer->driver_license_address}}</th>
      <th colspan="2" scope="col">:مكان الإصدار</th>
      </tr>
     </thead>
     </table>
     </th>
        </tr>
      </tbody>
    </table>
    <table id="table-id">
      <thead class="thead-light">
        <tr>
          <th style="background-color: {{ $sys['theme_color'] }}; color:#fff; width: 50%;"><b>بيانات جواز السفر / البطاقة الشخصية</b></th>
          <th style="background-color: {{ $sys['theme_color'] }}; color:#fff; width: 50%;"><b>سعر الإجار</b></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th>
              <table id="table-id" class="stable">
      <thead>
      <tr>
      <th scope="col">{{$data->customer->identity_number}}</th>
      <th scope="col">:رقم الهوية</th>
      <th scope="col">{{$data->customer->identity_address}}</th>
      <th scope="col">:مكان الإصدار </th>
      <th scope="col">{{$data->customer->identity_end_date}}</th>
      <th scope="col">:تاريخ الإنتهاء </th>
      </tr>
      </thead>
     </table>
     
        </th>
        <th>
               <table id="table-id" class="stable">
      <thead>
      <tr>
      <th scope="col">{{ $sys['currency_type'] }} 
        
    
        @if ($data->contract_type==3)
        {{$data->contract_type_price}} : الشهري
        @elseif ($data->contract_type==2)
        {{$data->contract_type_price}} : الأسبوعي 
        @else
        {{$data->contract_type_price}} : اليومي 
        @endif
      </th>
      </tr>
      </thead>
     </table>
            </th>
        </tr>
      </tbody>
    </table>
    <table id="table-id">
        <thead class="thead-light">
          <tr>
            <th class="text-right" style="background-color: #fff; width: 50%;">
                <div class="d-grid gap-2 col-6 mx-auto" style="background-color: {{ $sys['theme_color'] }}; color:#fff; width: 100%;">حالة المركبة </div>
             <br>
               <img style="width: 310px; height:200px" src="{{ asset('assets/admin/imgs/img66.jpg') }}" alt="logo-car" class="img-responsive" /> 
                      <div style="background-color: #F8D7DA; color:red;" class="alert alert-danger" role="alert">
                      <div style="font-size:12px; text-align: right;">
                           يلتزم المستأجر بدفع غرامة 20 ريالفي حالة التدخين داخل المركبة
                      </div>
                     <div style="font-size:12px; text-align: left;">
                         The renter is obligated to pay a fine of 20 riyals in the event of smoking inside the vehicle
                     </div>
                     </div>
            </th>
            <th style="width: 50%;">
                <table id="table-id">
                    <thead>
                      <tr>
                        <th style="background-color: {{ $sys['theme_color'] }}; color:#fff;">Rate</th>
                        <th style="background-color: {{ $sys['theme_color'] }}; color:#fff;">مبلغ</th>
                        <th style="background-color: {{ $sys['theme_color'] }}; color:#fff;">بيان</th>
                      </tr>
                    </thead>
                    <tbody style="background-color: #fff; color:#000;">
                        <tr style="border-top: 1px solid #ccc;">
                            <th>Advance payment</th>
                            <th>
                              {{ $sys['currency_type'] }} {{$data->pre_paid_price}}
                            </th>
                            <th>
                              دفعة مقدمة
                            </th>
                          </tr>
                          <tr>
                              <th>Vatin</th>
                            <th>
                             {{ $sys['currency_type'] }} {{$data->tax_price}}
                            </th>
                            <th>
                              الضريبة
                            </th>
                          </tr>
                          <tr>
                              <th>Excess KM</th>
                            <th>
                            {{ $sys['currency_type'] }} {{$data->excess_km_price}}
                            </th>
                            <th>
                              زيادة الكيلو
                            </th>
                          </tr>
                          <tr>
                              <th>Petrol</th>
                            <th>
                              {{ $sys['currency_type'] }} {{$data->patrol_price}}
                            </th>
                            <th>
                              بترول
                            </th>
                          </tr>
                          <tr>
                              <th>Washing</th>
                            <th>
                              {{ $sys['currency_type'] }} {{$data->washing_price}}
                            </th>
                            <th>
                              غسيل
                            </th>
                          </tr>
                          <tr>
                              <th>Insurance</th>
                            <th>
                             {{ $sys['currency_type'] }} {{$data->insurance_price}}
                            </th>
                            <th>
                              التأمين
                            </th>
                          </tr>
                          <tr>
                              <th>penalty</th>
                            <th>
                             {{ $sys['currency_type'] }} {{$data->penalty_price}}
                            </th>
                            <th>
                              غرامة
                            </th>
                          </tr>
                          <tr>
                              <th>Amount received</th>
                            <th>
                              {{ $sys['currency_type'] }} {{$data->paid_price}}
                            </th>
                            <th>
                              المبلغ المستلم
                            </th>
                          </tr>
                          <tr>
                            <th>Balance</th>
                            <th>
                              {{ $sys['currency_type'] }} {{$data->remind_price}}
                            </th>
                            <th>
                              الباقي
                            </th>
                          </tr>
                          <tr>
                            <th>Total</th>
                            <th>
                             {{ $sys['currency_type'] }} {{$data->total_price}}
                            </th>
                            <th>
                              المجموع
                            </th>
                          </tr>
                    </tbody>
                  </table>
            </th>
          </tr>
          <tr>
              <th style="font-size:12px; text-align: right;">Note / ملاحظات</th>
              <th>
                  <div style="background-color: #F8D7DA; color:red;" class="alert alert-danger" role="alert">
                      <div style="font-size:12px; text-align: right;">
                           تنبيه هام: إن عدم قيامك بسداد قيمة الإيجار والتأخير في السداد يحق لشركة باغلاق المركبة وتحملك مسؤولية قيمة الإيجار لحين إرجاع المركبة للمكتب
                      </div>
                     <div style="font-size:12px; text-align: left;">Important warning: If you fail to pay the rental value and delay in payment, the
                      company has the right to close the vehicle and hold you responsible for the
                      rental value until the vehicle is returned to the office .</div>
                     </div>
              </th>
          </tr>
        </thead>
      </table>
    <table id="table-id" class="table table-bordered">
      <tbody>
       
        <tr>
          <th class="text-right">
            <b>  كيلو متر عند المغادرة</b>  {{$data->exist_km}}<br/>
            <b>  كيلو متر عند العودة</b>  {{$data->return_km}}<br/>
            <b>     كيلو مترات مجانية</b>  {{$data->free_km}}<br/>

          </th>
          <th class="text-right">
            <b>  وقت المغادرة</b>  {{$data->exist_time}}<br/>
            <b>     وقت العودة</b>  {{$data->return_time}}<br/>
            <b>     كيلو مترات زائدة</b>  {{$data->excess_km}}<br/>

          </th>
          <th class="text-right">
             <b>  تاريخ المغادرة</b>  {{$data->exist_date}}<br/>
             <b>     تاريخ العودة</b>  {{$data->return_date}}<br/>
             <b>     اجمالي المسافة المقطوعة</b>  {{$data->total_km}}<br/>

          </th>
        </tr>
        
        <tr>
          <th colspan="3" class="text-center">
            <b>    كيلو مترات مستحقة</b> {{$data->due_km}}<br/>
          </th>
        </tr>
        </tbody>
       </table>
       
       <table id="table-id" class="table table-bordered">
      <tbody>
        <tr>
          <th style="width: %;">
              
             <div dir="ltr"><img style="width: 90px" src="{{ asset('assets/admin/uploads').'/'.$sys->mark_image}}" class="img-responsive" /></div>
          </th>
          
          <th>
              <p>Signature of Rented | توقيع المستأجر</p>
              <div style="padding: -7px; margin-bottom: 0px"><img style="width: 100px" src="{{ asset('').'/'.$data->signature_image}}" class="img-responsive" /></div>
          </th>
          <th style="width: %;">
              <!--qr-->
            <div style="padding-right: 7px;">
             <img style="float: right;" class="img-thumbnail qrcode" src="https://api.qrserver.com/v1/create-qr-code/?size=90x90&data={{$data->id}}" />
            </div>	
          </th>
        </tr>
      </tbody>
    </table> 
    <script>
            $(document).ready(function () {
                $("#gudbrands").kendoBarcode({
                    value:  {{$data->id}},
                    type: "code128",
                    width: 150,
                    height: 50
                });
            });
        </script>
        
    <table class="table table-bordered">
        
      <thead style="background-color: {{ $sys['theme_color'] }}; color:#fff;">
        <tr>
          <th><b>تم تحريره بواسطة: {{$data->user->name}}</b></th>
        </tr>
      </thead>
    </table>
    <center>
        <div style="background-color: #F8D7DA; color:red;" class="alert alert-danger" role="alert">
                      <div style="">
الايجار الشهري يعني 30 يوم فقط
                      </div>
<div style="">
    Monthly rent means only 30 days
</div>
</div>
    </center>
    <center>
         <!--<b>مرجع</b>-->
     
         <div class="text-left" id="dairy">
           <span class="txt-left" id="gudbrands"></span>
         </div>
         </center>
  </div> 
  
      <table id="table-id" class="table table-bordered">
          
      <thead style="background-color:#ccc; color:#000;">
        <tr>
          <th style="background-color: {{ $sys['theme_color'] }}; color:#fff; width: 50%;">Terms & Conditions</th>
          <th style="background-color: {{ $sys['theme_color'] }}; color:#fff; width: 50%;">شروط عقد الايجار</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td dir="ltr" lang="en" style="padding-left: 6px;">
                     

                      <p style="width: 100%; font-size: 7.2px; text-align: justify; text-justify: inter-word;">
                        
                           @php
                      echo nl2br($sys->en_contract) 
                  @endphp
                          </p>
                
          </td>
          
          <td dir="rtl" lang="ar" style="padding-right: 6px;">
              
                
                  <p style="width: 100%; font-size: 9px; text-align: justify; text-justify: inter-word;">
                     
                          @php
                      echo nl2br($sys->ar_contract) 
                  @endphp
                      </p>
                  
          </td>
        </tr>
      </tbody>
    </table>

</div>

<script src="https://cdn.jsdelivr.net/jsbarcode/3.5.8/JsBarcode.all.min.js" type="5b653696e8b6017cda142c4d-text/javascript"></script>
<script type="5b653696e8b6017cda142c4d-text/javascript">
    $(document).ready(function () {
        JsBarcode(".barcode").init();
    });
</script>
<style type="text/css">
    .barcode
    {
        float:right;
        /*text-align: center;*/
        
    }
</style>
<script type="5b653696e8b6017cda142c4d-text/javascript">
     window.onload = function() { window.print(); } 
</script>
<script src="https://yitistore.matjrah.store/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="5b653696e8b6017cda142c4d-|49" defer=""></script>
<div class="img-thumbnail">
  
</body>
</html>