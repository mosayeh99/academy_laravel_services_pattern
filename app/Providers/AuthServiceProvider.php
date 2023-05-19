<?php

namespace App\Providers;

//use Illuminate\Support\Facades\Gate;
use App\Models\Article;
use App\Models\Course;
use App\Models\Discussion;
use App\Models\Letter;
use App\Models\Training;
use App\Models\Video;
use App\Models\VirtualClassroom;
use App\Policies\ArticlePolicy;
use App\Policies\CoursePolicy;
use App\Policies\DiscussionPolicy;
use App\Policies\LetterPolicy;
use App\Policies\TrainingPolicy;
use App\Policies\VideoPolicy;
use App\Policies\VirtualClassroomPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Article::class => ArticlePolicy::class,
        Course::class => CoursePolicy::class,
        Video::class => VideoPolicy::class,
        Discussion::class => DiscussionPolicy::class,
        VirtualClassroom::class => VirtualClassroomPolicy::class,
        Training::class => TrainingPolicy::class,
        Letter::class => LetterPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('update-article', [ArticlePolicy::class, 'update']);
        Gate::define('delete-article', [ArticlePolicy::class, 'delete']);

        Gate::define('update-course', [CoursePolicy::class, 'update']);
        Gate::define('delete-course', [CoursePolicy::class, 'delete']);

        Gate::define('get-video', [VideoPolicy::class, 'view']);
        Gate::define('update-video', [VideoPolicy::class, 'update']);
        Gate::define('delete-video', [VideoPolicy::class, 'delete']);

        Gate::define('delete-discussion', [DiscussionPolicy::class, 'delete']);

        Gate::define('update-classroom', [VirtualClassroomPolicy::class, 'update']);
        Gate::define('delete-classroom', [VirtualClassroomPolicy::class, 'delete']);

        Gate::define('update-training', [TrainingPolicy::class, 'update']);
        Gate::define('delete-training', [TrainingPolicy::class, 'delete']);

        Gate::define('store-letter', [LetterPolicy::class, 'store']);
        Gate::define('accept-letter', [LetterPolicy::class, 'acceptLetter']);
        Gate::define('refuse-letter', [LetterPolicy::class, 'refuseLetter']);
        Gate::define('delete-letter', [LetterPolicy::class, 'delete']);
    }
}
