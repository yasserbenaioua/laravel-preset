<?php

namespace Benaioua\MyPreset\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class InstallCommand extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'benaioua:install';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Install the Preset components and resources';

  /**
   * Execute the console command.
   *
   * @return void
   */
  public function handle()
  {
    // Install Livewire Stack...
    $this->installLivewireStack();

    // NPM Packages...
    $this->updateNodePackages(function ($packages) {
      return [
        'tailwindcss-dir' => '^4.0.0',
      ] + $packages;
    });
  }

  /**
   * Install the Livewire stack into the application.
   *
   * @return void
   */
  protected function installLivewireStack()
  {

    // Tailwind Configuration...
    copy(__DIR__ . '/../../stubs/livewire/tailwind.config.js', base_path('tailwind.config.js'));

    // View Components...
    copy(__DIR__ . '/../../stubs/livewire/app/View/Components/AppLayout.php', app_path('View/Components/AppLayout.php'));
    copy(__DIR__ . '/../../stubs/livewire/app/View/Components/GuestLayout.php', app_path('View/Components/GuestLayout.php'));
    
    copy(__DIR__ . '/../../resources/views/components/confirms-password.blade.php', base_path('vendor/laravel/jetstream/resources/views/components/confirms-password.blade.php'));
    copy(__DIR__ . '/../../resources/views/components/dialog-modal.blade.php', base_path('vendor/laravel/jetstream/resources/views/components/dialog-modal.blade.php'));

    // Layouts...
    (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/livewire/resources/views/layouts', resource_path('views/layouts'));
    (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/livewire/resources/views/components', resource_path('views/components'));

    // Single Blade Views...
    copy(__DIR__ . '/../../stubs/livewire/resources/views/header.blade.php', resource_path('views/header.blade.php'));

    $this->line('');
    $this->info('Preset scaffolding installed successfully.');
    $this->comment('Please execute "npm install && npm run dev" to build your assets.');
  }

  /**
   * Replace a given string within a given file.
   *
   * @param  string  $search
   * @param  string  $replace
   * @param  string  $path
   * @return void
   */
  protected function replaceInFile($search, $replace, $path)
  {
    file_put_contents($path, str_replace($search, $replace, file_get_contents($path)));
  }

  /**
   * Update the "package.json" file.
   *
   * @param  callable  $callback
   * @param  bool  $dev
   * @return void
   */
  protected static function updateNodePackages(callable $callback, $dev = true)
  {
    if (!file_exists(base_path('package.json'))) {
      return;
    }

    $configurationKey = $dev ? 'devDependencies' : 'dependencies';

    $packages = json_decode(file_get_contents(base_path('package.json')), true);

    $packages[$configurationKey] = $callback(
      array_key_exists($configurationKey, $packages) ? $packages[$configurationKey] : [],
      $configurationKey
    );

    ksort($packages[$configurationKey]);

    file_put_contents(
      base_path('package.json'),
      json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . PHP_EOL
    );
  }

}
