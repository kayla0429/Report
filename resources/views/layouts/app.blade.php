<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- 디자인 부분은 sb admin 템플릿을 사용했습니다.-->
    <link rel="stylesheet" href="/vendor/jquery.fancybox.min.css" media="screen">
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
<style>
    .uploader {
    position:relative; 
    overflow:hidden; 
    width:100%; 
    height:100%;
    background:#f3f3f3; 
    border:2px dashed #e8e8e8;
}

#filePhoto{
    position:absolute;
    width:100%;
    height:100%;
    top:0px;
    left:0;
    z-index:2;
    opacity:0;
    cursor:pointer;
}

.uploader img{
    position:relative; 
    width:100%; 
    height:100%;
    top:-1px;
    left:-1px;
    z-index:1;
    border:none;
}
.green{
  background-color:#6fb936;
}
        .thumb{
            margin-bottom: 30px;
        }

        .page-top{
            margin-top:85px;
        }

img.zoom {
    width: 100%;
    height: 200px;
    border-radius:5px;
    object-fit:cover;
    -webkit-transition: all .3s ease-in-out;
    -moz-transition: all .3s ease-in-out;
    -o-transition: all .3s ease-in-out;
    -ms-transition: all .3s ease-in-out;
}
.transition {
    -webkit-transform: scale(1.2);
    -moz-transform: scale(1.2);
    -o-transform: scale(1.2);
    transform: scale(1.2);
}
    .modal-header {

     border-bottom: none;
}
    .modal-title {
        color:#000;
    }
    .modal-footer{
      display:none;
    }
</style>
</head>
<body>

  <div id="wrapper">
    <!-- 사이드바 -->
    <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- 메뉴 -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas">메뉴</i>
        </div>
      </a>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <!-- Divider -->
      <hr class="sidebar-divider">
    @guest
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/') }}">
          <i class="fas fa-home"></i>
          <span>홈</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">
          <i class="fas fa-unlock-alt"></i>
          <span>로그인</span></a>
        </li>
      <li class="nav-item">
        <a class="nav-link"  href="{{ route('register') }}">
          <i class="fas fa-sign-in-alt"></i>
          <span>등록하기</span></a>
      </li>
    @else
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/') }}">
          <i class="fas fa-home"></i>
          <span>홈</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="charts.html">
          <i class="fas fa-key"></i>
          <span>비밀번호 변경</span></a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          <i class="fas fa-sign-out-alt"></i>
          <span>로그아웃</span></a>
      </li>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    @endguest
    <!-- 사이드바 토글 -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
      <div id="content-wrapper" class="d-flex flex-column">
    </ul>
    <div id="content-wrapper" class="d-flex flex-column">
    @yield('content')
        <!-- 바닥글 -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; 1 조 2019</span>
          </div>
        </div>
      </footer>
    </div>
</div>
    <!-- 부트 스트랩및 sb admin 스크립트 입니다.-->
    <script src="/js/app.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/vendor/jquery.min.js"></script>
    <script src="/vendor/jquery.fancybox.min.js"></script>
    <script>
                  //한글
                  var disqus_shortname = 'test';
            var disqus_identifier = 'okok';
            var disqus_url = 'http://example.com/unique-path-to-article-1/';
          var disqus_config = function () { 
	  this.language = "ko";
	};         
            $(document).ready(function(){
              $(".fancybox").fancybox({
                    openEffect: "none",
                    closeEffect: "none"
                });
                //디스쿼스 쓸라고 추가함
                $(".fancybox").on("click", function()
                    {
                      disqus_shortname = 'computelabo-com'; 
                     disqus_identifier = $(this).attr('ti');
                     disqus_url = $(this).attr('image');
                      //reset("newid4", "http://example.com/unique-path-to-article4/","Article Title 4", 'ru');
                      //디스쿼스 부르는 부분
                    });
                $(".zoom").hover(function(){
                    $(this).addClass('transition');
                }, function(){
                    $(this).removeClass('transition');
                });
            });
    </script>
    <script>
      //issue #4
      if(window.location.href == "https://phpreport.azurewebsites.net/home")
      {
        var imageLoader = document.getElementById('filePhoto');
            imageLoader.addEventListener('change', handleImage, false);

    function handleImage(e) {
        var reader = new FileReader();
        reader.onload = function (event) {
            $('.uploader img').attr('src',event.target.result);
        }
        reader.readAsDataURL(e.target.files[0]);
    }
      }
    </script>
</body>
</html>
