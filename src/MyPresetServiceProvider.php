<?php

namespace Benaioua\MyPreset;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Benaioua\MyPreset\Http\Livewire\Header;
use Livewire\Livewire;

class JetstreamServiceProvider extends ServiceProvider
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
    $this->loadViewsFrom(__DIR__ . '/../resources/views', 'my-preset');

    $this->configureComponents();
    $this->configurePublishing();
    $this->configureCommands();

  }

  /**
   * Configure the Blade components.
   *
   * @return void
   */
  protected function configureComponents()
  {
    $this->callAfterResolving(BladeCompiler::class, function () {
      $this->registerComponent('confirms-password');
      $this->registerComponent('dialog-modal');
    });
  }

  /**
   * Register the given component.
   *
   * @param  string  $component
   * @return void
   */
  protected function registerComponent(string $component)
  {
    Blade::component('my-preset::components.' . $component, 'jet-' . $component);
  }

  /**
   * Configure publishing for the package.
   *
   * @return void
   */
  protected function configurePublishing()
  {
    if (!$this->app->runningInConsole()) {
      return;
    }

    $this->publishes([
      __DIR__ . '/../resources/views' => resource_path('views/vendor/my-preset'),
    ], 'benaioua-views');

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
