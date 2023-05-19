@extends('layouts.master')
@section('title', 'Videos')
@section('stylesheets')
@endsection

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col d-flex">
                    <a class="page-title" href="{{ route('courses.index') }}">
                        الدورات التعليمية
                    </a>
                </div>
                @permission('add videos', 'update videos', 'delete videos')
                <div class="col d-flex justify-content-end">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown"
                                aria-expanded="true">
                            خيارات
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" data-popper-placement="bottom-end"
                             style="position: absolute; inset: 0 0 auto auto; margin: 0; transform: translate3d(0px, 39.2px, 0px);">
                            @permission('add videos')
                            <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-add-video">
                                اضافة
                            </a>
                            @endpermission
                            @if($course->videos->count())
                                @permission('add videos')
                                <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                   data-bs-target="#modal-edit-video">
                                    تعديل
                                </a>
                                @endpermission
                                @permission('delete videos')
                                <a href="#" class="dropdown-item text-danger" data-bs-toggle="modal"
                                   data-bs-target="#modal-danger">
                                    حذف
                                </a>
                                @endpermission
                            @endif
                        </div>
                    </div>
                </div>
                @endpermission
            </div>
        </div>
    </div>
    @if($course->videos->count())
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
                    <div class="col-12 col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">{{ $video->name }}</h3>
                                <div>
                                    <video controls class="w-full">
                                        <source src='{{asset("storage/$video->path")}}' type="">
                                    </video>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{$course->name}}</h3>
                            </div>
                            <div class="list-group list-group-flush overflow-auto" style="max-height: 25rem">
                                @foreach($course->videos as $videoInfo)
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <a href="#">
                                                    <span class="avatar">{{ $loop->iteration }}</span>
                                                </a>
                                            </div>
                                            <div class="col text-truncate">
                                                <a href="{{ route('videos.index',[$course->id, $videoInfo->id]) }}"
                                                   class="text-body d-block">{{ $videoInfo->name }}</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">المناقشات</h3>
                            </div>
                            <div class="card-body">
                                <div id="faq-1" class="accordion" role="tablist" aria-multiselectable="true">
                                    @if($video->discussions->count())
                                        @foreach($video->discussions as $discussion)
                                            <div class="d-flex gap-2">
                                                <div class="col accordion-item">
                                                    <div class="accordion-header" role="tab">
                                                        <button class="accordion-button collapsed"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#faq-4-{{$discussion->id}}"
                                                                aria-expanded="false">
                                                            {{ $discussion->question }}
                                                        </button>
                                                    </div>
                                                    <div id="faq-4-{{$discussion->id}}"
                                                         class="accordion-collapse collapse" role="tabpanel"
                                                         data-bs-parent="#faq-1">
                                                        <div class="accordion-body pt-0">
                                                            @if($discussion->replies->count())
                                                                @foreach($discussion->replies as $reply)
                                                                    <div>
                                                                        <h4 class="mb-0">{{ $reply->replyable->name }}</h4>
                                                                        <p>{{ $reply->body }}</p>
                                                                    </div>
                                                                @endforeach
                                                            @else
                                                                <div>
                                                                    <p>لم يتم اضافة رد لهذا السؤال بعد.</p>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                @permission('add replies', 'delete discussions')
                                                <div class="col-auto align-items-center d-flex">
                                                    <div class="dropdown">
                                                        <a href="#" class="btn-action" data-bs-toggle="dropdown"
                                                           aria-expanded="true">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                                 width="24" height="24" viewBox="0 0 24 24"
                                                                 stroke-width="2" stroke="currentColor" fill="none"
                                                                 stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                      fill="none"></path>
                                                                <path
                                                                    d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                                                <path
                                                                    d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                                                <path
                                                                    d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                                            </svg>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end"
                                                             data-popper-placement="bottom-end"
                                                             style="position: absolute; inset: 0 0 auto auto; margin: 0; transform: translate3d(0px, 34.4px, 0px);">
                                                            @permission('add replies')
                                                            <a href="#" class="dropdown-item"
                                                               onclick="setRepliedDiscussionId({{ $discussion->id }})"
                                                               data-bs-toggle="modal"
                                                               data-bs-target="#modal-add-discussion-reply">اضف رد</a>
                                                            @endpermission

                                                            @permission('delete discussions')
                                                            <a href="#" class="dropdown-item text-danger"
                                                               onclick="setDeletedDiscussionId({{ $discussion->id }})"
                                                               data-bs-toggle="modal"
                                                               data-bs-target="#modal-del-discussion">حذف</a>
                                                            @endpermission
                                                        </div>
                                                    </div>
                                                </div>
                                                @endpermission
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="text-muted fs-3 text-center my-3">
                                            ليست هناك اي مناقشات لعرضها
                                        </div>
                                    @endif
                                    @permission('add discussions')
                                    <form action="{{ route('discussions.store') }}" method="post">
                                        @csrf
                                        <div class="d-flex align-items-end gap-2 mt-3">
                                            <div class="col">
                                                <textarea class="form-control" name="question" rows="3"
                                                          placeholder="اضف سؤال جديد"></textarea>
                                            </div>
                                            <input type="hidden" name="video_id" value="{{ $video->id }}">
                                            <button type="submit" title="اضافة" class="btn-action">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="icon icon-tabler icon-tabler-send" width="24" height="24"
                                                     viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"
                                                     fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M10 14l11 -11"></path>
                                                    <path
                                                        d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </form>
                                    @endpermission
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="page-body">
            <div class="container-xl">
                <div class="text-muted fs-2 text-center mt-5">
                    لم يضاف دروس لهذه الدورة بعد.
                </div>
            </div>
        </div>
    @endif

    <!-- Modal Add Video -->
    <div class="modal modal-blur fade" id="modal-add-video" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">اضافة درس جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('videos.store') }}" method="post" autocomplete="off" novalidate
                      enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">الاسم</label>
                            <input type="text" class="form-control" name="name" placeholder="اسم الدرس">
                        </div>
                        <input type="hidden" name="course_id" value="{{$course->id}}">
                        <div class="mb-3">
                            <label class="form-label">اضف الفيديو الخاص بالدرس</label>
                            <div class="position-relative">
                                <button class="btn p-4 text-muted w-100">اضغط لاضافة فيديو</button>
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
    @if($course->videos->count())
        <!-- Modal Edit Video -->
        <div class="modal modal-blur fade" id="modal-edit-video" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">تعديل الدرس</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('videos.update', $video->id) }}" method="post" autocomplete="off" novalidate
                          enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">تعديل الاسم</label>
                                <input type="text" name="name" value="{{ $video->name }}" class="form-control"
                                       placeholder="اسم الدرس">
                            </div>
                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                            <div class="mb-3">
                                <label class="form-label">اضف فيديو جديد لهذا الدرس</label>
                                <div class="position-relative">
                                    <button class="btn p-4 text-muted w-100">اضغط لاضافة فيديو</button>
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
        <!-- Modal Delete Video -->
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
                        <h3>تأكيد حذف هذا الدرس؟</h3>
                    </div>
                    <div class="modal-footer">
                        <div class="w-100">
                            <div class="row">
                                <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                        الغاء
                                    </a></div>
                                <div class="col">
                                    <form action="{{ route('videos.destroy', $video->id) }}" method="post">
                                        @method('DELETE')
                                        @csrf
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
    @endif
    <!-- Modal Add Discussion Reply -->
    <div class="modal modal-blur fade" id="modal-add-discussion-reply" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">اضافة رد جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('discussion-replies.store') }}" method="post" autocomplete="off" novalidate>
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <textarea type="text" class="form-control" name="body" rows="3"
                                      placeholder="اضف ردك"></textarea>
                        </div>
                        <input type="hidden" name="discussion_id" id="add_reply_modal_discussion_id">
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
    <!-- Modal Delete Discussion -->
    <div class="modal modal-blur fade" id="modal-del-discussion" tabindex="-1" role="dialog" aria-hidden="true">
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
                    <h3>تأكيد حذف هذا السؤال؟</h3>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                    الغاء
                                </a></div>
                            <div class="col">
                                <form action="discussions/destroy" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <input type="hidden" name="discussion_id" id="del_modal_discussion_id">
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
        function setRepliedDiscussionId(discussionId) {
            document.getElementById('add_reply_modal_discussion_id').value = discussionId;
        }

        function setDeletedDiscussionId(discussionId) {
            document.getElementById('del_modal_discussion_id').value = discussionId;
        }
    </script>
@endsection

