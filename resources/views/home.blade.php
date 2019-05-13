@extends('layouts.app')

@section('content')
      <!-- Main Content -->
      <div id="content">
        <!-- End of Topbar -->
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <div class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <h1 class="h3 mb-0 text-gray-800">안녕하세요 {{Auth::user()->name}} 님 <i class="fas fa-smile fa-1x text-gray-300"></i></h1>
          </div>
          <!-- Content Row -->
          <div class="row">
            <!-- 좋아요 갯수 -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-md font-weight-bold text-primary text-uppercase mb-1">내가 받은 좋아요 갯수</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$like}} 개</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-thumbs-up fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- 내가 올린 사진 갯수 -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-md font-weight-bold text-success text-uppercase mb-1">내가 올린 이미지 갯수</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$count}} 개</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-camera fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- 목록 및 업로드 -->
          <div class="row">
            <!-- 목록 -->
            <div class="col-xl-6 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">내가 올린 이미지 목록</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="row">
                  @if(!empty($posts))
                    @foreach ($posts as $value)
                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                        <p style="text-align:center">{{$value->title}}</p>
                                <a href="{{$value->image}}" title="{{$value->content}}" class="fancybox" rel="ligthbox">
                                    <img  src="{{$value->image}}" class="zoom img-fluid "  alt="{{$value->title}}">
                                </a>
                                <p style="text-align:center">좋아요 : {{$value->likes}}</p>
                                <a class="btn btn-danger col-md-12" href="{{ url('/home/delete') }}/{{$value->pid}}">삭제하기 <i class="fas fa-trash fa-2x text-gray-300"></i></a>
                        </div>  
                    @endforeach
                    @else
                    <h6 class="m-0 font-weight-bold text-primary">사진이 없습니다.</h6>
                  @endif
                </div>
                </div>
              </div>
            </div>
            <!-- 업로드 -->
            <div class="col-xl-6 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header-->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">이미지 업로드 하기</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    @if ($errors->any())
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                          <strong>업로드 할수가 없습니다.</strong>
                                        </div>
                                    @endif
                                    <form action="{{ route('home') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="title" class="col-md-4 col-form-label text-md-right">제목</label>
                                            <div class="col-md-6">
                                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}">
                                            </div>
                                            @error('title')
                                                  <strong>{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="form-group row">
                                            <label for="content" class="col-md-4 col-form-label text-md-right">내용</label>
                                            <div class="col-md-6">
                                                <input id="content" type="text" class="form-control" name="content" value="{{ old('content') }}">
                                            </div>
                                            @error('content')
                                              <strong>{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <div class="uploader" onclick="$('#filePhoto').click()">
                                                    <img src="/images/drag.png"/>
                                                    <input type="file" name="image"  id="filePhoto" />
                                                </div>
                                            </div>
                                            @error('image')
                                              <strong>{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="form-group row mb-0 mt-5">
                                            <div class="col-md-8 offset-md-4">
                                                <button type="submit" class="btn btn-primary">업로드</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                </div>
              </div>
            </div>
          </div>


        </div>
        <!-- /.container-fluid -->
      </div>

      <!-- End of Footer -->
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
@endsection
