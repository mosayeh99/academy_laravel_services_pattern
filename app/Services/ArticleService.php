<?php

namespace App\Services;

use App\Models\Article;
use App\Traits\AuthorizeActions;
use App\Traits\GetAuthorizedUser;

class ArticleService
{
    use GetAuthorizedUser;
    use AuthorizeActions;

    public function getArticles()
    {
        $articles = Article::latest()->get();

        if ($this->getCurrentGuard() !== 'student') {
            $myArticles = $this->getAuthUser()->articles;
            return ['articles' => $articles, 'myArticles' => $myArticles];
        }

        return ['articles' => $articles];
    }

    public function createArticle($request)
    {
        $this->getAuthUser()->articles()->create($request);
    }

    public function updateArticle($request)
    {
        $article = Article::find($request->article_id);
        $this->authorizeAction('update-article', $article);
        $article->update($request->validated());
    }

    public function destroyArticle($request)
    {
        $article = Article::find($request->article_id);

        if ($article) {
            $this->authorizeAction('delete-article', $article);
            $article->delete();
            return true;
        }

        return false;
    }
}
