<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php if(!empty($head_title)) echo $head_title;  ?></title>
  <link rel="icon" type="image/png" href="{{ url('public/image/blog.png') }}">
    <meta property="og:url"           content="{{ Request::url() }}" />
    <meta property="og:type"          content="article" />
    <meta property="og:title"         content="<?php if(!empty($head_title)) echo $head_title;  ?>" />
    <meta property="og:description"   content="<?php if(!empty($meta_description)) echo $meta_description;  ?>" />
    <meta property="og:image"         content="<?php if(!empty($imageUrl)) echo $imageUrl;  ?>" />
    <!--Twitter -->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="<?php if(!empty($meta_description)) echo $meta_description;  ?>" />
    <meta name="twitter:title" content="<?php if(!empty($head_title)) echo $head_title;  ?>" />
    <meta name="twitter:site" content="@jswebsolutions1" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:creator" content="@jswebsolutions1" />
    <!--End-->
    <meta name="description" content="<?php if(!empty($meta_description)) echo $meta_description; ?>">
	<meta name="keywords" content="<?php if(!empty($meta_keyword)) echo $meta_keyword;  ?>">
	
	<!---Google translator code --->
	<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
	<!--End-->
  <link href="{{ url('public/front_webu/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ url('public/front_webu/css/blog-home.css') }}" rel="stylesheet">
  <link href="{{ url('public/css/custom.css') }}" rel="stylesheet">
 
  <script data-ad-client="ca-pub-4152597108794624" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-HFTS18C7Z3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-HFTS18C7Z3');
</script>
<!--End--->
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-green fixed-top">
    <div class="container">
      <a class="navbar-brand" href="<?php echo url("/") ?>">Blogs</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="{{ url('/') }}">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('about') }}">About</a>
          </li>
        <!--/*  <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
          </li>*/-->
          <li class="nav-item">
            <a class="nav-link" href="{{ url('contact') }}">Contact</a>
          </li>
          @if(Auth::check())
          <li class="nav-item dropdown">
				<a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle user-action"><img style="height:30px;" src="https://www.tutorialrepublic.com/examples/images/avatar/3.jpg" class="avtar" alt="Avatar">&nbsp;&nbsp;{{ Auth::user()->name }} <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="<?php echo url('js_admin') ?>" class="dropdown-item"><i class="glyphicon glyphicon-user"></i> Dashboard</a></li>
					<li class="divider dropdown-divider"></li>
					<li><a href="<?php echo url('logout') ?>" class="dropdown-item"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
				</ul>
			</li>
		   @else
           <!--<li class="nav-item">
            <a class="nav-link" href="{{ url('login') }}">Login</a>
          </li>-->
            	
          @endif  
        </ul>
      </div>
    </div>
  </nav>
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle"
     style="display:block; text-align:center;"
     data-ad-layout="in-article"
     data-ad-format="fluid"
     data-ad-client="ca-pub-4152597108794624"
     data-ad-slot="6887541390"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
  @yield('content')
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; jswebsolutions.in&nbsp;<?php date('Y') ?>&nbsp;<a href="<?php echo url('privacy-policy') ?>">Privacy Policy</a>&nbsp;<a href="<?php echo url('term-and-condition') ?>">Term and condition </a></p>
    </div>
    <!-- /.container -->
  </footer>
  <script src="<?php echo url('public/front_webu/vendor/jquery/jquery.min.js'); ?>"></script>
  <script src="<?php echo url('public/front_webu/vendor/bootstrap/js/bootstrap.min.js') ?>">
  </script>
</body>
</html>
