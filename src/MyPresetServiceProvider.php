<?php

namespace Benaioua\MyPreset;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Benaioua\MyPreset\Http\Livewire\Header;
use Livewire\Livewire;

class MyPresetServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    $this->app->afterResolving(BladeCompiler::class, function () {
      if (config('jetstream.stack') === 'livewire' && class_exists(Livewire::class)) {
        Livewire::component('header', Header::class);
      }
    });
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {

    $this->configureCommands();

  }

  /**
   * Configure the commands offered by the application.
   *
   * @return void
   */
  protected function configureCommands()
  {
    if (!$this->app->runningInConsole()) {
      return;
    }

    $this->commands([
      Console\InstallCommand::class,
    ]);
  }
}
