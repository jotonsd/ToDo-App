<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">    
    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://bootswatch.com/5/flatly/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sweet-alert.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="https://bootswatch.com/_vendor/font-awesome/css/font-awesome.min.css">
    <script src="https://bootswatch.com/_vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@emretulek/jbvalidator"></script>
    <script src="{{ asset('js/sweet-alert.js') }}"></script>
    <script src="{{ asset('js/toastr.js') }}"></script>
</head>
<body>
  <script type="text/javascript">
      function success(message){  
        $(function() {      
            var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
            });      
            Toast.fire({
                icon: 'success',
                title: '&nbsp;&nbsp;'+ message
            });
        });
      }
      function failed(message){
       $(function() {
          var Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000
          });      
          Toast.fire({
              icon: 'error',
              title: '&nbsp;&nbsp;'+ message
          });
      });
  }
  </script>
    <div id="app">        
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
          <div class="container-fluid mx-3">
            <a class="navbar-brand" href="{{ Auth::user()? route('home'):route('welcome') }}"><img width="30" src="{{ asset('logo.png') }}"> {{ config('app.name') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor01">
              <ul class="navbar-nav me-auto">
                @guest
                @else                
                  <li class="nav-item">
                    <a class="nav-link {{ Str::startsWith(Route::current()->uri, 'home') ? 'active' : '' }}" href="{{ route('home') }}">List</a>
                  </li>          
                  <li class="nav-item">
                    <a class="nav-link {{ Str::startsWith(Route::current()->uri, 'categories') ? 'active' : '' }}" href="{{ route('categories') }}">Category</a>
                  </li>
                @endguest
              </ul>
              @guest
              <div class="d-flex">
                <a class="btn btn-success my-2 mx-1 my-sm-0" href="{{ route('login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>
                <a class="btn btn-danger my-2 my-sm-0" href="{{ route('register') }}"><i class="fa fa-registered" aria-hidden="true"></i> Register</a>
              </div>
              @else 

              <div class="d-flex">
                <a class="btn btn-success my-2 mx-1 my-sm-0" href="{{ route('home') }}"><i class="fa fa-user-circle-o" aria-hidden="true"></i> {{ Auth::user()->name }}</a>
                <a class="btn btn-danger my-2 my-sm-0"  href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
              </div>   
              @endguest
            </div>
          </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>  
      <!-- ======= Footer ======= -->
        <footer id="footer" class="footer mt-5">
          <div class="copyright  text-dark">
            &copy; {{ date('Y') }} Copyright Reserved.<strong><a href="http://jotonsutradhar.com/" target="_blank" title="Joton Sutradhar"><span> Joton Sutradhar.</span></a></strong>&emsp; 
            <b>Find me</b>: 
              <a target="_blank" href="https://github.com/jotonsd" class="github f20"><i class="fa fa-github-square"></i></a> 
              <a target="_blank" href="https://www.linkedin.com/in/joton-sutradhar-b77996196/" class="linkedin f20"><i class="fa fa-linkedin-square f20"></i></a>
              <a target="_blank" href="https://facebook.com/joton.sutradhar" class="facebook f20"><i class="fa fa-facebook-square f20"></i></a>
              <a target="_blank" href="https://instagram.com/joton.sutradhar" class="instagram f20"><i class="fa fa-instagram f20"></i></a>
          </div>
        </footer><!-- End Footer -->
    </div>  
</body>
</html>
