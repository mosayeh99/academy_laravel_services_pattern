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
                        المقالات
                    </h2>
                </div>
                @permission('add articles')
                <div class="col-3 col-md-2 col-xl-1">
                    <a href="#" class="btn btn-outline-primary w-100" data-bs-toggle="modal"
                       data-bs-target="#modal-add-article">
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
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                        <li class="nav-item">
                            <a href="#tabs-all-articles" class="nav-link active" data-bs-toggle="tab">جميع المقالات</a>
                        </li>
                        @permission('add articles')
                        <li class="nav-item">
                            <a href="#tabs-my-articles" class="nav-link" data-bs-toggle="tab">مقالاتي</a>
                        </li>
                        @endpermission
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="tabs-all-articles">
                            <div id="faq-1" class="accordion" role="tablist" aria-multiselectable="true">
                                @if($articles->count())
                                    @foreach($articles as $article)
                                        <div class="d-flex gap-2">
                                            <div class="col accordion-item">
                                                <div class="accordion-header" role="tab">
                                                    <button class="accordion-button collapsed" data-bs-toggle="collapse"
                                                            data-bs-target="#faq-2-{{$article->id}}"
                                                            aria-expanded="false">
                                                        {{ $article->name }}
                                                    </button>
                                                </div>
                                                <div id="faq-2-{{$article->id}}" class="accordion-collapse collapse"
                                                     role="tabpanel" data-bs-parent="#faq-1">
                                                    <div class="accordion-body pt-0">
                                                        <div>
                                                            <h4 class="mb-0">{{ $article->articleable->name }}</h4>
                                                            <p>{{ $article->body }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @role('Admin', 'admin')
                                            <div class="col-auto align-items-center d-flex">
                                                <div class="dropdown">
                                                    <a href="#" class="btn-action" data-bs-toggle="dropdown"
                                                       aria-expanded="true">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                             height="24" viewBox="0 0 24 24" stroke-width="2"
                                                             stroke="currentColor" fill="none" stroke-linecap="round"
                                                             stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                                            <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                                            <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end"
                                                         data-popper-placement="bottom-end"
                                                         style="position: absolute; inset: 0 0 auto auto; margin: 0; transform: translate3d(0px, 34.4px, 0px);">
                                                        @permission('update articles')
                                                        <a href="#" class="dropdown-item"
                                                           onclick="setEditArticleId({{ $article->id }}, '{{$article->name}}', '{{$article->body}}')"
                                                           data-bs-toggle="modal" data-bs-target="#modal-edit-article">تعديل</a>
                                                        @endpermission

                                                        @permission('delete articles')
                                                        <a href="#" class="dropdown-item text-danger"
                                                           onclick="setDeletedArticleId({{ $article->id }})"
                                                           data-bs-toggle="modal" data-bs-target="#modal-del-article">حذف</a>
                                                        @endpermission
                                                    </div>
                                                </div>
                                            </div>
                                            @endrole
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-muted fs-3 text-center my-3">
                                        ليست هناك اي مقالات لعرضها
                                    </div>
                                @endif
                            </div>
                        </div>
                        @permission('add articles')
                        <div class="tab-pane" id="tabs-my-articles">
                            <div id="faq-1" class="accordion" role="tablist" aria-multiselectable="true">
                                @if($myArticles->count())
                                    @foreach($myArticles as $article)
                                        <div class="d-flex gap-2">
                                            <div class="col accordion-item">
                                                <div class="accordion-header" role="tab">
                                                    <button class="accordion-button collapsed" data-bs-toggle="collapse"
                                                            data-bs-target="#faq-4-{{$article->id}}"
                                                            aria-expanded="false">
                                                        {{ $article->name }}
                                                    </button>
                                                </div>
                                                <div id="faq-4-{{$article->id}}" class="accordion-collapse collapse"
                                                     role="tabpanel" data-bs-parent="#faq-1">
                                                    <div class="accordion-body pt-0">
                                                        <div>
                                                            <h4 class="mb-0">{{ $article->articleable->name }}</h4>
                                                            <p>{{ $article->body }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @permission('update articles', 'delete articles')
                                            <div class="col-auto align-items-center d-flex">
                                                <div class="dropdown">
                                                    <a href="#" class="btn-action" data-bs-toggle="dropdown"
                                                       aria-expanded="true">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                             height="24" viewBox="0 0 24 24" stroke-width="2"
                                                             stroke="currentColor" fill="none" stroke-linecap="round"
                                                             stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                                            <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                                            <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end"
                                                         data-popper-placement="bottom-end"
                                                         style="position: absolute; inset: 0 0 auto auto; margin: 0; transform: translate3d(0px, 34.4px, 0px);">
                                                        @permission('update articles')
                                                        <a href="#" class="dropdown-item"
                                                           onclick="setEditArticleId({{ $article->id }}, '{{$article->name}}', '{{$article->body}}')"
                                                           data-bs-toggle="modal" data-bs-target="#modal-edit-article">تعديل</a>
                                                        @endpermission

                                                        @permission('delete articles')
                                                        <a href="#" class="dropdown-item text-danger"
                                                           onclick="setDeletedArticleId({{ $article->id }})"
                                                           data-bs-toggle="modal" data-bs-target="#modal-del-article">حذف</a>
                                                        @endpermission
                                                    </div>
                                                </div>
                                            </div>
                                            @endpermission
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-muted fs-3 text-center my-3">
                                        ليس لديك اي مقالات لعرضها
                                    </div>
                                @endif
                            </div>
                        </div>
                        @endpermission
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add Article -->
    <div class="modal modal-blur fade" id="modal-add-article" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">اضافة مقالة جديدة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('articles.store') }}" method="post" autocomplete="off" novalidate
                      enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">عنوان المقالة</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">موضوع المقالة</label>
                            <textarea class="form-control" name="body" rows="4"></textarea>
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
    <!-- Modal Edit Article -->
    <div class="modal modal-blur fade" id="modal-edit-article" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تعديل الدورة التعليمية</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="articles/update" method="post" autocomplete="off" novalidate>
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">عنوان المقالة</label>
                            <input type="text" class="form-control" name="name" id="edit_modal_article_name">
                        </div>
                        <input type="hidden" name="article_id" id="edit_modal_article_id">
                        <div class="mb-3">
                            <label class="form-label">موضوع المقالة</label>
                            <textarea class="form-control" name="body" rows="4" id="edit_modal_article_body"></textarea>
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
    <!-- Modal Delete Article -->
    <div class="modal modal-blur fade" id="modal-del-article" tabindex="-1" role="dialog" aria-hidden="true">
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
                    <h3>تأكيد حذف هذه المقالة؟</h3>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                    الغاء
                                </a></div>
                            <div class="col">
                                <form action="articles/destroy" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <input type="hidden" name="article_id" id="del_modal_article_id">
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
        function setEditArticleId(articleId, articleName, articleBody) {
            document.getElementById('edit_modal_article_id').value = articleId;
            document.getElementById('edit_modal_article_name').value = articleName;
            document.getElementById('edit_modal_article_body').value = articleBody;
        }

        function setDeletedArticleId(articleId) {
            document.getElementById('del_modal_article_id').value = articleId;
        }
    </script>
@endsection
