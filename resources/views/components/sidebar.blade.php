 <!-- Menu -->

 <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
     <div class="app-brand demo">
         <a href="index.html" class="app-brand-link">
             <span class="app-brand-logo demo">
                 <img style="width: 50px" src="{{ asset('image/logo.svg') }}" alt="">
             </span>
             <span class="app-brand-text demo menu-text fw-bolder ms-2">E-Learning</span>
         </a>

         <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
             <i class="bx bx-chevron-left bx-sm align-middle"></i>
         </a>
     </div>

     <div class="menu-inner-shadow"></div>

     <ul class="menu-inner py-1">
         <!-- Dashboard -->
         <li class="menu-item active">
             <a href="index.html" class="menu-link">
                 <i class="menu-icon tf-icons bx bx-home-circle"></i>
                 <div data-i18n="Analytics">Dashboard</div>
             </a>
         </li>



         <li class="menu-header small text-uppercase">
             <span class="menu-header-text">Kelas</span>
         </li>
         <li class="menu-item">
             <a href="cards-basic.html" class="menu-link">
                 <i class="menu-icon tf-icons bx bx-collection"></i>
                 <div data-i18n="Basic">Cards</div>
             </a>
         </li>
         <li class="menu-item">

             <a href="javascript:void(0);" class="menu-link menu-toggle">
                 <i class="menu-icon tf-icons bx bx-dock-top"></i>
                 <div data-i18n="Account Settings">Daftar Kelas</div>
             </a>
             <ul class="menu-sub">
                 <li class="menu-item">
                     <a href="pages-account-settings-account.html" class="menu-link">
                         <div data-i18n="Account">Kelas 1</div>
                     </a>
                 </li>
                 <li class="menu-item">
                     <a href="pages-account-settings-notifications.html" class="menu-link">
                         <div data-i18n="Notifications">Kelas 2</div>
                     </a>
                 </li>
                 <li class="menu-item">
                     <a href="pages-account-settings-connections.html" class="menu-link">
                         <div data-i18n="Connections">Kelas 3</div>
                     </a>
                 </li>
             </ul>
         </li>
     </ul>
 </aside>
 <!-- / Menu -->
