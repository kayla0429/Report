<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', '1 조') }}</title>
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="/vendor/jquery.fancybox.min.css" media="screen">
        <style>
body {
  background-color:white !important;
  font-family: "Asap", sans-serif;
  color:#989898;
  margin:10px;
  font-size:16px;
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
            @if(Route::has('login'))
                    @auth
                        <a class="btn btn-info" href="{{ url('/home') }}">대시보드</a>
                    @else
                        <a class="btn btn-info" href="{{ route('login') }}">로그인</a>
                        @if (Route::has('register'))
                            <a class="btn btn-info" href="{{ route('register') }}">등록하기</a>
                        @endif
                    @endauth
            @endif
    <!-- 켄텐츠 -->
    <div class="container page-top">
            <div class="row">
                @foreach ($all as $value)
                <div class="card col-lg-3 col-md-4 col-xs-6 thumb">
                        <div class="card-body">
                          <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                              <div style="text-align:center" class="text-xl font-weight-bold text-success text-uppercase mb-1">{{$value->title}}</div>
                            <a href="{{$value->image}}" title="{{$value->content}}" class="fancybox" rel="ligthbox" ti="{{$value->title}}-{{$value->pid}}">
                                    <img  src="{{$value->image}}" class="zoom img-fluid "  alt="{{$value->title}}">
                                </a>
                            <a class="btn btn-info col-md-12" href="{{ url('/like') }}/{{$value->pid}}">좋아요 : {{$value->likes}} <i class="fas fa-thumbs-up fa-2x text-gray-300"></i></a>
                          </div>
                        </div>
                      </div>
                    </div>
                @endforeach
        </div>
                  <!-- Footer -->
      <footer class="sticky-footer">
            <div class="container">
              <div class="copyright text-center">
                <span>Copyright &copy; {{ config('app.name', 'Laravel') }} 2019</span>
              </div>
            </div>
          </footer>
          <script src="/js/app.js"></script>
          <script src="/js/bootstrap.min.js"></script>
          <script src="/vendor/jquery.min.js"></script>
          <script src="/vendor/jquery.fancybox.min.js"></script>
          <!--디스쿼스 추가-->
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
    </body>
</html>
