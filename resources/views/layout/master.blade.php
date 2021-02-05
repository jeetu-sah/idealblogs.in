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
  <link href="{{ url('public/front_webu/css/site.css') }}" rel="stylesheet">
  <link href="{{ url('public/css/custom.css') }}" rel="stylesheet">
 
  <script data-ad-client="ca-pub-4152597108794624" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-P2PVSQP7PV"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-P2PVSQP7PV');
</script>
<!--End--->
<!-- font -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-green fixed-top">
    <div class="container">
      <a class="navbar-brand" href="<?php echo url("/") ?>">IdealBlogs</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          @forelse ($headerNavs as $nav)
            <li class="nav-item active">
              <a class="nav-link" href="{{ url($nav->page_slug) }}">{{ $nav->page_name}}</a>
            </li>
          @empty
            <li class="nav-item active">
              <a class="nav-link" href="javascript::void();">No page </a>
            </li>
          @endforelse
          </li>
          @if(Auth::check())
            <li class="nav-item dropdown">
              <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle user-action"><img style="height:30px;" src="https://www.tutorialrepublic.com/examples/images/avatar/3.jpg" class="avtar" alt="Avatar">&nbsp;&nbsp;{{ Auth::user()->name }} 
                <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo url('dashboard/page-list') ?>" class="dropdown-item"><i class="glyphicon glyphicon-user"></i> Dashboard</a></li>
                <li class="divider dropdown-divider"></li>
                <li><a href="<?php echo url('logout') ?>" class="dropdown-item"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
              </ul>
            </li>
		   @else
          @endif  
        </ul>
      </div>
    </div>
  </nav>

  @yield('content')
  <footer class="section footer-classic context-dark bg-image bg-green">
        <div class="container">
          <div class="row row-30 margintop20">
           
              <div class="col-md-4 col-xl-5 margintop20  margin-b-100">
                <div class="pr-xl-4">
                  <h3>About Us</h3>
                  <p>IdealBlogs is a blogging website in which we provide such informative blogs on several topics such as Technology, Entertainment,  LifeStyle, Education, Sports, Health and care, Fashion and Beauty, Pet Care, Gaming, Digital Marketing etc. <span><a href=""><strong>Read More ...</strong></a></span></p>
                  <!-- Rights-->
                  <p class="rights"><span>©  </span><span class="copyright-year">2021</span><span> </span><span>Waves</span><span>. </span>
                    <span>All Rights Reserved by idealblogs.in .</span></p>
                </div>
              </div>
              <div class="col-md-4 margintop20 margin-b-100">
                <h3>Contacts</h3>
                {{-- <dl class="contact-list">
                  <dt>Address:</dt>
                  <dd>798 South Park Avenue, Jaipur, Raj</dd>
                </dl> --}}
                <dl class="contact-list">
                  <dt>Email: <a href="mailto:#">idealblogs@gmail.com</a></dt>
                </dl>
                <h5>Connect With Us</h5>
                <p>
                  <ul class="social-media-icon">
                    <li><a href="#" class="fa fa-facebook"></a></li>
                    <li><a href="#" class="fa fa-twitter"></a></li>
                    <li><a href="#" class="fa fa-instagram"></a></li>
                  </ul>
              </p>
              </div>
              <div class="col-md-4 col-xl-3 margintop20 margin-b-100">
                <h3>Important Links</h3>
                <ul class="nav-list">
                  <li><a href="{{ url('about-us') }}">About</a></li>
                  <li><a href="{{ url('dmca-policy') }}">DMCA Policy</a></li>
                  <li><a href="{{ url('privacy-policy') }}">Privacy Policy</a></li>
                  <!--/*<li><a href="{{ url('term-and-condition') }}">Term and Condision</a></li>*/-->
                  <li><a href="{{ url('contact') }}">Contact Us</a></li>
                </ul>
              </div>
         </div>
        </div>

      </footer>
  <script src="<?php echo url('public/front_webu/vendor/jquery/jquery.min.js'); ?>"></script>
  <script src="<?php echo url('public/front_webu/vendor/bootstrap/js/bootstrap.min.js') ?>">
  </script>
</body>
</html>
