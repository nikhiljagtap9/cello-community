<!doctype html>
<html lang="en">
   <!-- [Head] start -->
   <head>
      <title>Cello Community</title>
      <!-- [Meta] -->
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="author" content="" />
      <!-- [Favicon] icon -->
      <link rel="icon" href="{{ asset('freelance/assets/images/fev.png')}}" type="image/x-icon" />
      <!-- [Google Font : Public Sans] icon -->
      <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
      <!-- [phosphor Icons] https://phosphoricons.com/ -->
      <link rel="stylesheet" href="{{ asset('freelance/assets/fonts/phosphor/duotone/style.css')}}" />
      <!-- [Tabler Icons] https://tablericons.com -->
      <link rel="stylesheet" href="{{ asset('freelance/assets/fonts/tabler-icons.min.css')}}" />
      <!-- [Feather Icons] https://feathericons.com -->
      <link rel="stylesheet" href="{{ asset('freelance/assets/fonts/feather.css')}}" />
      <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
      <link rel="stylesheet" href="{{ asset('freelance/assets/fonts/fontawesome.css')}}" />
      <!-- [Material Icons] https://fonts.google.com/icons -->
      <link rel="stylesheet" href="{{ asset('freelance/assets/fonts/material.css')}}" />
      <!-- [Template CSS Files] -->
      <link rel="stylesheet" href="{{ asset('freelance/assets/css/style.css')}}" id="main-style-link" />
      <link rel="stylesheet" href="{{ asset('freelance/assets/css/style-preset.css')}}" />
      <link rel="stylesheet" href="{{ asset('freelance/assets/css/plugins/dataTables.bootstrap5.min.css')}}" />
      <link rel="stylesheet" href="{{ asset('freelance/assets/fonts/phosphor/duotone/style.css')}}" />
   </head>
   <!-- [Head] end -->
   @php
     use Illuminate\Support\Facades\Auth;
   @endphp
   <!-- [Body] Start -->
   <body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
      <!-- [ Pre-loader ] start -->
      <div class="loader-bg">
         <div class="loader-track">
            <div class="loader-fill"></div>
         </div>
      </div>
      <!-- [ Pre-loader ] End -->
      <!-- [ Sidebar Menu ] start -->
      <nav class="pc-sidebar">
         <div class="navbar-wrapper">
            <div class="m-header">
               <a href="{{route('freelancer.dashboard')}}" class="b-brand text-primary">
                  <!-- ========   Change your logo from here   ============ -->
                  <img src="{{ asset('freelance/assets/images/Logo.png')}}"  alt="logo image" class="main_logo" /> 
               </a>
            </div>
            <div class="navbar-content">
               <div class="clear"></div>
               <ul class="pc-navbar">
               <li class="pc-item pc-hasmenu activ_dash">
                  <a href="{{route('freelancer.dashboard')}}" class="pc-link">
                  <span class="pc-micon">
                  <i class="ph-duotone ph-gauge"></i>
                  </span>
                  <span class="pc-mtext" >Dashboard  </span> 
                  </a>
               </li>




               <li class="pc-item pc-hasmenu ">
                  <a onclick="frelanc_add()" class="pc-link">
                     <span class="pc-micon">
                       <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-users-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4c.96 0 1.84 .338 2.53 .901" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M16 19h6" /><path d="M19 16v6" /></svg>
                     </span>
                     <span class="pc-mtext" >Add Prospects</span> 
                  </a>
               </li>

               <li class="pc-item pc-hasmenu ">
                  <a href="{{route('freelancer.prospects.allProspects')}}" class="pc-link">
                     <span class="pc-micon">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-users"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
                     </span>
                     <span class="pc-mtext" >View All Prospects</span> 
                  </a>
               </li>

                 

                <li class="pc-item pc-hasmenu ">
                  <a href="{{route('freelancer.prospects.addedProspects')}}" class="pc-link">
                     <span class="pc-micon">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-users-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4c.96 0 1.84 .338 2.53 .901" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M16 19h6" /><path d="M19 16v6" /></svg>
                     </span>
                     <span class="pc-mtext" >Added Prospects</span> 
                  </a>
               </li>


                <li class="pc-item pc-hasmenu ">
                  <a href="{{route('freelancer.prospects.pendingProspects')}}" class="pc-link">
                     <span class="pc-micon">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-pause"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h3.5" /><path d="M17 17v5" /><path d="M21 17v5" /></svg>
                     </span>
                     <span class="pc-mtext" >Pending Prospects</span> 
                  </a>
               </li>


               <li class="pc-item pc-hasmenu ">
                  <a href="reward.php" class="pc-link">
                     <span class="pc-micon">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-award"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9m-6 0a6 6 0 1 0 12 0a6 6 0 1 0 -12 0" /><path d="M12 15l3.4 5.89l1.598 -3.233l3.598 .232l-3.4 -5.889" /><path d="M6.802 12l-3.4 5.89l3.598 -.233l1.598 3.232l3.4 -5.889" /></svg>
                     </span>
                     <span class="pc-mtext" >Gift Voucher </span> 
                  </a>
               </li>


               
               

               <li class="pc-item pc-hasmenu ">
                  <a href="#" class="pc-link">
                     <span class="pc-micon">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-settings"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /></svg>
                     </span>
                     <span class="pc-mtext" >Setting</span> 
                  </a>
               </li>
            </div>
         </div>
      </nav>
      <!-- [ Sidebar Menu ] end -->
      <!-- [ Header Topbar ] start -->
      <header class="pc-header">
         <div class="header-wrapper">
            <!-- [Mobile Media Block] start -->
            <div class="me-auto pc-mob-drp">
               <ul class="list-unstyled">
                  <!-- ======= Menu collapse Icon ===== -->
                  <li class="pc-h-item pc-sidebar-collapse">
                     <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
                     <i class="ti ti-menu-2"></i>
                     </a>
                  </li>
                  <li class="pc-h-item pc-sidebar-popup">
                     <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
                     <i class="ti ti-menu-2"></i>
                     </a>
                  </li>
                  <li class="dropdown pc-h-item d-inline-flex d-md-none">
                     <a
                        class="pc-head-link dropdown-toggle arrow-none m-0"
                        data-bs-toggle="dropdown"
                        href="#"
                        role="button"
                        aria-haspopup="false"
                        aria-expanded="false"
                        >
                     <i class="ph-duotone ph-magnifying-glass"></i>
                     </a>
                     <div class="dropdown-menu pc-h-dropdown drp-search">
                        <form class="px-3">
                           <div class="mb-0 d-flex align-items-center">
                              <input type="search" class="form-control border-0 shadow-none" placeholder="Search..." />
                              <button class="btn btn-light-secondary btn-search">Search</button>
                           </div>
                        </form>
                     </div>
                  </li>
                  <li class="pc-h-item d-none d-md-inline-flex">
                     <form class="form-search">
                        <i class="ph-duotone ph-magnifying-glass icon-search"></i>
                        <input type="search" class="form-control" placeholder="Search..." />
                        <button class="btn btn-search" style="padding: 0">
                           <kbd>
                              <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                 <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                 <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                 <path d="M21 21l-6 -6" />
                              </svg>
                           </kbd>
                        </button>
                     </form>
                  </li>
               </ul>
            </div>
            <!-- [Mobile Media Block end] -->
            <div class="ms-auto">
               <ul class="list-unstyled">
                  <li class="dropdown pc-h-item d-none d-md-inline-flex">
                     <a
                        class="pc-head-link dropdown-toggle arrow-none me-0"
                        data-bs-toggle="dropdown"
                        href="#"
                        role="button"
                        aria-haspopup="false"
                        aria-expanded="false"
                        >
                     <i class="ph-duotone ph-sun-dim"></i>
                     </a>
                     <div class="dropdown-menu dropdown-menu-end pc-h-dropdown">
                        <a href="#!" class="dropdown-item" onclick="layout_change('dark')">
                        <i class="ph-duotone ph-moon"></i>
                        <span>Dark</span>
                        </a>
                        <a href="#!" class="dropdown-item" onclick="layout_change('light')">
                        <i class="ph-duotone ph-sun-dim"></i>
                        <span>Light</span>
                        </a>
                        <a href="#!" class="dropdown-item" onclick="layout_change_default()">
                        <i class="ph-duotone ph-cpu"></i>
                        <span>Default</span>
                        </a>
                     </div>
                  </li>
                  <li class="dropdown pc-h-item">
                     <a
                        class="pc-head-link dropdown-toggle arrow-none me-0"
                        data-bs-toggle="dropdown"
                        href="#"
                        role="button"
                        aria-haspopup="false"
                        aria-expanded="false"
                        >
                     <i class="ph-duotone ph-bell"></i>
                     <span class="badge bg-success pc-h-badge">3</span>
                     </a>
                     <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
                        <div class="dropdown-header d-flex align-items-center justify-content-between">
                           <h5 class="m-0">Notifications</h5>
                           <ul class="list-inline ms-auto mb-0">
                              <li class="list-inline-item">
                                 <a href="#" class="avtar avtar-s btn-link-hover-primary">
                                 <i class="ti ti-link f-18"></i>
                                 </a>
                              </li>
                           </ul>
                        </div>
                        <div class="dropdown-body text-wrap header-notification-scroll position-relative" style="max-height: calc(100vh - 235px)">
                           <ul class="list-group list-group-flush">
                              <li class="list-group-item">
                                 <div class="d-flex">
                                    <div class="flex-shrink-0">
                                       <img src="{{ asset('freelance/assets/images/user/avatar-2.jpg')}}" alt="user-image" class="user-avtar avtar avtar-s" />
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                       <div class="d-flex">
                                          <div class="flex-grow-1 me-3 position-relative">
                                             <h6 class="mb-0 text-truncate">New  Member Subscribed</h6>
                                          </div>
                                          <div class="flex-shrink-0">
                                             <span class="text-sm">2 min ago</span>
                                          </div>
                                       </div>
                                       <p class="position-relative mt-1 mb-2"
                                          ><br /><span class="text-truncate"
                                          >Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</span
                                          ></p
                                          >
                                    </div>
                                 </div>
                              </li>
                              <li class="list-group-item">
                                 <div class="d-flex">
                                    <div class="flex-shrink-0">
                                       <img src="{{ asset('freelance/assets/images/user/avatar-2.jpg')}}" alt="user-image" class="user-avtar avtar avtar-s" />
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                       <div class="d-flex">
                                          <div class="flex-grow-1 me-3 position-relative">
                                             <h6 class="mb-0 text-truncate">New  Member Subscribed</h6>
                                          </div>
                                          <div class="flex-shrink-0">
                                             <span class="text-sm">2 min ago</span>
                                          </div>
                                       </div>
                                       <p class="position-relative mt-1 mb-2"
                                          ><br /><span class="text-truncate"
                                          >Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</span
                                          ></p
                                          >
                                    </div>
                                 </div>
                              </li>
                              <li class="list-group-item">
                                 <div class="d-flex">
                                    <div class="flex-shrink-0">
                                       <div class="avtar avtar-s bg-light-success">
                                          <i class="ph-duotone ph-shield-checkered f-18"></i>
                                       </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                       <div class="d-flex">
                                          <div class="flex-grow-1 me-3 position-relative">
                                             <h6 class="mb-0 text-truncate">Security</h6>
                                          </div>
                                          <div class="flex-shrink-0">
                                             <span class="text-sm">5 hour ago</span>
                                          </div>
                                       </div>
                                       <p class="position-relative mt-1 mb-2"
                                          >Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard
                                          dummy text ever since the 1500s.
                                       </p
                                          >
                                    </div>
                                 </div>
                              </li>
                           </ul>
                        </div>
                        <div class="dropdown-footer">
                           <div class="row g-3">
                              <div class="col-6">
                                 <div class="d-grid"><button class="btn btn-primary">Archive all</button></div>
                              </div>
                              <div class="col-6">
                                 <div class="d-grid"><button class="btn btn-outline-secondary">Mark all as read</button></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </li>
                  <li class="dropdown pc-h-item header-user-profile">
                     <a
                        class="pc-head-link dropdown-toggle arrow-none me-0"
                        data-bs-toggle="dropdown"
                        href="#"
                        role="button"
                        aria-haspopup="false"
                        data-bs-auto-close="outside"
                        aria-expanded="false"
                        >
                     <img src="{{ asset('freelance/assets/images/user/avatar-2.jpg')}}" alt="user-image" class="user-avtar" />
                     </a>
                     <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                        <div class="dropdown-header d-flex align-items-center justify-content-between">
                           <h5 class="m-0">Profile</h5>
                        </div>
                        <div class="dropdown-body">
                           <div class="profile-notification-scroll position-relative" style="max-height: calc(100vh - 225px)">
                              <ul class="list-group list-group-flush w-100">
                                 <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                       <div class="flex-shrink-0">
                                          <img src="{{ asset('freelance/assets/images/user/avatar-2.jpg')}}" alt="user-image" class="wid-50 rounded-circle" />
                                       </div>
                                       <div class="flex-grow-1 mx-3">
                                          <h5 class="mb-0">{{ Auth::user()->details->first_name }} {{ Auth::user()->details->last_name }}</h5>
                                          <a class="link-primary" href="#">{{ Auth::user()->email }}</a>
                                       </div>
                                    </div>
                                 </li>
                                 <li class="list-group-item">
                                     
                                    <a href="#" class="dropdown-item">
                                    <span class="d-flex align-items-center">
                                    <i class="ph-duotone ph-key"></i>
                                    <span>Change password</span>
                                    </span>
                                    </a>
                                    <a href="#" class="dropdown-item">
                                    <span class="d-flex align-items-center">
                                    <i class="ph-duotone ph-user-circle"></i>
                                    <span>Edit profile</span>
                                    </span>
                                    </a>
                                    <span class="dropdown-item">
                                       <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                          @csrf
                                          <button type="submit" class="dropdown-item" style="background:none; border:none; padding:0; cursor:pointer;">
                                             <span class="d-flex align-items-center">
                                                   <i class="ph-duotone ph-power"></i>
                                                   <span>Logout</span>
                                             </span>
                                          </button>
                                       </form>
                                    </span>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </li>
               </ul>
            </div>
         </div>
      </header>
      <!-- [ Header ] end -->