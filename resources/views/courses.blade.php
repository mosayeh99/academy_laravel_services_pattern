@extends('layouts.master')
@section('title', 'Courses')
@section('stylesheets')
@endsection

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        الدورات التعليمية
                    </h2>
                </div>
                @permission('add courses')
                <div class="col-3 col-md-2 col-xl-1">
                    <a href="#" class="btn btn-outline-primary w-100" data-bs-toggle="modal"
                       data-bs-target="#modal-add-course">
                        اضافة
                    </a>
                </div>
                @endpermission
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row row-cards">
                @if($courses->count())
                    @foreach($courses as $course)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card">
                                <!-- Photo -->
                                <div class="img-responsive img-responsive-21x9 card-img-top"
                                     style="background-image: url({{asset("/storage/courses/$course->id/$course->thumbnail")}})"></div>
                                <div class="card-body">
                                    <h3 class="card-title mb-1 fw-bold">
                                        <a href="{{ route('videos.index', $course->id) }}"
                                           class="text-reset">{{ $course->name }}</a>
                                    </h3>
                                </div>
                                @permission('update courses', 'delete courses')
                                <div class="card-footer">
                                    <div class="row g-1 gap-5">
                                        @permission('update courses')
                                        <a href="#" class="col btn btn-outline-primary"
                                           onclick="setEditCourseInfo('{{ $course->id }}', '{{ $course->name }}')"
                                           data-bs-toggle="modal" data-bs-target="#modal-edit-course">تعديل</a>
                                        @endpermission

                                        @permission('delete courses')
                                        <a href="#" class="col btn btn-outline-danger"
                                           onclick="setDeletedCourseId('{{ $course->id }}')" data-bs-toggle="modal"
                                           data-bs-target="#modal-danger">حذف</a>
                                        @endpermission
                                    </div>
                                </div>
                                @endpermission
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-muted fs-2 text-center mt-5">
                        ليس لديك اي دورات لعرضها.
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Add Course -->
    <div class="modal modal-blur fade" id="modal-add-course" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">اضافة دورة تعليمية جديدة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('courses.store') }}" method="post" autocomplete="off" novalidate
                      enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">الاسم</label>
                            <input type="text" class="form-control" name="name" placeholder="اسم الدورة التعليمية">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">اضف صورة مصغرة</label>
                            <div class="position-relative">
                                <button class="btn p-4 text-muted w-100">اضغط لاضافة صوره</button>
                                <input type="file" name="file"
                                       class="form-control opacity-0 p-4 position-absolute top-0">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            الغاء
                        </a>
                        <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 5l0 14"/>
                                <path d="M5 12l14 0"/>
                            </svg>
                            اضافة
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Edit Course -->
    <div class="modal modal-blur fade" id="modal-edit-course" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تعديل الدورة التعليمية</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="courses/update" method="post" autocomplete="off" novalidate enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">تعديل الاسم</label>
                            <input type="text" id="edit_modal_course_name" class="form-control" name="name"
                                   placeholder="اسم الدورة التعليمية">
                        </div>
                        <input type="hidden" name="course_id" id="edit_modal_course_id">
                        <div class="mb-3">
                            <label class="form-label">تعديل الصورة المصغرة</label>
                            <div class="position-relative">
                                <button class="btn p-4 text-muted w-100">اضغط لاضافة صوره</button>
                                <input type="file" name="file"
                                       class="form-control opacity-0 p-4 position-absolute top-0">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            الغاء
                        </a>
                        <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                            تعديل
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Delete Course -->
    <div class="modal modal-blur fade" id="modal-danger" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-danger"></div>
                <div class="modal-body text-center py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 mx-auto text-danger icon-lg" width="24"
                         height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12 9v2m0 4v.01"/>
                        <path
                            d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75"/>
                    </svg>
                    <h3>تأكيد حذف هذه الدورة؟</h3>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                    الغاء
                                </a></div>
                            <div class="col">
                                <form action="courses/destroy" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <input type="hidden" name="course_id" id="del_modal_course_id">
                                    <button type="submit" class="btn btn-danger w-100" data-bs-dismiss="modal">حذف
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function setEditCourseInfo(courseId, courseName) {
            document.getElementById('edit_modal_course_id').value = courseId;
            document.getElementById('edit_modal_course_name').value = courseName;
        }

        function setDeletedCourseId(courseId) {
            document.getElementById('del_modal_course_id').value = courseId;
        }
    </script>
@endsection
