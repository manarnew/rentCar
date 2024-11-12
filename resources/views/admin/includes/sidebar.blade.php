@php
$sys =  App\Models\PanelSetting::where('id',1)->first();
@endphp
<aside style="background-color:{{ $sys['theme_color'] }};" class="main-sidebar sidebar-dark-primary elevation-4">
   <!-- Brand Logo -->
   <a href="{{ route('admin.dashboard') }}" class="brand-link">
          <img class="brand-imagez img-circles elevation-3e img-thumbnail" style="opacity: .8" src="{{ asset('assets/admin/uploads').'/'.$sys->photo }}"  alt="لوجو الشركة">       
   <!--<br><p id="ellipsis" class="overflow-ellipsis brand-text font-weight-light" > -->
   <!--   {{$sys->system_name}} -->
   <!--</p>-->
   </a>
   <!-- Sidebar -->
   <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
     
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
         <div class="image">
            <img src="{{ asset('assets/admin/uploads').'/'.auth()->user()->image }}" class="img-circle elevation-2" alt="User Image">
         </div>
         <div class="info">
            <a href="{{route('admin.admins_accounts.profile',auth()->user()->id)}}" class="d-block">{{ auth()->user()->name }}</a>
         </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
         
         <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            @if(check_permission_main_menue(1)==true)
                        <li class="nav-item has-treeview {{ ((request()->is('admin/car*'))||(request()->is('admin/carType*')  ) ||(request()->is('admin/CarModals*')  ) ||(request()->is('admin/contracts*')  ))?'menu-open':'' }}     ">
               <a href="#" class="nav-link {{ ((request()->is('admin/car*')  )  ||(request()->is('admin/carType*')  ) ||(request()->is('admin/CarModals*')  ) ||(request()->is('admin/contracts*')  ))?'active':'' }}">
                       <i class="fas fa-car"></i>                  <p>
                     السيارات و الحجوزات
                     <i class="right fas fa-angle-left"></i>
                     
                  </p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="{{ route('carType.index') }}" class="nav-link {{ (request()->is('admin/carType*') )?'active':'' }}">
                    <i class="far fa-circle" style="color:#; font-size:13px;"></i>

                        <p>
                           انواع السيارات         
                        </p>
                     </a>
                  </li>
                  <!--<li class="nav-item">-->
                  <!--   <a href="{{ route('CarModals.index') }}" class="nav-link {{ (request()->is('admin/CarModals*') )?'active':'' }}">-->
                  <!--  <i class="far fa-circle" style="color:#; font-size:13px;"></i>-->

                  <!--      <p>-->
                  <!--         موديل السيارات         -->
                  <!--      </p>-->
                  <!--   </a>-->
                  <!--</li>-->
                  <li class="nav-item">
                     <a href="{{ route('admin.car.index') }}" class="nav-link {{ (request()->is('admin/car*') and !request()->is('admin/carType*') )?'active':'' }}">
                    <i class="far fa-circle" style="color:#; font-size:13px;"></i>

                        <p>
                            السيارات
                                     
                        </p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{ route('contracts.index') }}" class="nav-link {{ (request()->is('admin/contracts*') )?'active':'' }}">
                    <i class="far fa-circle" style="color:#; font-size:13px;"></i>

                        <p>
                            الحجوزات         
                        </p>
                     </a>
                  </li>
               </ul>
            </li>
            
            @endif
            @if(check_permission_main_menue(2)==true) 
    <li class="nav-item has-treeview {{ ((request()->is('admin/expenses*'))||(request()->is('admin/expensesType*'))||(request()->is('admin/debentures*'))||(request()->is('admin/CarExpenses*')  ) )?'menu-open':'' }}     ">
               <a href="#" class="nav-link {{ ((request()->is('admin/expenses*'))||(request()->is('admin/expensesType*'))||(request()->is('admin/debentures*')  )  ||(request()->is('admin/CarExpenses*')  )  )?'active':'' }}">
                       <i class="fas fa-ticket-alt"></i>
                       <p>
                     الحسابات
                     <i class="right fas fa-angle-left"></i>
                     
                  </p>
               </a>
               <ul class="nav nav-treeview">
                      <li class="nav-item">
                     <a href="{{ route('expensesType.index') }}" class="nav-link {{ (request()->is('admin/expensesType*') )?'active':'' }}">
                    <i class="far fa-circle" style="color:#; font-size:13px;"></i>

                        <p>
                            انواع المصروفات         
                        </p>
                     </a>
                  </li>
                     <li class="nav-item">
                     <a href="{{ route('expenses.index') }}" class="nav-link {{ (request()->is('admin/expenses*') )?'active':'' }}">
                    <i class="far fa-circle" style="color:#; font-size:13px;"></i>

                        <p>
                             المصروفات         
                        </p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{ route('debentures.index') }}" class="nav-link {{ (request()->is('admin/debentures*') )?'active':'' }}">
                    <i class="far fa-circle" style="color:#; font-size:13px;"></i>

                        <p>
                            سندات القبض         
                        </p>
                     </a>
                  </li>
                  
                  <li class="nav-item">
                     <a href="{{ route('CarExpenses.index') }}" class="nav-link {{ (request()->is('admin/CarExpenses*') )?'active':'' }}">
                    <i class="far fa-circle" style="color:#; font-size:13px;"></i>

                        <p>
                           مصروفات السيارات         
                        </p>
                     </a>
                  </li>
                  
               </ul>
            </li>
            @endif
        
            <li class="nav-item has-treeview {{ ((request()->is('admin/customer*')))?'menu-open':'' }}     ">
               <a href="#" class="nav-link {{ ((request()->is('admin/customer*')  )   )?'active':'' }}">
                 <i class="fas fa-users"></i>                  <p>
                      العملاء
                     <i class="right fas fa-angle-left"></i>
                  </p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="{{ route('admin.customer.index') }}" class="nav-link {{ (request()->is('admin/customer*') )?'active':'' }}">
                    <i class="far fa-circle" style="color:#; font-size:13px;"></i>
                        <p>
                           العملاء         
                        </p>
                     </a>
                  </li>
                                  <li class="nav-item">
                     <a href="{{ route('Black_lists.index') }}" class="nav-link {{ (request()->is('admin/Black_lists*') )?'active':'' }}">
                    <i class="far fa-circle" style="color:#; font-size:13px;"></i>
                        <p>
                           قائمة الحظر         
                        </p>
                     </a>
                  </li>
                             </li>
                   <li class="nav-item">
    <a href="{{ route('communique.index') }}" class="nav-link {{ (request()->is('admin/communique*') )?'active':'' }}">
   <i class="far fa-circle" style="color:#; font-size:13px;"></i>
       <p>
           البلاغات         
       </p>
    </a>
 </li>
               </ul>
            </li>
            @if(check_permission_main_menue(3)==true) 
            <li class="nav-item has-treeview {{ ( request()->is('admin/admins_accounts*') || request()->is('admin/permission_roles*')  || request()->is('admin/permission_main_menues*') ||request()->is('admin/permission_sub_menues*'))?'menu-open':'' }}     ">
               <a href="#" class="nav-link {{ (request()->is('admin/admins_accounts*') || request()->is('admin/permission_roles*')  || request()->is('admin/permission_main_menues*') ||request()->is('admin/permission_sub_menues*'))?'active':'' }}">
                  <i class="fas fa-users-cog"></i>
                  <p>
                     الإدارة  
                     <i class="right fas fa-angle-left"></i>
                  </p>
               </a>
               <ul class="nav nav-treeview">
                  <a href="{{ route('admin.permission_roles.index') }}" class="nav-link {{ (request()->is('admin/permission_roles*') )?'active':'' }}">
                     <i class="far fa-circle" style="color:#; font-size:13px;"></i>
                     <p>
                        أدوار المستخدمين         
                     </p>
                  </a>


                  <li class="nav-item">
                     <a href="{{ route('admin.admins_accounts.index') }}" class="nav-link {{ (request()->is('admin/admins_accounts*') )?'active':'' }}">
                        <i class="far fa-circle" style="color:#; font-size:13px;"></i>

                        <p>
                           الموظفين         
                        </p>
                     </a>
                  </li>
                   <!--<a href="{{ route('admin.permission_main_menues.index') }}" class="nav-link {{ (request()->is('admin/permission_main_menues*') )?'active':'' }}">-->
                   <!--     <p>-->
                   <!-- القوائم الرئيسية للصلاحيات        -->
                   <!--     </p>-->
                   <!--  </a>-->
                   <!--  <a href="{{ route('admin.permission_sub_menues.index') }}" class="nav-link {{ (request()->is('admin/permission_sub_menues*') )?'active':'' }}">-->
                   <!--     <p>-->
                   <!-- القوائم الفرعية للصلاحيات        -->
                   <!--     </p>-->
                   <!--  </a>-->
               </ul>
            </li>
            @endif
            @if(check_permission_main_menue(4)==true) 
            <li class="nav-item has-treeview {{ (request()->is('admin/Report*') )?'menu-open':'' }}     ">
               <a href="#" class="nav-link {{ (request()->is('admin/Report*') )?'active':'' }}">
                  <i class="fas fa-file-invoice"></i>                  <p>
                     التقارير 
                     <i class="right fas fa-angle-left"></i>
                  </p>
               </a>
               <ul class="nav nav-treeview">
                   <li class="nav-item">
                     <a href="{{ route('admin.Report.indexTaxReport') }}" class="nav-link {{ (request()->is('admin/Report/indexTaxReport*') ) ?'active':'' }}">
                        <i class="far fa-circle" style="color:#; font-size:13px;"></i>
                           <p> تقارير الضرائب   </p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{ route('admin.Report.bookingReport') }}" class="nav-link {{ (request()->is('admin/Report/bookingReport')) ?'active':'' }}">
                        <i class="far fa-circle" style="color:#; font-size:13px;"></i>
                           <p>تقارير الحجوزات</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{ route('admin.Report.userReport') }}" class="nav-link {{ (request()->is('admin/Report/userReport')) ?'active':'' }}">
                        <i class="far fa-circle" style="color:#; font-size:13px;"></i>
                           <p>تقارير المستخدمين</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{ route('admin.Report.carExpensesReport') }}" class="nav-link {{ (request()->is('admin/Report/carExpensesReport*') ) ?'active':'' }}">
                        <i class="far fa-circle" style="color:#; font-size:13px;"></i>
                           <p> تقارير مصروفات السيارات  </p>
                     </a>
                  </li>
                 <li class="nav-item">
                     <a href="{{ route('admin.Report.expensesReport') }}" class="nav-link {{ (request()->is('admin/Report/expensesReport*') ) ?'active':'' }}">
                        <i class="far fa-circle" style="color:#; font-size:13px;"></i>
                           <p> تقارير المصروف   </p>
                     </a>
                  </li>
                   <li class="nav-item">
                     <a href="{{ route('admin.Report.profitsReport') }}" class="nav-link {{ (request()->is('admin/Report/profitsReport*') ) ?'active':'' }}">
                        <i class="far fa-circle" style="color:#; font-size:13px;"></i>
                           <p> تقارير الارباح و الخسائر   </p>
                     </a>
                  </li>
               </ul>
            </li>
            @endif
            @if(check_permission_main_menue(5)==true) 
             <li class="nav-item has-treeview {{ (request()->is('admin/adminpanelsetting*') )?'menu-open':'' }}     ">
               <a href="#" class="nav-link {{ (request()->is('admin/adminpanelsetting*') )?'active':'' }}">
                  <i class="fas fa-cogs"></i>
                  <p>
                      الإعدادات
                     <i class="right fas fa-angle-left"></i>
                  </p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="{{ route('admin.adminPanelSetting.index') }}" class="nav-link {{ (request()->is('admin/adminpanelsetting*') and !request()->is('admin/adminpanelsetting_API*'))  ?'active':'' }}">
                       <i class="far fa-circle" style="color:#; font-size:13px;"></i>
                        <p>الضبط العام</p>
                     </a>
                  </li>
                   <li class="nav-item">
                     <a href="{{ route('admin.adminPanelSetting_API.index_API') }}" class="nav-link {{ (request()->is('admin/adminpanelsetting_API*'))  ?'active':'' }}">
                       <i class="far fa-circle" style="color:#; font-size:13px;"></i>
                        <p>Api واتساب</p>
                     </a>
                  </li>
               </ul>
            </li>
            @endif
         </ul>
      </nav>
      <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
</aside>