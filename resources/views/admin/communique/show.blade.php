<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="theme-color" content="#096667">
<meta name="msapplication-navbutton-color" content="#096667">
<meta name="apple-mobile-web-app-status-bar-style" content="#096667">
<title>Contracts Invoice on {{$data->id}}</title>
<link rel="icon" href="{{ asset('assets/admin/imgs/icon.ico') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap_rtl-v4.2.1/bootstrap.min.css')}}">
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.3/dist/JsBarcode.all.min.js"></script>
              <script type="text/javascript">
				  $(document).ready(function () {
					JsBarcode(".barcode").init();
				  });
              </script>
              <!---->
              <style>
                  *{
   
     /*font-family: "Harmattan", sans-serif;*/
    font-weight:400;
    font-style: normal;
    font-size:18px;
}
#dairy {
              
list-style-type: none;
    
}
hr.new1 {
  border-top: 1px solid #ccc;
}

.thead-light{background-color: #ccc;}


table {
border-collapse: collapse;
}
table {
width: 100%;
}
th {
border: 1px solid #cccccc;
border-style: solid;
}
/* */
     
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
border-style: solid;
border-radius: 10px;
}
              </style>
              <!---->
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
    <div class="row">
        <table id="example2" class="table table-bordered table-hover" style="direction: rtl;">
                    <tr>
                        <td>  رقم البلاغات  </td>
                        <td colspan="2">
                            {{ $data_communique['communique_number'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>  تاريخ البلاغات </td>
                        <td colspan="2">
                            {{ $data_communique['date'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>  مكان البلاغات	</td>
                        <td colspan="2">
                            {{ $data_communique['communique_place'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>  تقاصيل البلاغات	</td>
                        <td colspan="2">
                            {{ $data_communique['details'] }}
                        </td>
                    </tr>
                    </table>
      <div class="col-md-12">
                        <hr style="  border: 1px solid rgb(78, 96, 212)">
                    </div>
                    <table id="example2" class="table table-bordered table-hover" style="direction: rtl;">
                        <tr>
                            <td>الصورة الامامية للهوية</td>
                            <td colspan="2">
                                <img class="custom_img" src="{{ asset('assets/admin/uploads').'/'.$data->customer->identity_front_image }}" style="width: 150px;padding: 5px;height:150px;"  >   
                            </td>
                        </tr>
                        <tr>
                            <td>الصورة الخلفية للهوية</td>
                            <td colspan="2">
                                <img class="custom_img" src="{{ asset('assets/admin/uploads').'/'.$data->customer->identity_back_image }}" style="width: 150px;padding: 5px;height:150px;"  >   
                            </td>
                        </tr>
                        <tr>
                            <td>الصورة الامامية لرخصة القيادة</td>
                            <td colspan="2">
                                <img class="custom_img" src="{{ asset('assets/admin/uploads').'/'.$data->customer->driver_license_front_image }}" style="width: 150px;padding: 5px;height:150px;"  >   
                            </td>
                        </tr>
                        <tr>
                            <td>الصورة الخلفية لرخصة القيادة</td>
                            <td colspan="2">
                                <img class="custom_img" src="{{ asset('assets/admin/uploads').'/'.$data->customer->driver_license_back_image }}" style="width: 150px;padding: 5px;height:150px;"  >   
                            </td>
                        </tr>
                        </table>
                    <div class="col-md-12">
                        <hr style="  border: 1px solid rgb(78, 96, 212)">
                    </div>
                     </div>
<center>
    

<div class="container">
<table id="table-id">
        <tr>
          <td style="width:35%; padding-left: 7px;" dir="ltr" lang="en" style="width: %;">
                @php
             $sys =  App\Models\Panel_settings::where('id',1)->first();
             @endphp
             
             <b>C.R: {{ $sys['cr_number'] }}</b><br>
             <b>Mobile number: {{ $sys['phone_one'] }}</b><br>
             <b>Email: {{ $sys['email'] }}</b><br>
             <b>Vat number: {{ $sys['tax_number'] }}</b><br>
             <b>{{ $sys['address_two'] }}</b>
             
         </td> 
         <th style="width:30%;" style="text-align: center;">
             <img style="width: 80px" src="{{ asset('assets/admin/uploads').'/'.$sys->photo }}" alt="logo" class="img-responsive" /><br>
            {{$sys->system_name}}<br><b style="background-color: #B6DEDD; color:#000;">
         RENT A CAR AGREEMENT <br> عقد تأجير سيارة</b>
         </th>
         
         <td style="width:35%; padding-right: 7px;" dir="rtl" lang="ar">
         
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
     <!---->
     <thead>
         <tr>
             <th style="text-align: left; padding-left: 7px;">Car type</th>
             <th>{{$data->car->type->name}}</th>
             <th style="text-align: right; padding-right: 7px;">نوع السيارة</th>
         </tr>
         <tr>
             <th style="text-align: left; padding-left: 7px;">Plate Number</th>
             <th>{{$data->car->plate_number}}</th>
             <th style="text-align: right; padding-right: 7px;">رقم اللوحة</th>
         </tr>
         <tr>
             <th style="text-align: left; padding-left: 7px;">Car color</th>
             <th>{{$data->car->car_color}}</th>
             <th style="text-align: right; padding-right: 7px;">لون السيارة</th>
         </tr>
         <tr>
             <th style="text-align: left; padding-left: 7px;">Full Insurance</th>
             <th><input style="pointer-events:none;" type="checkbox" @if($data->car->full_insurance == 1) checked @endif ></th>
             <th style="text-align: right; padding-right: 7px;">تأمين شامل</th>
         </tr>
         <tr>
             <th style="text-align: left; padding-left: 7px;">Third party</th>
             <th><input style="pointer-events:none;" type="checkbox" @if($data->car->third_party == 1) checked @endif ></th>
             <th style="text-align: right; padding-right: 7px;">طرف ثالث</th>
         </tr>
         <tr>
             <th style="text-align: left; padding-left: 7px;">United Arab Emirates</th>
             <th><input  style="pointer-events:none;" type="checkbox" @if($data->car->UAE == 1) checked @endif ></th>
             <th style="text-align: right; padding-right: 7px;">الإمارات العربية</th>
         </tr>
         <tr>
             <th style="text-align: left; padding-left: 7px;">Sultanate of Oman</th>
             <th><input  style="pointer-events:none;" type="checkbox" @if($data->car->oman == 1) checked @endif ></th>
             <th style="text-align: right; padding-right: 7px;">داخل سلطنة عمان</th>
         </tr>
        
     </thead>
     <!---->
     </table>
     
      </th>
      <th style="width: 50%;">
      <table id="table-id" class="stable">
      <thead>
          
      <tr>
      <th scope="col"> {{$data->driver_name}}</th>
      <th scope="col">اسم السائق</th>
      <th scope="col">{{$data->customer->name}} </th>
      <th scope="col">اسم المستاجر</th>
      </tr>
      
      <tr>
      <th scope="col">{{$data->customer->address}}</th>
      <th scope="col">عنوان السكن</th>
      <th scope="col"> {{$data->customer->phone}}</th>
      <th scope="col">رقم الجوال</th>
      </tr>
      
      <tr>
      <th style="background-color: #fff; color:000;" scope="col">{{$data->customer->word_address}}</th>
      <th scope="col">عنوان العمل</th>
      <th scope="col">{{$data->customer->nationality}}</th>
      <th scope="col">الجنسية</th>
      </tr>
      
      <tr>
      <th style="background-color: #D79109; color:000;" colspan="2" scope="col">{{$data->customer->identity_number}}</th>
      <th style="background-color: #D79109; color:000;" colspan="2" scope="col">رقم الهوية</th>
      </tr>
      
      <tr>
      <th style="background-color: #D79109; color:000;" scope="col">{{$data->customer->identity_end_date}}</th>
      <th style="background-color: #D79109; color:000;" scope="col">تاريخ الإنتهاء </th>
      <th style="background-color: #D79109; color:000;" scope="col">{{$data->customer->identity_address}}</th>
      <th style="background-color: #D79109; color:000;" scope="col">مكان الإصدار </th>
      </tr>
      
      <tr>
      <th style="background-color: #ccc; color:000;" scope="col">{{$data->customer->driver_license_release_date}}</th>
      <th style="background-color: #ccc; color:000;" scope="col">تاريخ الإصدار</th>
      <th style="background-color: #ccc; color:000;" scope="col">{{$data->customer->driver_license_number}}</th>
      <th style="background-color: #ccc; color:000;" scope="col"> رخصة القيادة</th>
      </tr>
      
      <tr>
      <th style="background-color: #ccc; color:000;" scope="col">{{$data->customer->driver_license_release_date}}</th>
      <th style="background-color: #ccc; color:000;" scope="col">تاريخ الإنتهاء</th>
      <th style="background-color: #ccc; color:000;" scope="col">{{$data->customer->driver_license_address}}</th>
      <th style="background-color: #ccc; color:000;" scope="col">مكان الإصدار</th>
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
             <!--   <div class="d-grid gap-2 col-6 mx-auto" style="background-color: {{ $sys['theme_color'] }}; color:#fff; width: 100%;">حالة المركبة </div>-->
             <!--<br>-->
               <img style="width: 310px; height:200px" src="{{ asset('assets/admin/imgs/img66.jpg') }}" alt="logo-car" class="img-responsive" /> 
              
               <table style="border: none; border: 0px;">
                   <thead style="border: none; border: 0px;">
                       <tr style="border: none; border: 0px;">
                           <th style="font-size:12px; color:red; border: none; border: 0px;">
                               حالة السيارة بعد
                           </th>
                           <th style="font-size:12px; color:red; border: none; border: 0px;">
                               حالة السيارة قبل
                           </th>
                       </tr>
                   </thead>
               </table>
               <hr>
               <!---->
                      <div style="background-color: #fff; color:red;" class="alert alert-danger" role="alert">
                      <div style="font-size:12px; text-align: center;">
                           يلتزم المستأجر بدفع غرامة 20 ريال في حالة التدخين داخل المركبة
                      </div>
                     <div style="font-size:12px; text-align: center;">
                         The renter is obligated to pay a fine of 20 riyals in the event of smoking inside the vehicle
                     </div>
                     </div>
                    </th>
                          <th style="width: 50%;">
                              <table id="table-id">
                                  <thead>
                                  <tr>
                                       <th>
                                          Rental price  
                                      </th>
                     <th colspan="" scope="col">
                     {{ $sys['currency_type'] }} 
                      @if ($data->contract_type==3)
                      {{$data->contract_type_price}} : الشهري
                      @elseif ($data->contract_type==2)
                      {{$data->contract_type_price}} : الأسبوعي 
                      @else
                      {{$data->contract_type_price}} : اليومي 
                      @endif
                    </th>
                     <th>
                             سعر الإيجار
                          </th>
                    </tr>
                      <tr>
                        <th style="background-color: {{ $sys['theme_color'] }}; color:#fff;">Rate</th>
                        <th style="background-color: {{ $sys['theme_color'] }}; color:#fff;">مبلغ</th>
                        <th style="background-color: {{ $sys['theme_color'] }}; color:#fff;">بيان</th>
                      </tr>
                    </thead>
                    <tbody style="background-color: #fff; color:#000;">
                        <tr style="border-top: 1px solid #ccc;">
                            <th style="width: 35%; text-align: left; padding-left: 7px;">Advance payment</th>
                            <th style="width: 30%;">
                              {{ $sys['currency_type'] }} {{$data->pre_paid_price}}
                            </th>
                            <th style="width: 35%; text-align: right; padding-right: 7px;">
                              دفعة مقدمة
                            </th>
                          </tr>
                          <tr>
                              <th style="width: 35%; text-align: left; padding-left: 7px;">Vatin</th>
                            <th style="width: 30%;">
                             {{ $sys['currency_type'] }} {{$data->tax_price}}
                            </th>
                            <th style="width: 35%; text-align: right; padding-right: 7px;">
                              الضريبة
                            </th>
                          </tr>
                          <tr>
                              <th style="width: 35%; text-align: left; padding-left: 7px;">Excess KM</th>
                            <th style="width: 30%;">
                            {{ $sys['currency_type'] }} {{$data->excess_km_price}}
                            </th>
                            <th style="width: 35%; text-align: right; padding-right: 7px;">
                              زيادة الكيلو
                            </th>
                          </tr>
                          <tr>
                              <th style="width: 35%; text-align: left; padding-left: 7px;">Petrol</th>
                            <th style="width: 30%;">
                              {{ $sys['currency_type'] }} {{$data->patrol_price}}
                            </th>
                            <th style="width: 35%; text-align: right; padding-right: 7px;">
                              بترول
                            </th>
                          </tr>
                          <tr>
                              <th style="width: 35%; text-align: left; padding-left: 7px;">Washing</th>
                            <th style="width: 30%;">
                              {{ $sys['currency_type'] }} {{$data->washing_price}}
                            </th>
                            <th style="width: 35%; text-align: right; padding-right: 7px;">
                              غسيل
                            </th>
                          </tr>
                          <tr>
                              <th style="width: 35%; text-align: left; padding-left: 7px;">Insurance</th>
                            <th style="width: 30%;">
                             {{ $sys['currency_type'] }} {{$data->insurance_price}}
                            </th>
                            <th style="width: 35%; text-align: right; padding-right: 7px;">
                              التأمين
                            </th>
                          </tr>
                          <tr>
                              <th style="width: 35%; text-align: left; padding-left: 7px;">penalty</th>
                            <th style="width: 30%;">
                             {{ $sys['currency_type'] }} {{$data->penalty_price}}
                            </th>
                            <th style="width: 35%; text-align: right; padding-right: 7px;">
                              غرامة
                            </th>
                          </tr>
                          <tr>
                              <th style="width: 35%; text-align: left; padding-left: 7px;">Amount received</th>
                            <th style="width: 30%;">
                              {{ $sys['currency_type'] }} {{$data->paid_price}}
                            </th>
                            <th style="width: 35%; text-align: right; padding-right: 7px;">
                              المبلغ المستلم
                            </th>
                          </tr>
                          <tr>
                            <th style="width: 35%; text-align: left; padding-left: 7px;">Balance</th>
                            <th style="width: 30%;">
                              {{ $sys['currency_type'] }} {{$data->remind_price}}
                            </th>
                            <th style="width: 35%; text-align: right; padding-right: 7px;">
                              الباقي
                            </th>
                          </tr>
                          <tr>
                            <th style="width: 35%; text-align: left; padding-left: 7px;">Total</th>
                            <th style="width: 30%;">
                             {{ $sys['currency_type'] }} {{$data->total_price}}
                            </th>
                            <th style="width: 35%; text-align: right; padding-right: 7px;">
                              المجموع
                            </th>
                          </tr>
                    </tbody>
                  </table>
            </th>
          </tr>
          <tr>
              <th style="font-size:12px; text-align: right; vertical-align: top;">Note / ملاحظات</th>
              <th>
                  <div style="background-color: #fff; color:red;" class="alert alert-danger" role="alert">
                      <div style="font-size:12px; text-align: center;">
                           تنبيه هام: إن عدم قيامك بسداد قيمة الإيجار والتأخير في السداد يحق لشركة باغلاق المركبة وتحملك مسؤولية قيمة الإيجار لحين إرجاع المركبة للمكتب
                      </div>
                     <div style="font-size:12px; text-align: center;">Important warning: If you fail to pay the rental value and delay in payment, the
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
          <table style="border: 0px;" id="table-id" class="table table-bordered">
          <tbody style="border: 0px;">
          <tr style="border: 0px; vertical-align: top;">
          <th style="border: 0px;">Signature:</th>
          <th style="border: 0px; vertical-align: top;">
              @if($data->signature_image)
                     <img style="width: 100px" src="{{ asset('').'/'.$data->signature_image}}" class="img-responsive" />
                     @else
                      <img style="width: 100px" src="{{ asset('assets/admin/uploads/download.jpg')}}" class="img-responsive" />
                     @endif
          </th>
          <th style="border: 0px;">:التوقيع</th>
          </tr>
          <tr style="border: 0px;">
          <th style="border: 0px;">Name:</th>
          <th style="border: 0px; vertical-align: text-bottom;">_______________________________</th>
          <th style="border: 0px;">:الإسم</th>
          </tr>
          </tbody>
          </table>
          </th>
          <!---->
          <th style="width: %;">
               @php
     $id_get = base64_encode($data->id);
 @endphp
              <!--qr-->
            <div style="padding-right: 7px;">
             <img class="qrcode" src="https://api.qrserver.com/v1/create-qr-code/?size=90x90&data={{ route('admin.customer.ajax_search_genral_get',$id_get) }}" />
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
    
     <table style="border: 0px;" id="table-id" class="table table-bordered">
          <tbody style="border: 0px;">
          <tr style="border: 0px;">
          <th style="border: 0px;">
                      <div style="background-color: #fff; color:red;" class="alert alert-danger" role="alert">
                      <div style="">
                           الايجار الشهري يعني 30 يوم فقط   
                      </div>
                      <div style="">
                      Monthly rent means only 30 days
                      </div>
          </th>
          <!--</tr>-->
          
          <!--<tr style="border: 0px;">-->
          <th style="border: 0px;">
             <div class="text-right" id="dairy">
             <span class="txt-right" id="gudbrands"></span>
             </div>
          </th>
          </tr>
          
          </tbody>
          </table>
          
<!--    <center>-->
<!--        <div style="background-color: #F8D7DA; color:red;" class="alert alert-danger" role="alert">-->
<!--                      <div style="">-->
<!--الايجار الشهري يعني 30 يوم فقط-->
<!--                      </div>-->
<!--<div style="">-->
<!--    Monthly rent means only 30 days-->
<!--</div>-->
<!--</div>-->
<!--    </center>-->
    <!--<center>-->
         <!--<b>مرجع</b>-->
     
    <!--     <div class="text-left" id="dairy">-->
    <!--       <span class="txt-left" id="gudbrands"></span>-->
    <!--     </div>-->
    <!--     </center>-->
  </div> 
  
      <table id="table-id" class="table table-bordered">
          
      <thead style="padding-top: 6px; background-color:#ccc; color:#000;">
        <tr>
          <th style="background-color: {{ $sys['theme_color'] }}; color:#fff; width: 50%;">Terms & Conditions</th>
          <th style="background-color: {{ $sys['theme_color'] }}; color:#fff; width: 50%;">شروط عقد الايجار</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td dir="ltr" lang="en" style="padding-left: 6px;">
                     

                      <p style="width: 100%; font-size: 10.4px; text-align: justify; text-justify: inter-word;">
                        
                           @php
                      echo nl2br($sys->en_contract) 
                  @endphp
                          </p>
                
          </td>
          
          <td dir="rtl" lang="ar" style="padding-right: 6px;">
              
                
                  <p style="width: 100%; font-size: 11.9px; text-align: justify; text-justify: inter-word;">
                     
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
</body>
</html>