<!DOCTYPE html>
<html lang="zxx">

<head>
 
   
    <meta charset="UTF-8">
    <meta name="description" content="Fashi Template">
    <meta name="keywords" content="Fashi, unica, creative, html">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fashi | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href={{ asset('front/css/bootstrap.min.css') }} type="text/css">
    <link rel="stylesheet" href={{ asset("front/css/font-awesome.min.css") }} type="text/css">
    <link rel="stylesheet" href={{ asset("front/css/themify-icons.css") }} type="text/css">
    <link rel="stylesheet" href={{ asset("front/css/elegant-icons.css") }} type="text/css">
    <link rel="stylesheet" href={{ asset("front/css/owl.carousel.min.css") }} type="text/css">
    <link rel="stylesheet" href={{ asset("front/css/nice-select.css") }} type="text/css">
    <link rel="stylesheet" href={{ asset("front/css/jquery-ui.min.css") }} type="text/css">
    <link rel="stylesheet" href={{ asset("front/css/slicknav.min.css") }} type="text/css">
    <link rel="stylesheet" href={{ asset("front/css/default.min.css") }} type="text/css">
    <link rel="stylesheet" href={{ asset("front/css/style.css") }} type="text/css">
    
    <style>
form.cmxform label.error, label.error {
    background-color: #e7ab3c;
    font-style: italic;
}
.nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {
    background-color:black !important;
    color:white;
}
.detail-nav-link.nav-link:hover, .detail-nav-link.nav-link {
    background-color:white !important;
    color:black;
}
a.disabled {
  /* Make the disabled links grayish*/
  color: gray;
  /* And disable the pointer events */
  pointer-events: none;
}
    </style>
   
</head>
<body style="overflow-x: hidden;">
       
    <div id="preloder">
        <div class="loader"></div>
    </div>
    
    
    @include('layouts.Client_layout.Client_Header') 
        

    <div class="mobile-menu-overlay"></div>
         @yield('content')


         @include('layouts.Client_layout.Client_Footer')
         
        
        <script src="{{ url('front/js/jquery-3.3.1.min.js')}}"></script>
        <script src="{{ url('front/js/bootstrap.min.js')}}">></script>
        <script src="{{ url('front/js/jquery-ui.min.js')}}">></script>
        <script src="{{ url('front/js/jquery.validate.js')}}">></script>
        <script src="{{ url('front/js/jquery.countdown.min.js')}}">></script>
        <script src="{{ url('front/js/jquery.nice-select.min.js')}}">></script>
        <script src="{{ url('front/js/jquery.zoom.min.js')}}">></script>
        <script src="{{ url('front/js/jquery.dd.min.js')}}">></script>
        <script src="{{ url('front/js/jquery.slicknav.js')}}">></script>
        <script src="{{ url('front/js/owl.carousel.min.js')}}">></script>
        <script src="{{ url('front/js/main.js')}}">> </script>
        <script src="{{ url('js/front_js/front_script.js')}}">> </script>

</body>
</html>