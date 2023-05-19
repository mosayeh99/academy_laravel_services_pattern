@extends('layouts.master')
@section('title', 'Teachers')
@section('stylesheets')
@endsection

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        المستخدمين
                    </h2>
                </div>
                <div class="col-3 col-md-2 col-xl-1">
                    <a href="#" class="btn btn-outline-primary w-100" data-bs-toggle="modal"
                       data-bs-target="#modal-add-user">
                        اضافة
                    </a>
                </div>
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
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                        <li class="nav-item">
                            <a href="#tabs-students" class="nav-link active" data-bs-toggle="tab">الطلاب</a>
                        </li>
                        <li class="nav-item">
                            <a href="#tabs-teachers" class="nav-link" data-bs-toggle="tab">المعلمين</a>
                        </li>
                        <li class="nav-item">
                            <a href="#tabs-agencies" class="nav-link" data-bs-toggle="tab">المدربين</a>
                        </li>
                        <li class="nav-item">
                            <a href="#tabs-admins" class="nav-link" data-bs-toggle="tab">مسؤولوا النظام</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="tabs-students">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-vcenter card-table table-striped">
                                        <thead>
                                        <tr>
                                            <th class="w-1">#</th>
                                            <th>الاسم</th>
                                            <th>البريد الالكتروني</th>
                                            <th>تاريخ التسجيل</th>
                                            <th class="w-1">عمليات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $i=0; @endphp
                                        @foreach($students as $student)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $student->name }}</td>
                                                <td><a href="mailto:{{ $student->email }}" target="_blank"
                                                       class="text-reset">{{ $student->email }}</a></td>
                                                <td>{{ date_format($student->created_at, 'Y-m-d') }}</td>
                                                <td class="d-flex gap-3">
                                                    <a href="#" class="text-danger"
                                                       onclick="setDeletedUserValues('{{ $student->id }}', 'Student')"
                                                       title="حذف" data-bs-toggle="modal"
                                                       data-bs-target="#modal-delete-user">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             class="icon icon-tabler icon-tabler-trash" width="24"
                                                             height="24" viewBox="0 0 24 24" stroke-width="1"
                                                             stroke="currentColor" fill="none" stroke-linecap="round"
                                                             stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M4 7l16 0"></path>
                                                            <path d="M10 11l0 6"></path>
                                                            <path d="M14 11l0 6"></path>
                                                            <path
                                                                d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                        </svg>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-teachers">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-vcenter card-table table-striped">
                                        <thead>
                                        <tr>
                                            <th class="w-1">#</th>
                                            <th>الاسم</th>
                                            <th>البريد الالكتروني</th>
                                            <th>تاريخ التسجيل</th>
                                            <th class="w-1">عمليات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $i=0; @endphp
                                        @foreach($teachers as $teacher)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $teacher->name }}</td>
                                                <td><a href="mailto:{{ $teacher->email }}" target="_blank"
                                                       class="text-reset">{{ $teacher->email }}</a></td>
                                                <td>{{ date_format($teacher->created_at, 'Y-m-d') }}</td>
                                                <td class="d-flex gap-3">
                                                    <a href="#" class="text-primary"
                                                       onclick="setEditUserValues('{{ $teacher->id }}', '{{ $teacher->name }}', '{{ $teacher->email }}', 'Teacher')"
                                                       title="تعديل" data-bs-toggle="modal"
                                                       data-bs-target="#modal-edit-user">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             class="icon icon-tabler icon-tabler-edit" width="24"
                                                             height="24" viewBox="0 0 24 24" stroke-width="1"
                                                             stroke="currentColor" fill="none" stroke-linecap="round"
                                                             stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path
                                                                d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                            <path
                                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                            <path d="M16 5l3 3"></path>
                                                        </svg>
                                                    </a>
                                                    <a href="#" class="text-danger"
                                                       onclick="setDeletedUserValues('{{ $teacher->id }}', 'Teacher')"
                                                       title="حذف" data-bs-toggle="modal"
                                                       data-bs-target="#modal-delete-user">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             class="icon icon-tabler icon-tabler-trash" width="24"
                                                             height="24" viewBox="0 0 24 24" stroke-width="1"
                                                             stroke="currentColor" fill="none" stroke-linecap="round"
                                                             stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M4 7l16 0"></path>
                                                            <path d="M10 11l0 6"></path>
                                                            <path d="M14 11l0 6"></path>
                                                            <path
                                                                d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                        </svg>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-agencies">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-vcenter card-table table-striped">
                                        <thead>
                                        <tr>
                                            <th class="w-1">#</th>
                                            <th>الاسم</th>
                                            <th>البريد الالكتروني</th>
                                            <th>تاريخ التسجيل</th>
                                            <th class="w-1">عمليات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $i=0; @endphp
                                        @foreach($agencies as $agency)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $agency->name }}</td>
                                                <td><a href="mailto:{{ $agency->email }}" target="_blank"
                                                       class="text-reset">{{ $agency->email }}</a></td>
                                                <td>{{ date_format($agency->created_at, 'Y-m-d') }}</td>
                                                <td class="d-flex gap-3">
                                                    <a href="#" class="text-primary"
                                                       onclick="setEditUserValues('{{ $agency->id }}', '{{ $agency->name }}', '{{ $agency->email }}', 'TrainingAgency')"
                                                       title="تعديل" data-bs-toggle="modal"
                                                       data-bs-target="#modal-edit-user">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             class="icon icon-tabler icon-tabler-edit" width="24"
                                                             height="24" viewBox="0 0 24 24" stroke-width="1"
                                                             stroke="currentColor" fill="none" stroke-linecap="round"
                                                             stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path
                                                                d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                            <path
                                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                            <path d="M16 5l3 3"></path>
                                                        </svg>
                                                    </a>
                                                    <a href="#" class="text-danger"
                                                       onclick="setDeletedUserValues('{{ $agency->id }}', 'TrainingAgency')"
                                                       title="حذف" data-bs-toggle="modal"
                                                       data-bs-target="#modal-delete-user">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             class="icon icon-tabler icon-tabler-trash" width="24"
                                                             height="24" viewBox="0 0 24 24" stroke-width="1"
                                                             stroke="currentColor" fill="none" stroke-linecap="round"
                                                             stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M4 7l16 0"></path>
                                                            <path d="M10 11l0 6"></path>
                                                            <path d="M14 11l0 6"></path>
                                                            <path
                                                                d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                        </svg>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-admins">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-vcenter card-table table-striped">
                                        <thead>
                                        <tr>
                                            <th class="w-1">#</th>
                                            <th>الاسم</th>
                                            <th>البريد الالكتروني</th>
                                            <th>تاريخ التسجيل</th>
                                            <th class="w-1">عمليات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $i=0; @endphp
                                        @foreach($admins as $admin)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $admin->name }}</td>
                                                <td><a href="mailto:{{ $admin->email }}" target="_blank"
                                                       class="text-reset">{{ $admin->email }}</a></td>
                                                <td>{{ date_format($admin->created_at, 'Y-m-d') }}</td>
                                                <td class="d-flex gap-3">
                                                    <a href="#" class="text-primary"
                                                       onclick="setEditUserValues('{{ $admin->id }}', '{{ $admin->name }}', '{{ $admin->email }}', 'Admin')"
                                                       title="تعديل" data-bs-toggle="modal"
                                                       data-bs-target="#modal-edit-user">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             class="icon icon-tabler icon-tabler-edit" width="24"
                                                             height="24" viewBox="0 0 24 24" stroke-width="1"
                                                             stroke="currentColor" fill="none" stroke-linecap="round"
                                                             stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path
                                                                d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                            <path
                                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                            <path d="M16 5l3 3"></path>
                                                        </svg>
                                                    </a>
                                                    <a href="#" class="text-danger"
                                                       onclick="setDeletedUserValues('{{ $admin->id }}', 'Admin')"
                                                       title="حذف" data-bs-toggle="modal"
                                                       data-bs-target="#modal-delete-user">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             class="icon icon-tabler icon-tabler-trash" width="24"
                                                             height="24" viewBox="0 0 24 24" stroke-width="1"
                                                             stroke="currentColor" fill="none" stroke-linecap="round"
                                                             stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M4 7l16 0"></path>
                                                            <path d="M10 11l0 6"></path>
                                                            <path d="M14 11l0 6"></path>
                                                            <path
                                                                d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                        </svg>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add User -->
    <div class="modal modal-blur fade" id="modal-add-user" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">اضافة مستخدم جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('users.store') }}" method="post" autocomplete="off" novalidate>
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">الاسم</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">البريد الالكتروني</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">كلمة المرور</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">تأكيد كلمة المرور</label>
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                        <div class="mb-3">
                            <div class="form-label">حدد صلاحية المستخدم</div>
                            <div>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="role" value="Teacher">
                                    <span class="form-check-label">معلم</span>
                                </label>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="role" value="TrainingAgency">
                                    <span class="form-check-label">مدرب</span>
                                </label>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="role" value="Admin">
                                    <span class="form-check-label">ادمن</span>
                                </label>
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
    <!-- Modal Edit User -->
    <div class="modal modal-blur fade" id="modal-edit-user" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تعديل حساب مستخدم</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="users/update" method="post" autocomplete="off" novalidate>
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">الاسم</label>
                            <input type="text" class="form-control" name="name" id="edit_modal_user_name">
                        </div>
                        <input type="hidden" name="user_id" id="edit_modal_user_id">
                        <input type="hidden" name="role" id="edit_modal_user_role">
                        <div class="mb-3">
                            <label class="form-label">البريد الالكتروني</label>
                            <input type="email" class="form-control" name="email" id="edit_modal_user_email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">كلمة المرور</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">تأكيد كلمة المرور</label>
                            <input type="password" class="form-control" name="password_confirmation">
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
    <!-- Modal Delete User -->
    <div class="modal modal-blur fade" id="modal-delete-user" tabindex="-1" role="dialog" aria-hidden="true">
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
                    <h3>تأكيد حذف هذا المستخدم؟</h3>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col">
                                <a href="#" class="btn w-100" data-bs-dismiss="modal">
                                    الغاء
                                </a>
                            </div>
                            <div class="col">
                                <form action="users/destroy" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <input type="hidden" name="user_id" id="del_modal_user_id">
                                    <input type="hidden" name="role" id="del_modal_user_role">
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
        function setEditUserValues(userId, userName, userEmail, userRole) {
            document.getElementById('edit_modal_user_id').value = userId;
            document.getElementById('edit_modal_user_name').value = userName;
            document.getElementById('edit_modal_user_email').value = userEmail;
            document.getElementById('edit_modal_user_role').value = userRole;
        }

        function setDeletedUserValues(userId, userRole) {
            document.getElementById('del_modal_user_id').value = userId;
            document.getElementById('del_modal_user_role').value = userRole;
        }
    </script>
@endsection
