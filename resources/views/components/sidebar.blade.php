 <nav class="navbar-vertical navbar ">
     <div id="myScrollableElement" class="h-screen" data-simplebar>
         <!-- brand logo -->
         <a class="navbar-brand" href="/">
             <img src="/dist/assets/images/brand/logo/logo.svg" alt="" />
         </a>

         <!-- navbar nav -->
         <ul class="navbar-nav flex-col" id="sideNavbar">
             <li class="nav-item">
                 <a class="nav-link  {{ request()->routeIs('dashboard') ? 'active' : '' }} "
                     href="{{ route('dashboard') }}">
                     <i data-feather="home" class="w-4 h-4 mr-2"></i>
                     Dashboard
                 </a>
             </li>
             <!-- nav item -->
             <li class="nav-item">
                 <div class="navbar-heading">Pages</div>
             </li>
             <li class="nav-item">
                 <a class="nav-link {{ request()->routeIs('categori') ? 'active' : '' }} " href="{{ route('categori') }}">
                     <i data-lucide="square-stack" class="w-4 h-4 mr-2"></i>
                     Category
                 </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link {{ request()->routeIs('warehouse') ? 'active' : '' }} " href="{{ route('warehouse') }}">
                     <i data-lucide="warehouse" class="w-4 h-4 mr-2"></i>
                     Warehouse
                 </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link {{ request()->routeIs('staff') ? 'active' : '' }} " href="{{ route('staff') }}">
                     <i data-lucide="user" class="w-4 h-4 mr-2"></i>
                     Staff
                 </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link {{ request()->routeIs('item') ? 'active' : '' }} " href="{{ route('item') }}">
                     <i data-lucide="boxes" class="w-4 h-4 mr-2"></i>
                     Item
                 </a>
             </li>
             <!-- nav item -->
             {{-- <li class="nav-item">
                 <a class="nav-link  collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#navPages"
                     aria-expanded="false" aria-controls="navPages">
                     <i data-feather="layers" class="w-4 h-4 mr-2"></i>
                     Pages
                 </a>
                 <div id="navPages" class="collapse " data-bs-parent="#sideNavbar">
                     <ul class="nav flex-col">
                         <li class="nav-item">
                             <a class="nav-link " href="/dist/profile.html">Profile</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link " href="/dist/settings.html">Settings</a>
                         </li>

                         <li class="nav-item">
                             <a class="nav-link " href="/dist/billing.html">Billing</a>
                         </li>

                         <li class="nav-item">
                             <a class="nav-link " href="/dist/pricing.html">Pricing</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link " href="/dist/404-error.html">404 Error</a>
                         </li>
                     </ul>
                 </div>
             </li> --}}
         </ul>
     </div>
 </nav>
