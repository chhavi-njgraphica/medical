<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
	<meta name="author" content="NobleUI">
	<meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
    <title>Admin</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('assets/backend/vendors/sweetalert2/sweetalert2.min.css')}}">
  <!-- End fonts -->

	<!-- core:css -->
	<link rel="stylesheet" href="{{asset('assets/backend/vendors/core/core.css')}}">
	<!-- endinject -->

	<!-- Plugin css for this page -->
	<!-- End plugin css for this page -->

	<!-- inject:css -->
	<link rel="stylesheet" href="{{asset('assets/backend/fonts/feather-font/css/iconfont.css')}}">
	<link rel="stylesheet" href="{{asset('assets/backend/vendors/flag-icon-css/css/flag-icon.min.css')}}">
	<!-- endinject -->

  <!-- Layout styles -->  
	<link rel="stylesheet" href="{{asset('assets/backend/css/demo1/style.css')}}">
  <!-- End layout styles -->

  <link rel="shortcut icon" href="{{asset('assets/backend/images/favicon.png')}}" />
</head>
<body>
	<div class="main-wrapper">
		<div class="page-wrapper full-page">
            <div id="particles-js"></div>
			<div class="page-content d-flex align-items-center justify-content-center">
				<div class="row w-100 mx-0 auth-page">
					<div class="col-md-8 col-xl-6 col-xxl-4 mx-auto">
						<div class="card">
							<div class="auth-form-wrapper p-4">
                                <a href="#" class="noble-ui-logo d-block mb-2">
                                    <img src="{{asset('assets/images/logo.png')}}" alt="Site Logo"  class="site-logo">
                                </a>
                                <h5 class="text-muted fw-normal mb-4">Welcome back! Log in to your account.</h5>
                                <form class="forms-sample" id="login-form">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="userEmail" class="form-label">Email address</label>
                                        <input type="email" name="email" class="form-control" id="userEmail" placeholder="Email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="userPassword" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="userPassword" autocomplete="current-password" placeholder="Password">
                                    </div>
                                    <div>
                                        <a href="#" class="btn btn-primary me-2 mb-2 mb-md-0 text-white" id="submit">
                                            <i data-feather="command" class="me-2"></i> Login
                                        </a>
                                    </div>
                                </form>
                            </div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
      <script src="{{asset('assets/backend/vendors/core/core.js')}}"></script>
      <script src="{{asset('assets/backend/vendors/feather-icons/feather.min.js')}}"></script>
      <script src="{{asset('assets/backend/js/template.js')}}"></script>
      <script src="{{asset('assets/backend/vendors/sweetalert2/sweetalert2.min.js')}}"></script>
      <script src="{{asset('assets/backend/js/sweet-alert.js')}}"></script>
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
    <script>
        $(document).ready(()=>{
            $('#submit').click(function(e){
                e.preventDefault();
                let url = "{{route('login.post')}}";
                let form = document.getElementById('login-form');
                let data = new FormData(form);
                //resuest Start
                $.ajax({
                    type:'post',
                    url:url,
                    data:data,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success:function(res){
                        form.reset();
                        if(res.type == 'success'){
                            successToast(res.msg)
                            setTimeout(() => {
                                window.location.replace("{{route('dashboard')}}");
                            }, 2000);
                        }else{
                            errorToast(res.msg)
                        }
                        
                    },
                    error:function(res){
                        let errors = Object.values(res.responseJSON.errors);
                        errors.map((er)=>{
                            errorToast(er)
                        })
                    }
                });
                //resuest End
            })
        });
    </script>
</body>
</html>
