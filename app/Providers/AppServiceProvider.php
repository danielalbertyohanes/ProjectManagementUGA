<?php

namespace App\Providers;

use App\Models\Ppt;
use App\Models\Topic;
use App\Models\Video;
use App\Models\SubTopic;
use App\Observers\PPTObserver;
use App\Observers\TopicObserver;
use App\Observers\VideoObserver;
use App\Observers\SubTopicObserver;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Ppt::observe(PPTObserver::class);
        Video::observe(VideoObserver::class);
        SubTopic::observe(SubTopicObserver::class);
        // /Topic::observe(TopicObserver::class);
    }
}
