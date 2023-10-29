 <!-- Menu -->

 <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
     <div class="app-brand demo">
         <a href="index.html" class="app-brand-link">
             <span class="app-brand-logo demo">
                 <img style="width: 50px; fill:red;" src="{{ asset('image/logo.svg') }}" alt="">
             </span>
             <span class="app-brand-text demo menu-text fw-bolder ms-2">PUSPERING</span>
         </a>

         <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
             <i class="bx bx-chevron-left bx-sm align-middle"></i>
         </a>
     </div>

     <div class="menu-inner-shadow"></div>

     <ul class="menu-inner py-1">
         <!-- Dashboard -->
         <li class="menu-item {{ Request::is('dashboard') ? 'active' : '' }}" onclick="setActive(this)">
             <a href="{{ route('dashboard.index') }}" class="menu-link">
                 <img class="menu-icon tf-icons" src="{{ asset('image/dashboard.svg') }}" alt="">
                 <div data-i18n="Analytics">Dashboard</div>
             </a>
         </li>


         @if (request()->session()->get('user')->role_id == 2 ||
                 request()->session()->get('user')->role_id == 3)
             <li class="menu-header small text-uppercase">
                 <span class="menu-header-text">Kelas</span>
             </li>

             <li class="menu-item {{ Request::is('kelas*') ? 'active' : '' }}">

                 <a href="javascript:void(0);" class="menu-link menu-toggle">
                     <img class="menu-icon tf-icons" src="{{ asset('image/classroom.svg') }}" alt="">
                     <div data-i18n="Account Settings">Daftar Kelas</div>
                 </a>
                 <ul class="menu-sub">
                     @foreach (request()->session()->get('kelas') as $item)
                         <li class="menu-item {{ Request::is('kelas*') ? 'active' : '' }}" onclick="setActive(this)">
                             <a href="{{ route('kelas.show', ['kela' => $item->id]) }}" class="menu-link">
                                 <div data-i18n="Account">{{ $item->nama_kelas }}</div>
                             </a>
                         </li>
                     @endforeach


                 </ul>
             </li>
         @endif



         <li class="menu-item" onclick="setActive(this)">
             <a href="{{ route('auth.logout') }}" class="menu-link">
                 <img class="menu-icon tf-icons" src="{{ asset('image/logout.svg') }}" alt="">
                 <div data-i18n="Basic">Logout</div>
             </a>
         </li>
     </ul>
 </aside>
 <!-- / Menu -->
