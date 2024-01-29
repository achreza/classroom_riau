 <!-- Menu -->

 <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
     <div class="app-brand d-flex justify-content-center">
         <a href="{{ route('dashboard.index') }}" class="app-brand-link ">
             <img src="{{ asset('image/logo2.png') }}" style="width: 120px" class="" alt="">

         </a>

         <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
             <span class="navbar-toggler-icon"></span>
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
                 @if (request()->session()->get('user')->belum_bayar == 1)
                 <ul class="menu-sub">
                    @foreach (request()->session()->get('kelas') as $item)
                        <li class="menu-item {{ Request::is('kelas*') ? 'active' : '' }}" onclick="setActive(this)">
                            <a href="{{ route('kelas.show', ['kela' => $item->id]) }}" class="menu-link">
                                <div data-i18n="Account">{{ $item->nama_kelas }}</div>
                            </a>
                        </li>
                    @endforeach


                </ul>
                @else

                @endif
                 
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
