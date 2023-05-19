@extends('layouts.master')
@section('title', 'Home')
@section('stylesheets')
@endsection

@section('content')
    <div class="page-body my-auto">
        <div class="container-xl">
            <div class="row row-cards mt-0">
                @unlessrole('Teacher', 'teacher')
                <div class="col-md-6 col-xl-3">
                    <a class="card card-link" href="{{route('trainings.index')}}">
                        <div class="card-cover card-cover-blurred text-center bg-azure">
                            <span class="avatar avatar-xl avatar-thumb rounded bg-transparent" style="background-image: url({{asset('assets/static/widgets-icons/trainings.png')}})"></span>
                        </div>
                        <div class="card-body text-center">
                            <div class="card-title mb-1">التدريب التعاوني</div>
                        </div>
                    </a>
                </div>
                @endunlessrole

                @unlessrole('TrainingAgency', 'trainingAgency')
                <div class="col-md-6 col-xl-3">
                    <a class="card card-link" href="{{route('courses.index')}}">
                        <div class="card-cover card-cover-blurred text-center bg-cyan">
                            <span class="avatar avatar-xl avatar-thumb rounded bg-transparent" style="background-image: url({{asset('assets/static/widgets-icons/course.png')}})"></span>
                        </div>
                        <div class="card-body text-center">
                            <div class="card-title mb-1">الدورات التعليمية</div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-xl-3">
                    <a class="card card-link" href="{{route('classrooms.index')}}">
                        <div class="card-cover card-cover-blurred text-center bg-info">
                            <span class="avatar avatar-xl avatar-thumb rounded bg-transparent" style="background-image: url({{asset('assets/static/widgets-icons/webinar.png')}})"></span>
                        </div>
                        <div class="card-body text-center">
                            <div class="card-title mb-1">فصول دراسية افتراضية</div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-xl-3">
                    <a class="card card-link" href="{{route('articles.index')}}">
                        <div class="card-cover card-cover-blurred text-center bg-vimeo">
                            <span class="avatar avatar-xl avatar-thumb rounded bg-transparent" style="background-image: url({{asset('assets/static/widgets-icons/articles.png')}})"></span>
                        </div>
                        <div class="card-body text-center">
                            <div class="card-title mb-1">المقالات</div>
                        </div>
                    </a>
                </div>
                @endunlessrole

                @role('Admin', 'admin')
                <div class="col-md-6 col-xl-3">
                    <a class="card card-link" href="{{route('users.index')}}">
                        <div class="card-cover card-cover-blurred text-center bg-dribbble">
                            <span class="avatar avatar-xl avatar-thumb rounded bg-transparent" style="background-image: url({{asset('assets/static/widgets-icons/users.png')}})"></span>
                        </div>
                        <div class="card-body text-center">
                            <div class="card-title mb-1">المستخدمين</div>
                        </div>
                    </a>
                </div>
                @endrole
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
