<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\Teacher;

class ArticlePolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update($user, Article $article): bool
    {
        if (auth('admin')->user()) {
            return true;
        }
        return $user->id === $article->articleable->id && $article->articleable_type === Teacher::class;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, Article $article): bool
    {
        if (auth('admin')->user()) {
            return true;
        }
        return $user->id === $article->articleable->id && $article->articleable_type === Teacher::class;
    }
}
