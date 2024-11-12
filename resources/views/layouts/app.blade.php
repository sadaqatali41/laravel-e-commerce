<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Daily Shop | Home')</title>
    
    <!-- Font awesome -->
    <link href="{{ asset('assets/css/font-awesome.css') }}" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">   
    <!-- SmartMenus jQuery Bootstrap Addon CSS -->
    <link href="{{ asset('assets/css/jquery.smartmenus.bootstrap.css') }}" rel="stylesheet">
    <!-- Product view slider -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.simpleLens.css') }}">    
    <!-- slick slider -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/slick.css') }}">
    <!-- price picker slider -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/nouislider.css') }}">
    <!-- Theme color -->
    <link id="switcher" href="{{ asset('assets/css/theme-color/default-theme.css') }}" rel="stylesheet">
    <!-- Top Slider CSS -->
    <link href="{{ asset('assets/css/sequence-theme.modern-slide-in.css') }}" rel="stylesheet" media="all">
    <!-- Main style sheet -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">    
    <!-- Google Font -->
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="productPage"> 
   <!-- wpf loader Two -->
    <div id="wpf-loader-two">          
      <div class="wpf-loader-two-inner">
        <span>Loading</span>
      </div>
    </div> 
    <!-- / wpf loader Two -->       
  <!-- SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
  <!-- END SCROLL TOP BUTTON -->

  <!-- Start header section -->
  @include('includes.header')
  <!-- / header section -->
  <!-- menu -->
  @include('includes.menu')
  <!-- / menu -->
  
  {{-- main content --}}
  @yield('content')

  <!-- footer -->  
  @include('includes.footer')
  <!-- / footer -->

  <!-- Login Modal -->
  @guest  
    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">                      
          <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4>Login</h4>
            <form class="aa-login-form" action="{{ route('user.check') }}" id="loginForm">
              <label for="email">Email<span>*</span></label>
              <input type="email" placeholder="Email" name="email" id="email_login" value="{{ Cookie::get('email') }}">

              <label for="password">Password<span>*</span></label>
              <input type="password" placeholder="Password" name="password" id="password_login" value="{{ Cookie::get('password') }}">

              <button class="aa-browse-btn" type="submit" id="loginFormBtn">Login</button>

              <label for="remember" class="rememberme">
                <input type="checkbox" id="remember" name="remember" value="1" {{ Cookie::get('email') ? 'checked' : '' }}> Remember me 
              </label>
              <p class="aa-lost-password">
                <a href="javascript:void(0)" id="lostPasswordModalOpen">Lost your password?</a>
              </p>
              <div class="aa-register-now">
                Don't have an account?<a href="{{ route('user.registration') }}">Register now!</a>
              </div>
            </form>
          </div>                        
        </div>
      </div>
    </div>
  @endguest
  <!-- Forget Password Modal -->  
  <div class="modal fade" id="forget-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">                      
        <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4>Forget Password</h4>
          <form class="aa-login-form" action="{{ route('user.password.reset') }}" id="forgetPasswordForm">
            <label for="email">Email<span>*</span></label>
            <input type="email" placeholder="Email" name="email" id="email_forget">
            <button class="aa-browse-btn" type="submit" id="forgetPasswordFormBtn">Send Reset Link</button>
            <br><br><br>
            <p class="aa-lost-password">
              <a href="javascript:void(0)" id="loginModalOpen">Already have an account? Login</a>
            </p>
            <div class="aa-register-now">
              Don't have an account?<a href="{{ route('user.registration') }}">Register now!</a>
            </div>
          </form>
        </div>                        
      </div>
    </div>
  </div>    

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="{{ asset('assets/js/bootstrap.js') }}"></script>  
  <!-- SmartMenus jQuery plugin -->
  <script type="text/javascript" src="{{ asset('assets/js/jquery.smartmenus.js') }}"></script>
  <!-- SmartMenus jQuery Bootstrap Addon -->
  <script type="text/javascript" src="{{ asset('assets/js/jquery.smartmenus.bootstrap.js') }}"></script>  
  <!-- To Slider JS -->
  <script src="{{ asset('assets/js/sequence.js') }}"></script>
  <script src="{{ asset('assets/js/sequence-theme.modern-slide-in.js') }}"></script>  
  <!-- Product view slider -->
  <script type="text/javascript" src="{{ asset('assets/js/jquery.simpleGallery.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/js/jquery.simpleLens.js') }}"></script>
  <!-- slick slider -->
  <script type="text/javascript" src="{{ asset('assets/js/slick.js') }}"></script>
  <!-- Price picker slider -->
  <script type="text/javascript" src="{{ asset('assets/js/nouislider.js') }}"></script>
  <!-- Custom js -->
  <script src="{{ asset('assets/js/custom.js') }}"></script> 

  </body>
</html>