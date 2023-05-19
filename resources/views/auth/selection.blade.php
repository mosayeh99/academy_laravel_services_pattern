@extends('layouts.main')
@section('title', 'Login')

@section('content')
    <div class="text-center mb-4">
        <a href="/" class="navbar-brand navbar-brand-autodark"><img src="{{asset('assets/static/logo.svg')}}" height="36" alt=""></a>
    </div>
    <div class="card card-md rounded-3">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">حدد طريقة الدخول</h2>
            <div class="row ">
                <div class="col" role="button" title="طالب">
                    <a href="{{route('login', 'student')}}">
                        <img src="{{asset('assets/static/selection-users-icons/student.png')}}">
                    </a>
                </div>
                <div class="col" role="button" title="معلم">
                    <a href="{{route('login', 'teacher')}}">
                        <img src="{{asset('assets/static/selection-users-icons/teacher.png')}}">
                    </a>
                </div>
                <div class="col" role="button" title="مدربين">
                    <a href="{{route('login', 'agency')}}">
                        <img src="{{asset('assets/static/selection-users-icons/agency.png')}}">
                    </a>
                </div>
                <div class="col" role="button" title="ادمن">
                    <a href="{{route('login', 'admin')}}">
                        <img src="{{asset('assets/static/selection-users-icons/admin.png')}}">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center text-muted mt-3">
        ليس لديك حساب؟  <a href="{{route('register')}}" tabindex="-1">اشترك</a>
    </div>
@endsection

