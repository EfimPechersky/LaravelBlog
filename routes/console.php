<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\Post;
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function () {
    Post::where('is_published', false)
      ->where('publishes_on', '<=', now())
      ->update(['is_published' => 1]);
})->everyMinute();