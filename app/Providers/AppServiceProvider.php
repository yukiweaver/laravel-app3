<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\ArticleObserver;
use App\Article;
use App\Observers\PostObserver;
use App\Post;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      Article::observe(ArticleObserver::class);
      Post::observe(PostObserver::class);
    }
}
