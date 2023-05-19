@extends('layouts.master')
@section('title', 'Trainings')
@section('stylesheets')
@endsection

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        التدريب التعاوني
                    </h2>
                </div>
                @permission('add trainings')
                <div class="col-3 col-md-2 col-xl-1">
                    <a href="#" class="btn btn-outline-primary w-100" data-bs-toggle="modal"
                       data-bs-target="#modal-add-training">
                        اضافة تدريب
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
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                        <li class="nav-item">
                            <a href="#tabs-trainings" class="nav-link active" data-bs-toggle="tab">التدريبات</a>
                        </li>

                        @role('Student', 'student')
                        <li class="nav-item">
                            <a href="#tabs-my-trainings" class="nav-link" data-bs-toggle="tab">حالة التقديم</a>
                        </li>
                        @endrole

                        @permission('list letters')
                        <li class="nav-item">
                            <a href="#tabs-applying-requests" class="nav-link" data-bs-toggle="tab">طلبات الالتحاق</a>
                        </li>
                        @endpermission
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="tabs-trainings">
                            <div id="faq-1" class="accordion" role="tablist" aria-multiselectable="true">
                                @if($trainings->count())
                                    <div class="row">
                                        @foreach($trainings as $training)
                                            <div class="col-md-6 col-lg-3">
                                                <div class="card card-stacked">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <h3 class="card-title">{{ $training->name }}</h3>
                                                            @permission('update trainings', 'delete trainings')
                                                            <div class="dropdown">
                                                                <a href="#" class="btn-action" data-bs-toggle="dropdown"
                                                                   aria-expanded="true">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                         class="icon icon-tabler icon-tabler-dots"
                                                                         width="24" height="24" viewBox="0 0 24 24"
                                                                         stroke-width="1" stroke="currentColor"
                                                                         fill="none" stroke-linecap="round"
                                                                         stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                              fill="none"></path>
                                                                        <path
                                                                            d="M5 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                                                        <path
                                                                            d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                                                        <path
                                                                            d="M19 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                                                    </svg>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-end"
                                                                     data-popper-placement="bottom-end"
                                                                     style="position: absolute; inset: 0 0 auto auto; margin: 0; transform: translate3d(0px, 34.4px, 0px);">
                                                                    @permission('update trainings')
                                                                    <a href="#" class="dropdown-item"
                                                                       onclick="setEditTrainingValues('{{ $training->id }}', '{{ $training->name }}', '{{ $training->description }}', '{{ $training->time }}')"
                                                                       data-bs-toggle="modal"
                                                                       data-bs-target="#modal-edit-training">تعديل</a>
                                                                    @endpermission

                                                                    @permission('delete trainings')
                                                                    <a href="#" class="dropdown-item text-danger"
                                                                       onclick="setDeletedTrainingId('{{ $training->id }}')"
                                                                       data-bs-toggle="modal"
                                                                       data-bs-target="#modal-delete-training">حذف</a>
                                                                    @endpermission
                                                                </div>
                                                            </div>
                                                            @endpermission
                                                        </div>
                                                        <p class="text-muted">{{ $training->description }}</p>
                                                    </div>
                                                    @role('Student', 'student')
                                                    <div class="card-footer">
                                                        <a href="#" class="btn btn-primary"
                                                           onclick="setApplyTrainingValues('{{ $training->name }}', '{{ $training->id }}')"
                                                           data-bs-toggle="modal"
                                                           data-bs-target="#modal-apply-training">التقديم للتدريب</a>
                                                    </div>
                                                    @endrole
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-muted text-center fs-3 my-5">لا توجد تدريبات جديدة لعرضها.</div>
                                @endif
                            </div>
                        </div>

                        @role('Student', 'student')
                        <div class="tab-pane" id="tabs-my-trainings">
                            <div id="faq-1" class="accordion" role="tablist" aria-multiselectable="true">
                                @if($letters->count())
                                    <div class="row row-cards">
                                        @foreach($letters as $letter)
                                            @if($letter->status)
                                                <div class="col-md-6 col-lg-3">
                                                    <div class="card bg-success-lt">
                                                        <div class="card-body">
                                                            <div class="d-flex justify-content-between">
                                                                <h3 class="card-title d-flex align-items-center gap-1">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                         class="icon icon-tabler icon-tabler-circle-check"
                                                                         width="24" height="24" viewBox="0 0 24 24"
                                                                         stroke-width="1" stroke="currentColor"
                                                                         fill="none" stroke-linecap="round"
                                                                         stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                              fill="none"></path>
                                                                        <path
                                                                            d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                                                        <path d="M9 12l2 2l4 -4"></path>
                                                                    </svg>
                                                                    طلب مقبول
                                                                </h3>
                                                                <a href="#" class="text-muted"
                                                                   onclick="setDeletedLetterId('{{ $letter->id }}')"
                                                                   role="button" title="حذف الطلب"
                                                                   data-bs-toggle="modal"
                                                                   data-bs-target="#modal-delete-letter">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                         class="icon icon-tabler icon-tabler-trash"
                                                                         width="24" height="24" viewBox="0 0 24 24"
                                                                         stroke-width="1" stroke="currentColor"
                                                                         fill="none" stroke-linecap="round"
                                                                         stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                              fill="none"></path>
                                                                        <path d="M4 7l16 0"></path>
                                                                        <path d="M10 11l0 6"></path>
                                                                        <path d="M14 11l0 6"></path>
                                                                        <path
                                                                            d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                                        <path
                                                                            d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                                    </svg>
                                                                </a>
                                                            </div>
                                                            <p class="text-muted">
                                                                تم قبول طلب الالتحاق المقدم لدى
                                                                <span
                                                                    class="text-dark">{{ $letter->training->name }}</span>
                                                                على ان يبدأ التدريب يوم
                                                                {{ \Carbon\Carbon::parse($letter->training->time)->translatedFormat('l \الموافق j F Y \الساعة h A') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($letter->status === null)
                                                <div class="col-md-6 col-lg-3">
                                                    <div class="card bg-warning-lt">
                                                        <div class="card-body">
                                                            <div class="d-flex justify-content-between">
                                                                <h3 class="card-title d-flex align-items-center gap-1">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                         class="icon icon-tabler icon-tabler-alert-circle"
                                                                         width="24" height="24" viewBox="0 0 24 24"
                                                                         stroke-width="1" stroke="currentColor"
                                                                         fill="none" stroke-linecap="round"
                                                                         stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                              fill="none"></path>
                                                                        <path
                                                                            d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                                                        <path d="M12 8v4"></path>
                                                                        <path d="M12 16h.01"></path>
                                                                    </svg>
                                                                    طلب تحت المراجعة
                                                                </h3>
                                                                <a href="#" class="text-muted"
                                                                   onclick="setDeletedLetterId('{{ $letter->id }}')"
                                                                   role="button" title="حذف الطلب"
                                                                   data-bs-toggle="modal"
                                                                   data-bs-target="#modal-delete-letter">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                         class="icon icon-tabler icon-tabler-trash"
                                                                         width="24" height="24" viewBox="0 0 24 24"
                                                                         stroke-width="1" stroke="currentColor"
                                                                         fill="none" stroke-linecap="round"
                                                                         stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                              fill="none"></path>
                                                                        <path d="M4 7l16 0"></path>
                                                                        <path d="M10 11l0 6"></path>
                                                                        <path d="M14 11l0 6"></path>
                                                                        <path
                                                                            d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                                        <path
                                                                            d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                                    </svg>
                                                                </a>
                                                            </div>
                                                            <p class="text-muted">
                                                                جاري مراجعة طلب الالتحاق المقدم لدى
                                                                <span
                                                                    class="text-dark">{{ $letter->training->name }}</span>
                                                                وقد تستغرق عملية المراجعة من 24 : 48 ساعة
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-md-6 col-lg-3">
                                                    <div class="card bg-danger-lt">
                                                        <div class="card-body">
                                                            <div class="d-flex justify-content-between">
                                                                <h3 class="card-title d-flex align-items-center gap-1">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                         class="icon icon-tabler icon-tabler-circle-x"
                                                                         width="24" height="24" viewBox="0 0 24 24"
                                                                         stroke-width="1" stroke="currentColor"
                                                                         fill="none" stroke-linecap="round"
                                                                         stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                              fill="none"></path>
                                                                        <path
                                                                            d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                                                        <path d="M10 10l4 4m0 -4l-4 4"></path>
                                                                    </svg>
                                                                    طلب غير مقبول
                                                                </h3>
                                                                <a href="#" class="text-muted"
                                                                   onclick="setDeletedLetterId('{{ $letter->id }}')"
                                                                   role="button" title="حذف الطلب"
                                                                   data-bs-toggle="modal"
                                                                   data-bs-target="#modal-delete-letter">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                         class="icon icon-tabler icon-tabler-trash"
                                                                         width="24" height="24" viewBox="0 0 24 24"
                                                                         stroke-width="1" stroke="currentColor"
                                                                         fill="none" stroke-linecap="round"
                                                                         stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                              fill="none"></path>
                                                                        <path d="M4 7l16 0"></path>
                                                                        <path d="M10 11l0 6"></path>
                                                                        <path d="M14 11l0 6"></path>
                                                                        <path
                                                                            d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                                        <path
                                                                            d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                                    </svg>
                                                                </a>
                                                            </div>
                                                            <p class="text-muted">
                                                                نأسف لعدم قبول طلب الالتحاق المقدم لدى
                                                                <span
                                                                    class="text-dark">{{ $letter->training->name }}</span>
                                                                ونتمنى لكم التوفيق في الدورات القادمة.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-muted text-center fs-3 my-5">ليس لديك طلبات التحاق لعرضها.</div>
                                @endif
                            </div>
                        </div>
                        @endrole

                        @permission('list letters')
                        <div class="tab-pane" id="tabs-applying-requests">
                            <div id="faq-1" class="accordion" role="tablist" aria-multiselectable="true">
                                @if($letters->count())
                                    <div class="card">
                                        <div class="table-responsive">
                                            <table class="table table-vcenter card-table table-striped">
                                                <thead>
                                                <tr>
                                                    <th class="w-1">#</th>
                                                    <th>اسم الطالب</th>
                                                    <th>التدريب</th>
                                                    <th>عن الطالب</th>
                                                    @role('Admin', 'admin')
                                                    <th>حالة الطلب</th>
                                                    @endrole
                                                    <th class="w-1">خيارات</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($letters as $letter)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $letter->letterable->name }}</td>
                                                        <td class="text-muted">{{ $letter->training->name }}</td>
                                                        <td class="text-muted">{{ $letter->body }}</td>
                                                        @role('Admin', 'admin')
                                                        <td>
                                                            @if($letter->status)
                                                                <span class="badge bg-green-lt">مقبول</span>
                                                            @elseif($letter->status === null)
                                                                <span class="badge bg-orange-lt">جاري المراجعة</span>
                                                            @else
                                                                <span class="badge bg-red-lt">مرفوض</span>
                                                            @endif
                                                        </td>
                                                        @endrole
                                                        <td class="d-flex gap-3">
                                                            @if($letter->status === null)
                                                                <a href="#" class="text-success"
                                                                   onclick="setAcceptLetterId('{{ $letter->id }}')"
                                                                   title="قبول الطلب" data-bs-toggle="modal"
                                                                   data-bs-target="#modal-accept-letter">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                         class="icon icon-tabler icon-tabler-check"
                                                                         width="24" height="24" viewBox="0 0 24 24"
                                                                         stroke-width="2" stroke="currentColor"
                                                                         fill="none" stroke-linecap="round"
                                                                         stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                              fill="none"></path>
                                                                        <path d="M5 12l5 5l10 -10"></path>
                                                                    </svg>
                                                                </a>
                                                                <a href="#" class="text-danger"
                                                                   onclick="setRefuseLetterId('{{ $letter->id }}')"
                                                                   title="رفض الطلب" data-bs-toggle="modal"
                                                                   data-bs-target="#modal-refuse-letter">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                         class="icon icon-tabler icon-tabler-x"
                                                                         width="24" height="24" viewBox="0 0 24 24"
                                                                         stroke-width="1" stroke="currentColor"
                                                                         fill="none" stroke-linecap="round"
                                                                         stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                              fill="none"></path>
                                                                        <path d="M18 6l-12 12"></path>
                                                                        <path d="M6 6l12 12"></path>
                                                                    </svg>
                                                                </a>
                                                            @endif
                                                            <a href="#" class="text-danger"
                                                               onclick="setDeletedLetterId('{{ $letter->id }}')"
                                                               role="button" title="حذف الطلب" data-bs-toggle="modal"
                                                               data-bs-target="#modal-delete-letter">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                     class="icon icon-tabler icon-tabler-trash"
                                                                     width="24" height="24" viewBox="0 0 24 24"
                                                                     stroke-width="1" stroke="currentColor" fill="none"
                                                                     stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z"
                                                                          fill="none"></path>
                                                                    <path d="M4 7l16 0"></path>
                                                                    <path d="M10 11l0 6"></path>
                                                                    <path d="M14 11l0 6"></path>
                                                                    <path
                                                                        d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                                    <path
                                                                        d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                                </svg>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @else
                                    <div class="text-muted text-center fs-3 my-5">لا توجد طلبات التحاق جديدة</div>
                                @endif
                            </div>
                        </div>
                        @endpermission
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add Training -->
    <div class="modal modal-blur fade" id="modal-add-training" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">اضافة تدريب جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('trainings.store') }}" method="post" autocomplete="off" novalidate>
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">عنوان التدريب</label>
                            <input type="text" class="form-control" name="name" placeholder="اضف عنوان للتدريب">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">تاريخ بدأ التدريب</label>
                            <input type="datetime-local" class="form-control" name="time">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">عن التدريب</label>
                            <textarea class="form-control" name="description" rows="3"
                                      placeholder="اضف شرح للتدريب"></textarea>
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
    <!-- Modal Edit Training -->
    <div class="modal modal-blur fade" id="modal-edit-training" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تعديل تدريب</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="trainings/update" method="post" autocomplete="off" novalidate>
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">عنوان التدريب</label>
                            <input type="text" class="form-control" id="edit_modal_training_name" name="name"
                                   placeholder="اضف عنوان للتدريب">
                        </div>
                        <input type="hidden" name="training_id" id="edit_modal_training_id">
                        <div class="mb-3">
                            <label class="form-label">تاريخ بدأ التدريب</label>
                            <input type="datetime-local" class="form-control" id="edit_modal_training_time"
                                   name="time">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">عن التدريب</label>
                            <textarea class="form-control" id="edit_modal_training_description" name="description"
                                      rows="3" placeholder="اضف شرح للتدريب"></textarea>
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
    <!-- Modal Delete Training -->
    <div class="modal modal-blur fade" id="modal-delete-training" tabindex="-1" role="dialog" aria-hidden="true">
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
                    <h3>تأكيد حذف هذا التدريب؟</h3>
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
                                <form action="trainings/destroy" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <input type="hidden" name="training_id" id="del_modal_training_id">
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
    <!-- Modal Apply Training -->
    <div class="modal modal-blur fade" id="modal-apply-training" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="apply_modal_title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('letters.store') }}" method="post" autocomplete="off" novalidate>
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">عرف نفسك</label>
                            <textarea class="form-control" name="body" rows="3"
                                      placeholder="تحدث عن نفسك بشكل مختصر وحاول ابراز مهاراتك وابدي اسبابك لطلب الالتحاق بالتدريب."></textarea>
                        </div>
                        <input type="hidden" name="training_id" id="apply_modal_training_id">
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            الغاء
                        </a>
                        <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                            تقديم
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Accept Letter -->
    <div class="modal modal-blur fade" id="modal-accept-letter" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-success"></div>
                <div class="modal-body text-center py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 mx-auto text-green icon-lg" width="24"
                         height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"/>
                        <path d="M9 12l2 2l4 -4"/>
                    </svg>
                    <h3>تأكيد قبول هذا الطلب؟</h3>
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
                                <form action="{{ route('letters.accept') }}" method="post">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="letter_id" id="accept_modal_letter_id">
                                    <button href="#" class="btn btn-success w-100" data-bs-dismiss="modal">
                                        قبول
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Refuse Letter -->
    <div class="modal modal-blur fade" id="modal-refuse-letter" tabindex="-1" role="dialog" aria-hidden="true">
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
                    <h3>تأكيد رفض هذا الطلب؟</h3>
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
                                <form action="{{ route('letters.refuse') }}" method="post">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="letter_id" id="refuse_modal_letter_id">
                                    <button href="#" class="btn btn-danger w-100" data-bs-dismiss="modal">
                                        رفض
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Delete Letter -->
    <div class="modal modal-blur fade" id="modal-delete-letter" tabindex="-1" role="dialog" aria-hidden="true">
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
                    <h3>تأكيد حذف هذا الطلب؟</h3>
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
                                <form action="{{ route('letters.destroy') }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <input type="hidden" name="letter_id" id="del_modal_letter_id">
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
        function setEditTrainingValues(trainingId, trainingName, trainingDescription, trainingTime) {
            document.getElementById('edit_modal_training_id').value = trainingId;
            document.getElementById('edit_modal_training_name').value = trainingName;
            document.getElementById('edit_modal_training_description').value = trainingDescription;
            document.getElementById('edit_modal_training_time').value = trainingTime;
        }

        function setDeletedTrainingId(trainingId) {
            document.getElementById('del_modal_training_id').value = trainingId;
        }

        function setApplyTrainingValues(modalTitle, trainingId) {
            document.getElementById('apply_modal_title').textContent = `تقديم طلب التحاق لدى ${modalTitle}`;
            document.getElementById('apply_modal_training_id').value = trainingId;
        }

        function setAcceptLetterId(letterId) {
            document.getElementById('accept_modal_letter_id').value = letterId;
        }

        function setRefuseLetterId(letterId) {
            document.getElementById('refuse_modal_letter_id').value = letterId;
        }

        function setDeletedLetterId(letterId) {
            document.getElementById('del_modal_letter_id').value = letterId;
        }
    </script>
@endsection
