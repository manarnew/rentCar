<!DOCTYPE html>
<html  >
<head>
<meta charset="UTF-8" />
<meta name="theme-color" content="#A52A2A">
<meta name="msapplication-navbutton-color" content="#A52A2A">
<meta name="apple-mobile-web-app-status-bar-style" content="#A52A2A">
<title>Payment Invoice on {{$data->id}}</title>
<link rel="icon" href="{{ asset('assets/admin/imgs/icon.ico') }}">
<!-- style-invoice -->
<!--<link type="text/css" href="{{ asset('assets/admin/css/style.nvoice.css') }}" rel="stylesheet" media="all" />-->
<!-- font -->
<!--<link rel="preconnect" href="https://fonts.googleapis.com">-->
<!--<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>-->
<!--<link href="https://fonts.googleapis.com/css2?family=Harmattan:wght@400;500;600;700&display=swap" rel="stylesheet">-->
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
                  max-width:100%;
                  height:auto;
                  
              }
              .img-thumbnail{
                  max-width:none;
                
              }
              </style>
<!--qr-->

<script src="https://kendo.cdn.telerik.com/2023.1.425/js/jquery.min.js"></script>
<script src="https://kendo.cdn.telerik.com/2023.1.425/js/kendo.all.min.js"></script>
    
<style>
   #table-id {
  /*font-family: Arial, Helvetica, sans-serif;*/
  border-collapse: collapse;
  width: 100%;
}

#table-id td, #table-id th {
  border: 1px solid #ddd;
  /*padding: 5px;*/
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
             @php
             $sys =  App\Models\Panel_settings::where('id',1)->first();
             @endphp
<body style="
background-image: url('{{ asset('assets/admin/uploads').'/'.$sys['photo_two'] }}');
background-repeat: no-repeat;
background-attachment: fixed;  
background-size: cover;
  ">
<center>
    
<br><br><br><br><br><br><br><br><br>
<div class="container">
    <table id="table-id">
        <tr style="font-weight: bold; background-color: #fff; color:#000;">
          <td style="width: 35%; padding-left: 7px;" dir="ltr" lang="en">
             
             <b>C.R: {{ $sys['cr_number'] }}</b><br>
             <b>Mobile number: {{ $sys['phone_one'] }}</b><br>
             <b>Email: {{ $sys['email'] }}</b><br>
             <b>Vat number: {{ $sys['tax_number'] }}</b><br>
             <b>{{ $sys['address_two'] }}</b>
             
         </td> 
         <th style="width: 30% text-align: center;">
             <!--<img style="width: 80px" src="{{ asset('assets/admin/uploads').'/'.$sys->photo }}" alt="logo" class="img-responsive" /><br>-->
            <!--{{$sys->system_name}}<br> B6DEDD -->
            <b>
         Receipt voucher | سند قبض</b>
         <br>
             
                 <b>Bond number: {{ $data['count'] }} :رقم السند</b><br>
                 <b>Contract number: {{$data['contract_id']}} :رقم العقد</b>
             
         </th>
         
       <td style="width: 35% padding-right: 7px;" dir="rtl" lang="ar">
         
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
        <tr style="background-color: #A52A2A; color:#fff;">
            
      <table id="table-id" class="stable">
      <thead>
      <tr>
      <th scope="col">{{ $customer_id->nationality }}</th>
      <th style="background-color: #ccc;" scope="col"> الجنسية </th>

      <th colspan="" scope="col">{{ $customer_id->address }}</th>
      <th colspan="" style="background-color: #ccc;" scope="col">عنوان السكن</th>

      <th scope="col">{{ $customer_id->phone }}</th>
      <th style="background-color: #ccc;" scope="col"> هاتف العميل</th>

      <th scope="col">{{ $customer_id->word_address }}</th>
      <th style="background-color: #ccc;" scope="col">عنوان العمل</th>

      <th scope="col">{{ $customer_id->name }}</th>
      <th style="background-color: #ccc;" scope="col"> اسم العميل</th>
      </tr>

      <tr>
      <th scope="col">{{ $customer_id->driver_license_address_end_date }}</th>
      <th style="background-color: #ccc;" scope="col">تاريخ الإنتهاء </th>
      
      <th scope="col">{{ $customer_id->driver_license_release_date }}</th>
      <th style="background-color: #ccc;" scope="col">تاريخ الإصدار</th>

      <th scope="col">{{ $customer_id->driver_license_address }}</th>
      <th style="background-color: #ccc;" scope="col"> مكان الإصدار</th>
      
      <th scope="col">{{ $customer_id->driver_license_number }}</th>
      <th style="background-color: #ccc;" scope="col">رقم الرخصة</th>

      <th scope="col">{{ $customer_id->identity_number }}</th>
      <th style="background-color: #ccc;" scope="col"> رقم الهوية</th>
      </tr>
     </thead>
     </table>

     <br>
<b>بيانات السيارة</b>
<hr>
     <table id="table-id" class="stable">
        <thead>
        <tr>
        <th scope="col">Insurance type<br>نوع التأمين</th>
  
        <!--<th scope="col">Insurance company<br>شركة التأمين</th>-->

        <th scope="col">Car color<br>لون السيارة</th>
  
        <th scope="col">Plate number<br>رقم اللوحة</th>

        <th scope="col">Car model<br>موديل السيارة</th>
  
        <th scope="col">Car type<br>نوع السيارة</th>
        </tr>
  
        <tr>
        <th scope="col">
          @if ($car_id->full_insurance == 1)
                            تامين شامل
                        @else
                            تامين غير شامل
                        @endif
        </th>
        
        <!--<th scope="col">{{ $car_id->insurance }}</th>-->
  
        <th scope="col">{{ $car_id->car_color }}</th>
        
        <th scope="col">{{ $car_id->plate_number }}</th>
  
        <th scope="col">{{ $car_id->carModals->name }}</th>

        <th scope="col">{{ $car_id->type->name }}</th>
        </tr>
        </thead>
        </table>
     
        <br><hr><br>

      <table id="table-id" class="stable">
      <thead>
      <tr>
      <th scope="col">We Received From</th>     
      <th scope="col">{{ $customer_id->name }} </th>
      <th scope="col">استلمنا من الفاضل</th>
      </tr>
      
      <tr>
      <th scope="col">Amount of</th>
      <th scope="col">{{ $sys['currency_type'] }} {{ $data->paid_price }}</th>
      <th scope="col">مبلغ وقدره</th>
      </tr>

      <tr>
        <th scope="col">The remainig amount</th>
        <th scope="col">{{ $data->note }}</th>
        <th scope="col">البيان</th>
      </tr>
    
       <tr>
        <th scope="col">Payment method</th>
        <th scope="col">{{ $data->payment_type }}</th>
        <th scope="col">طريقة الدفع</th>
        </tr>

        <tr>
         <th scope="col">Check Number</th>
         <th scope="col">{{ $data->check_number }}</th>
         <th scope="col">رقم الشيك</th>
        </tr>

        <tr>
         <th scope="col">That's about</th>
         <th scope="col">{{ $sys['currency_type'] }} {{ $data->remind_price }}</th>
         <th scope="col">المبلغ الباقي</th>
        </tr>

        <tr>
            <th style="width: 35%;">
                
             <div style="padding: 10px; float: left;">
                 <!--<b>الختم</b><br>-->
                 
                  <img style="width: 90px" src="{{ asset('assets/admin/uploads').'/'.$sys['mark_image'] }}" class="img-responsive" />
                 </div>
          </th>
          <th style="width: 30%;">
              
          <p>توقيع المستأجر<br>Signature of Rented<br><br>
          <div style="padding-right: 15px; padding-left: 15px;"><hr></div>
          </th>
          <th style="width: 35%;">
              <!--qr-->
            <div style="padding: 10px;">
             <img style="float: right;" class="img-thumbnaild qrcode" src="https://api.qrserver.com/v1/create-qr-code/?size=90x90&data={{$data->id}}" />

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
                    width: 180,
                    height: 55
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
         <b>مرجع</b>
     
         <div class="text-left" id="dairy">
           <span class="txt-left" id="gudbrands"></span>
         </div>
         </center>
  </div> 

</div>
</center>
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