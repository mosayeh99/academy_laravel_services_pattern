@extends('layouts.master')
@section('title', 'Virtual Classrooms')
@section('stylesheets')
@endsection

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        الفصول الافتراضية
                    </h2>
                </div>
                @permission('add classrooms')
                <div class="col-3 col-md-2 col-xl-1">
                    <a href="#" class="btn btn-outline-primary w-100" data-bs-toggle="modal"
                       data-bs-target="#modal-add-classroom">
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
            @if($classrooms->count())
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="table-responsive">
                                <table
                                    class="table table-vcenter card-table table-striped">
                                    <thead>
                                    <tr>
                                        <th>اسم الفصل</th>
                                        <th>المعلم</th>
                                        <th>تاريخ البدأ</th>
                                        <th>رابط الدخول</th>
                                        @permission('update classrooms', 'delete classrooms')
                                        <th class="w-1">خيارات</th>
                                        @endpermission
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($classrooms as $classroom)
                                        <tr>
                                            <td>{{ $classroom->name }}</td>
                                            <td class="text-muted">{{ $classroom->classroomable->name }}</td>
                                            <td class="text-muted text-right"
                                                style="direction: ltr">{{ date('Y-m-d h:i A', strtotime($classroom->meeting_time)) }}</td>
                                            <td class="text-muted"><a href="{{ $classroom->meeting_link }}"
                                                                      target="_blank">دخول</a></td>
                                            @permission('update classrooms', 'delete classrooms')
                                            <td>
                                                <div class="d-flex gap-2">
                                                    @permission('update classrooms')
                                                    <a href="#" class="link-primary w-100"
                                                       onclick="setEditClassroomValues('{{ $classroom->id }}', '{{ $classroom->name }}', '{{ $classroom->meeting_time }}', '{{ $classroom->meeting_link }}')"
                                                       data-bs-toggle="modal" data-bs-target="#modal-edit-classroom">
                                                        تعديل
                                                    </a>
                                                    @endpermission

                                                    @permission('delete classrooms')
                                                    <a href="#" class="link-danger w-100"
                                                       onclick="setDeletedClassroomId('{{ $classroom->id }}')"
                                                       data-bs-toggle="modal" data-bs-target="#modal-danger">
                                                        حذف
                                                    </a>
                                                    @endpermission
                                                </div>
                                            </td>
                                            @endpermission
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center mt-5 text-muted fs-3">لا توجد اي فصول لعرضها</div>
            @endif
        </div>
    </div>

    <!-- Modal Add Classroom -->
    <div class="modal modal-blur fade" id="modal-add-classroom" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">اضافة فصل جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('classrooms.store') }}" method="post" autocomplete="off" novalidate
                      enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">الاسم</label>
                            <input type="text" class="form-control" name="name" placeholder="اسم الفصل">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">تاريخ بدأ الفصل</label>
                            <input type="datetime-local" class="form-control" name="meeting_time">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">رابط دخول الفصل</label>
                            <input type="text" class="form-control" name="meeting_link"
                                   placeholder="رابط دخول الميتينج">
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
    <!-- Modal Edit Classroom -->
    <div class="modal modal-blur fade" id="modal-edit-classroom" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تعديل الفصل</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="classrooms/update" method="post" autocomplete="off" novalidate
                      enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">الاسم</label>
                            <input type="text" class="form-control" id="edit_modal_classroom_name" name="name"
                                   placeholder="اسم الفصل">
                        </div>
                        <input type="hidden" name="classroom_id" id="edit_modal_classroom_id">
                        <div class="mb-3">
                            <label class="form-label">تاريخ الفصل</label>
                            <input type="datetime-local" class="form-control" id="edit_modal_meeting_time"
                                   name="meeting_time">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">رابط دخول الفصل</label>
                            <input type="text" class="form-control" id="edit_modal_meeting_link" name="meeting_link"
                                   placeholder="رابط دخول الميتينج">
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
                    <h3>تأكيد حذف هذا الفصل؟</h3>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                    الغاء
                                </a></div>
                            <div class="col">
                                <form action="classrooms/destroy" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <input type="hidden" name="classroom_id" id="del_modal_classroom_id">
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
        function setEditClassroomValues(classId, className, meetingTime, meetingLink) {
            document.getElementById('edit_modal_classroom_id').value = classId;
            document.getElementById('edit_modal_classroom_name').value = className;
            document.getElementById('edit_modal_meeting_time').value = meetingTime;
            document.getElementById('edit_modal_meeting_link').value = meetingLink;
        }

        function setDeletedClassroomId(classId) {
            document.getElementById('del_modal_classroom_id').value = classId;
        }
    </script>
@endsection

