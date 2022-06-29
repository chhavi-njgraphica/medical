<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
      <meta name="author" content="NobleUI">
      <meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
      <title>@yield('title')</title>
      @yield('css')
      <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
      <!-- End fonts -->
      <!-- core:css -->
      <link rel="stylesheet" href="{{asset('assets/backend/vendors/core/core.css')}}">
      <!-- endinject -->
      <!-- inject:css -->
      <link rel="stylesheet" href="{{asset('assets/backend/vendors/mdi/css/materialdesignicons.min.css')}}">
      <link rel="stylesheet" href="{{asset('assets/backend/fonts/feather-font/css/iconfont.css')}}">
      <link rel="stylesheet" href="{{asset('assets/backend/vendors/flag-icon-css/css/flag-icon.min.css')}}">
      <!-- endinject -->
      <!-- Layout styles -->  
      <link rel="stylesheet" href="{{asset('assets/backend/css/demo1/style.css')}}">
      <!-- End layout styles -->
      <link rel="shortcut icon" href="{{asset('assets/backend/images/favicon.png')}}" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="stylesheet" href="{{asset('assets/backend/vendors/sweetalert2/sweetalert2.min.css')}}">

   </head>
   <style>
      .error{
         color:red;
      }
      </style>
   <body>
      <div class="main-wrapper">
         <!-- partial:partials/_sidebar.html')}} -->
         <nav class="sidebar">
            <div class="sidebar-header">
               <a href="#" class="sidebar-brand">
               Noble<span>UI</span>
               </a>
               <div class="sidebar-toggler not-active">
                  <span></span>
                  <span></span>
                  <span></span>
               </div>
            </div>
            <div class="sidebar-body">
               <ul class="nav">
                  <li class="nav-item nav-category">Main</li>
                  <li class="nav-item">
                     <a href="" class="nav-link">
                     <i class="link-icon" data-feather="box"></i>
                     <span class="link-title">Dashboard</span>
                     </a>
                  </li>
                  <li class="nav-item nav-category">web apps</li>
                
                  <li class="nav-item">
                     <a class="nav-link" data-bs-toggle="collapse" href="#general-pages" role="button" aria-expanded="false" aria-controls="general-pages">
                     <i class="mdi mdi-account-details"></i>
                     <span class="link-title">Portfolio</span>
                     <i class="link-arrow" data-feather="chevron-down"></i>
                     </a>
                     <div class="collapse" id="general-pages">
                     <ul class="nav sub-menu">
                         <li class="nav-item">
                             <a href="}" class="nav-link">Categories</a>
                         </li>
                         <li class="nav-item">
                             <a href="" class="nav-link">Sub Categories</a>
                         </li>
                     </ul>
                     </div>
                 </li>
              
               </ul>
            </div>
         </nav>
         <!-- partial -->
         <div class="page-wrapper">
            <!-- partial:partials/_navbar.html')}} -->
            <nav class="navbar">
               <a href="#" class="sidebar-toggler">
               <i data-feather="menu"></i>
               </a>
               <div class="navbar-content">
                  <ul class="navbar-nav">
                     <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="wd-30 ht-30 rounded-circle" src="https://via.placeholder.com/30x30" alt="profile">
                        </a>
                        <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                           <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                              <div class="mb-3">
                                 <img class="wd-80 ht-80 rounded-circle" src="https://via.placeholder.com/80x80" alt="">
                              </div>
                              <div class="text-center">
                                 <p class="tx-16 fw-bolder">test</p>
                                 <p class="tx-12 text-muted">test</p>
                              </div>
                           </div>
                           <ul class="list-unstyled p-1">
                              <li class="dropdown-item py-2">
                                 <a href="pages/general/profile.html')}}" class="text-body ms-0">
                                 <i class="me-2 icon-md" data-feather="user"></i>
                                 <span>Profile</span>
                                 </a>
                              </li>
                              <li class="dropdown-item py-2">
                                 <a href="logout"
                                 onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();" class="text-body ms-0">
                                 <i class="me-2 icon-md" data-feather="log-out"></i>
                                 <span>Log Out</span>
                                 </a>
                              </li>
                           </ul>
                        </div>
                     </li>
                  </ul>
               </div>
            </nav>
            <form id="logout-form" action="logout" method="POST" class="d-none">
               @csrf
           </form>
            <!-- partial -->
            @yield('content')
            <!-- partial:partials/_footer.html')}} -->
            <footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between px-4 py-3 border-top small">
               <p class="text-muted mb-1 mb-md-0">Copyright © 2021 <a href="" target="_blank">NJGraphica</a>.</p>
               <p class="text-muted">Handcrafted With <i class="mb-1 text-primary ms-1 icon-sm" data-feather="heart"></i></p>
            </footer>
            <!-- partial -->

            
         </div>
      </div>
      <script>
      function  successToast(title="Success"){
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
               toast.addEventListener('mouseenter', Swal.stopTimer)
               toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })

            Toast.fire({
            icon: 'success',
            title
            })
         }

      function   errorToast(title="Failed"){
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
               toast.addEventListener('mouseenter', Swal.stopTimer)
               toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })

            Toast.fire({
            icon: 'warning',
            title
            })
         }
      </script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
      <script src="{{asset('assets/backend/vendors/core/core.js')}}"></script>
      <script src="{{asset('assets/backend/vendors/feather-icons/feather.min.js')}}"></script>
      <script src="{{asset('assets/backend/js/template.js')}}"></script>
      <script src="{{asset('assets/backend/vendors/sweetalert2/sweetalert2.min.js')}}"></script>
      <script src="{{asset('assets/backend/js/sweet-alert.js')}}"></script>
      @yield('script')
      <!-- core:js -->
      
   </body>
</html>