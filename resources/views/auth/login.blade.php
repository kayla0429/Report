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
                    <h1 class="h4 text-gray-900 mb-4">로그인</h1>
                  </div>
                  <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <input name="email" value="{{ old('email') }}" type="email" class="form-control form-control-user" id="exampleInputEmail" required autocomplete="email" autofocus placeholder="이메일">
                        @error('email')
                        <span class="text-danger">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <input name="password" type="password" class="form-control form-control-user" id="exampleInputPassword" required autocomplete="current-password" placeholder="비밀번호">
                      @error('password')
                      <span class="text-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    </div>
                    <div class="form-group">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                          {{ __('기억하기') }}
                        </label>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        {{ __('로그인') }}
                    </button>
                    <hr>
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
