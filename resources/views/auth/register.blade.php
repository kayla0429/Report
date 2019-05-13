@extends('layouts.app')

@section('content')
  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-6 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row justify-content-md-center">
              <div class="col-md-auto">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">등록하기</h1>
                  </div>
                  <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <input name="name" value="{{ old('name') }}" type="text" class="form-control form-control-user" id="exampleInputEmail" required autocomplete="name" autofocus placeholder="이름">
                        @error('name')
                        <span class="text-danger">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <input name="email" value="{{ old('email') }}" type="email" class="form-control form-control-user" id="exampleInputPassword" required autocomplete="email" placeholder="이메일">
                      @error('email')
                      <span class="text-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    </div>
                    <div class="form-group">
                        <input name="password" type="password" class="form-control form-control-user" id="exampleInputPassword" required autocomplete="new-password" placeholder="비밀번호">
                        @error('password')
                        <span class="text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input  name="password_confirmation" type="password" class="form-control form-control-user" id="exampleInputPassword" required autocomplete="new-password" placeholder="비밀번호 확인">
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        {{ __('등록하기') }}
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
