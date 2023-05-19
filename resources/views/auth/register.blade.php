@extends('layouts.main')
@section('title', 'Login')

@section('content')
    <div class="text-center mb-4">
        <a href="/" class="navbar-brand navbar-brand-autodark"><img src="{{asset('assets/static/logo.svg')}}" height="36" alt=""></a>
    </div>
    <form class="card card-md" action="{{route('register')}}" method="post" autocomplete="off" novalidate>
        @csrf
        <div class="card-body">
            <h2 class="card-title text-center mb-4">انشاء حساب طالب جديد</h2>
            <div class="mb-3">
                <label class="form-label">الاسم</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">البريد الالكتروني</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"  value="{{old('email')}}">
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">كلمة المرور</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" autocomplete="off">
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">تأكيد كلمة المرور</label>
                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" autocomplete="off">
                @error('password_confirmation')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">تسجيل</button>
            </div>
        </div>
    </form>
    <div class="text-center text-muted mt-3">
        مسجل بالفعل؟  <a href="{{route('selection')}}" tabindex="-1">دخول</a>
    </div>
@endsection
