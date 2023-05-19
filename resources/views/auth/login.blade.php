@extends('layouts.main')
@section('title', 'Login')

@section('content')
    <div class="text-center mb-4">
        <a href="/" class="navbar-brand navbar-brand-autodark"><img src="{{asset('assets/static/logo.svg')}}" height="36" alt=""></a>
    </div>
    <div class="card card-md">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">
                @if($type === 'teacher')
                    تسجيل دخول معلم
                @elseif($type === 'student')
                    تسجيل دخول طالب
                @elseif($type === 'agency')
                    تسجيل دخول مدربين
                @else
                    تسجيل دخول ادمن
                @endif
            </h2>
            <form action="{{route('login', '')}}" method="post" autocomplete="off" novalidate>
                @csrf
                <div class="mb-3">
                    <label class="form-label">البريد الالكتروني</label>
                    @if($type === 'student')
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="student@gmail.com">
                    @elseif($type === 'teacher')
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="teacher@gmail.com">
                    @elseif($type === 'agency')
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="agency@gmail.com">
                    @else
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                    @endif
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <input type="hidden" name="type" value="{{$type}}">
                <div class="mb-2">
                    <label class="form-label">كلمة المرور</label>
                    @if($type === 'admin')
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                    @else
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="123456789">
                    @endif
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-2">
                    <label class="form-check">
                        <input type="checkbox" name="remember" class="form-check-input"/>
                        <span class="form-check-label">تذكرني</span>
                    </label>
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">دخول</button>
                </div>
            </form>
        </div>
    </div>
    <div class="text-center text-muted mt-3">
        ليس لديك حساب؟  <a href="{{route('register')}}" tabindex="-1">اشترك</a>
    </div>
@endsection
