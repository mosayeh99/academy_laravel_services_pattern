<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\StoreArticleRequest;
use App\Http\Requests\Article\UpdateArticleRequest;
use App\Services\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    private ArticleService $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
        $this->middleware('AgencyNotAllowed');
        $this->middleware('StudentNotAllowed')->except('index');
    }

    public function index()
    {
        $data = $this->articleService->getArticles();
        return view('articles', $data);
    }

    public function store(StoreArticleRequest $request)
    {
        $this->articleService->createArticle($request->validated());
        notify()->preset('success', ['message' => 'تم اضافة المقالة بنجاح']);
        return back();
    }

    public function update(UpdateArticleRequest $request)
    {
        $this->articleService->updateArticle($request);
        notify()->preset('success', ['message' => 'تم تعديل المقالة بنجاح']);
        return back();
    }

    public function destroy(Request $request)
    {
        $isDeleted = $this->articleService->destroyArticle($request);

        if ($isDeleted) {
            notify()->preset('success', ['message' => 'تم حذف المقالة بنجاح']);
            return back();
        }

        return back()->withErrors('المقالة غير موجودة.');
    }
}
