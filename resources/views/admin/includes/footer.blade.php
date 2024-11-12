@php
$sys =  App\Models\PanelSetting::where('id',1)->first();
@endphp
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title" id="exampleModalLabel"><center>الحاسبة</center></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="ajax_responce_serarchDiv" class="salma modal-body">
<!--calculator -->
<div id="calc">
      <div id="content">
         <form>
            <div id="output">
               <input type="text" id='res'>
            </div>
            <div class="btn">
               <input type="button" value='C' onclick="Clear()" id="clear">
               <input type="button" value='←' onclick="Back()" id="backspace">
               <input class="space" type="button" value='%' onclick="Solve('%')">
               <input class="space" type="button" value='/' onclick="Solve('/')">
               <br>
               <input type="button" value='7' onclick="Solve('7')">
               <input type="button" value='8' onclick="Solve('8')">
               <input type="button" value='9' onclick="Solve('9')">
               <input class="space" type="button" value='x' onclick="Solve('*')">
               <br>
               <input type="button" value='4' onclick="Solve('4')">
               <input type="button" value='5' onclick="Solve('5')">
               <input type="button" value='6' onclick="Solve('6')">
               <input class="space" type="button" value='-' onclick="Solve('-')">
               <br>
               <input type="button" value='1' onclick="Solve('1')">
               <input type="button" value='2' onclick="Solve('2')">
               <input type="button" value='3' onclick="Solve('3')">
               <input class="space" type="button" value='+' onclick="Solve('+')">
               <br>
               <input type="button" value='00' onclick="Solve('00')">
               <input type="button" value='0' onclick="Solve('0')">
               <input style="background-color:#000; color:#fff;" type="button" value='.' onclick="Solve('.')">
               <input class="space" type="button" value='=' onclick="Result()">
            </div>
         </form>
      </div>
   </div>
   <br>
<!--/calculator -->
      </div>
      <!--<div class="modal-footer">-->
      <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>-->
      <!--</div>-->
    </div>
  </div>
</div>
            <!--/modal-->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">
<style>
    .overflow-ellipsis {
  text-overflow: ellipsis;
}
#ellipsis {
  width: 200px;
  /*border: 1px solid;*/
  padding: 2px 5px;

  /* Both of the following are required for text-overflow */
  white-space: nowrap;
  overflow: hidden;
}
p {
  direction: ltr;
}
    .salma {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
#calc {
    width: 100%;
    height: 55vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
#content {
    /*2c302c*/
    background: #ccc;
    padding: 0px;
    border-radius: 10px;
    /*border: solid;*/

}
#content form input {
    border: 0;
    outline: 0;
    width: 50px;
    height: 50px;
    border-radius: 8px;
    font-size: 15px;
    margin: 5px;
    cursor: pointer;
    /*font: bold 1rem sans-serif;*/

}
.space{
   /*background-color: rgb(237, 89, 30);*/
    color: white;
      background-color: {{ $sys['theme_color'] }};
}
#backspace {
    /*background-color: rgb(237, 89, 30);*/
    color: white;
      background-color: {{ $sys['theme_color'] }};
}
#res {
    padding: 10px;
}
#clear {
    /*background-color: rgb(237, 89, 30);*/
    color: white;
    background-color: {{ $sys['theme_color'] }};
  }
form #output {
    display: flex;
    justify-content: flex-end;
    /*margin: 15px 0;*/
}
form #output input {
    text-align: right;
    flex: 1;
    font-size: 25px;
}
</style>
<style>
.custom_thead{
	border-radius:5px;
	color:#ffffff;
	font-family: "Rubik", sans-serif;
	background: {{ $sys['theme_color'] }};
}
}
*{
  font-family: "Rubik", sans-serif;
  font-optical-sizing: auto;
  font-weight: <weight>;
  font-style: normal;
}
#ajax_responce_serarchDiv{
    overflow-x:auto;
    
}

/**/
         
::-webkit-scrollbar {
    width: 6px;
	height: 6px;
	padding:2px;
}

::-webkit-scrollbar-track {
    background: #fff;
	border-radius:2px;
	box-shadow: inset 0 0 10px rgba(0, 0, 0, 0, 25);
}

::-webkit-scrollbar-thumb {
	border-radius:5px;
	padding:1px;
	background: {{ $sys['theme_color'] }};
}

::-webkit-scrollbar-thumb:hover {
    background: #0f0f0f;
}
   
    thead{
    font-family: "Rubik", sans-serif;
    background-color:#ccc;
    color:#000;
}
table{
  font-family: "Rubik", sans-serif;
  border: 1px solid #ccc;
  border-radius: 10px;
}
</style>
<script>
    function Solve(val) {
   var v = document.getElementById('res');
   v.value += val;
}
function Result() {
   var num1 = document.getElementById('res').value;
   try {
      var num2 = eval(num1.replace('x', '*'));
      document.getElementById('res').value = num2;
   } catch {
      document.getElementById('res').value = 'Error';
   }
}
function Clear() {
   var inp = document.getElementById('res');
   inp.value = '';
}
function Back() {
   var ev = document.getElementById('res');
   ev.value = ev.value.slice(0, -1);
}
document.addEventListener('keydown', function (event) {
   const key = event.key;
   const validKeys = '0123456789+-*/.%';
   if (validKeys.includes(key)) {
      Solve(key === '*' ? 'x' : key);
   } else if (key === 'Enter') {
      Result();
   } else if (key === 'Backspace') {
      Back();
   } else if (key.toLowerCase() === 'c') {
      Clear();
   }
});
</script>
<center>
<footer style=" background-color:#F4F5FF;" class="bg-darkd main-footer noPrint txt-center navbar-fixed-down">
  <!-- To the right -->
  <!--<div class="float-right d-none d-sm-inline noPrint">-->
  <!--   Anything you want-->
  <!--</div>-->
  <!-- Default to the left -->
  <strong class="noPrint">جميع الحقوق محفوظة &copy; {{ now()->year }} <a href="https://royia.net">ROYIA.NET</a></strong> 
</footer>
</center>