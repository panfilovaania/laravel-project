<?php

namespace PlaceholderImageGenerator;

use Illuminate\Support\ServiceProvider;

class PlaceholderImageGeneratorServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('placeholder-image-generator', function () {
            return new PlaceholderImageGeneratorService();
        });
    }
}