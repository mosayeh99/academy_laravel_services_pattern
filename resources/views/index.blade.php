<!Doctype html>
<html lang="ar" dir="rtl" >
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>S Academy</title>
    <!-- CSS files -->
    <base href="/">
    <link rel="shortcut icon" href="{{asset('assets/static/favicon.png')}}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900;1000&display=swap" rel="stylesheet">
    <link href="{{asset('assets/dist/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/dist/css/demo.min.css')}}" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            overflow-y: auto;
        }
        .text-header {
            font-size: 3rem;
        }
        @media (max-width:990px) {
            .text-header {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
<div class="page">
    <div class="page-wrapper">
        <!-- Header -->
        <header class="navbar navbar-expand-md navbar-light sticky-top d-print-none">
            <div class="container-xl justify-content-center justify-content-md-between">
                <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                    <a href="/">
                        <img src="{{asset('assets/static/logo.svg')}}" width="110" height="32" alt="Tabler" class="navbar-brand-image">
                    </a>
                </h1>
                <div class="d-none d-md-flex gap-3 justify-content-end">
                        <a href="{{ route('selection') }}" class="btn btn-ghost-primary">دخول</a>
                        <a href="{{ route('register') }}" class="btn btn-ghost-primary">تسجيل</a>
                    </div>
            </div>
        </header>

        <!-- Page body -->
        <div class="page-body my-0">
            <section class="py-5">
            <div class="container-xl">
                <div class="flex-column-reverse flex-lg-row row align-items-center mx-3 mx-lg-0">
                    <div class="col-12 col-lg mt-lg-0 mt-4">
                        <h2 class="fw-bolder mb-4 lh-lg text-header text-center text-lg-start">ابدأ رحلة التعلم<br>واكتسب مهارات جديدة</h2>
                        <div class="d-flex gap-3 justify-content-center justify-content-lg-start">
                            <a href="{{ route('selection') }}" class="col-4 col-md-2 btn btn-outline-primary">دخول</a>
                            <a href="{{ route('register') }}" class="col-4 col-md-2 btn btn-primary">تسجيل</a>
                        </div>
                    </div>
                    <div class="col-12 col-lg">
                        <img src="{{ asset('assets/static/index/head.png') }}">
                    </div>
                </div>
            </div>
            </section>
            <section class="bg-white py-5">
                <div class="container-xl">
                    <h2 class="text-center fw-bolder fs-1 lh-base">
                        استكشف افضل الدورات <br>
                        في جميع المجالات
                    </h2>
                    <div class="row row-cards mt-4  mx-3 mx-lg-0">
                        <div class="col-md-6 col-lg-3">
                            <div class="card card-link card-link-pop">
                                <div class="card-body d-flex flex-column align-items-center gap-3">
                                    <img class="w-33" src="{{ asset('assets/static/index/category_web_design.png') }}">
                                    <h3>تطوير مواقع الويب</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="card card-link card-link-pop">
                                <div class="card-body d-flex flex-column align-items-center gap-3">
                                    <img class="w-33" src="{{ asset('assets/static/index/category_graphic_design.png') }}">
                                    <h3>تصميم الجرافيك</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="card card-link card-link-pop">
                                <div class="card-body d-flex flex-column align-items-center gap-3">
                                    <img class="w-33" src="{{ asset('assets/static/index/category_personal_development.png') }}">
                                    <h3>تطوير الذات</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="card card-link card-link-pop">
                                <div class="card-body d-flex flex-column align-items-center gap-3">
                                    <img class="w-33" src="{{ asset('assets/static/index/category_it.png') }}">
                                    <h3>تكنولوجيا المعلومات</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="card card-link card-link-pop">
                                <div class="card-body d-flex flex-column align-items-center gap-3">
                                    <img class="w-33" src="{{ asset('assets/static/index/category_sales_marketing.png') }}">
                                    <h3>تسويق المبيعات</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="card card-link card-link-pop">
                                <div class="card-body d-flex flex-column align-items-center gap-3">
                                    <img class="w-33" src="{{ asset('assets/static/index/category_art.png') }}">
                                    <h3>الفنون والعلوم الانسانية</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="card card-link card-link-pop">
                                <div class="card-body d-flex flex-column align-items-center gap-3">
                                    <img class="w-33" src="{{ asset('assets/static/index/category_mobile_app.png') }}">
                                    <h3>تطوير تطبيقات الهاتف</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="card card-link card-link-pop">
                                <div class="card-body d-flex flex-column align-items-center gap-3">
                                    <img class="w-33" src="{{ asset('assets/static/index/category_finance_accounting.png') }}">
                                    <h3>الموارد المالية والمحاسبة</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="py-5">
                <div class="container-xl">
                    <div class="flex-column-reverse flex-lg-row row align-items-center mx-3 mx-lg-0">
                        <div class="col-12 col-lg mt-lg-0 mt-4">
                            <h2 class="fw-bolder mb-2 fs-1">نخبة من افضل المعلمين</h2>
                            <p class="text-muted fs-2">اكساب الطلبة مهارات التفكير المنطقي واكتشاف المعارف والمفاهيم وتقديم التغذية الراجعة لهم وإرشادهم أثناء عملية التعلم وتحفيزهم و إثارة دافعيتهم عن طريق التنويع في الأنشطة المقدمة لهم.</p>
                        </div>
                        <div class="col-12 col-lg d-flex justify-content-center justify-content-lg-end">
                            <img src="{{ asset('assets/static/index/teachers.png') }}">
                        </div>
                    </div>
                </div>
            </section>
            <section class="bg-white py-5">
                <div class="container-xl">
                    <div class="row align-items-center mx-3 mx-lg-0">
                        <div class="col-12 col-lg d-flex justify-content-center justify-content-lg-start">
                            <img src="{{ asset('assets/static/index/customer_service.png') }}">
                        </div>
                        <div class="col-12 col-lg mt-lg-0 mt-4">
                            <h2 class="fw-bolder mb-2 fs-1">خدمة عملاء على مدار اليوم</h2>
                            <p class="text-muted fs-2">خدمة عملاء تعمل 24/7 للرد على كافة استفساراتك وحل جميع المشكلات التي قد تواجهك.</p>
                            <div class="d-flex gap-3">
                                <a href="https://facebook.com" class="text-muted" target="_blank" title="تابعنا على فيسبوك">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-facebook" width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                       <path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3"></path>
                                    </svg>
                                </a>
                                <a href="https://instagram.com" class="text-muted" target="_blank" title="تابعنا على انستجرام">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-instagram" width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                       <path d="M4 4m0 4a4 4 0 0 1 4 -4h8a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z"></path>
                                       <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                       <path d="M16.5 7.5l0 .01"></path>
                                    </svg>
                                </a>
                                <a href="https://twitter.com" class="text-muted" target="_blank" title="تابعنا على تويتر">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-twitter" width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                       <path d="M22 4.01c-1 .49 -1.98 .689 -3 .99c-1.121 -1.265 -2.783 -1.335 -4.38 -.737s-2.643 2.06 -2.62 3.737v1c-3.245 .083 -6.135 -1.395 -8 -4c0 0 -4.182 7.433 4 11c-1.872 1.247 -3.739 2.088 -6 2c3.308 1.803 6.913 2.423 10.034 1.517c3.58 -1.04 6.522 -3.723 7.651 -7.742a13.84 13.84 0 0 0 .497 -3.753c0 -.249 1.51 -2.772 1.818 -4.013z"></path>
                                    </svg>
                                </a>
                                <a href="https://youtube.com" class="text-muted" target="_blank" title="تابعنا على يوتيوب">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-youtube" width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                       <path d="M3 5m0 4a4 4 0 0 1 4 -4h10a4 4 0 0 1 4 4v6a4 4 0 0 1 -4 4h-10a4 4 0 0 1 -4 -4z"></path>
                                       <path d="M10 9l5 3l-5 3z"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@include('layouts.footer')
</body>
</html>
