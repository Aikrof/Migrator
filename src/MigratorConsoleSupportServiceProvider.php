<?php
/**
 * @link https://github.com/Aikrof
 * @package Aikrof\Migrator
 * @author Denys <AikrofStark@gmail.com>
 */

declare(strict_types=1);

namespace Aikrof\Migrator;

use Aikrof\Migrator\Console\WipeCommand;
use Illuminate\Foundation\Providers\ConsoleSupportServiceProvider as LaravelConsoleSupportServiceProvider;

/**
 * Class MigratorConsoleSupportServiceProvider
 */
class MigratorConsoleSupportServiceProvider extends LaravelConsoleSupportServiceProvider
{
    /**
     * The provider class names.
     *
     * @var array
     */
    protected $providers = [
        MigratorServiceProvider::class,
    ];

    /**
     * {@inheritDoc}
     */
    public function register(): void
    {
        parent::register();

        /**
         * Extend db:wipe command
         */
        $this->app->extend('command.db.wipe', function () {
            return new WipeCommand;
        });
    }

    /**
     * Bootstrap
     */
    public function boot(): void
    {
        $this->publish();
    }

    /**
     * Publish config
     */
    protected function publish(): void
    {
        $localConfig = \realpath(__DIR__ . '/migrator.php');

        $this->publishes([
            $localConfig => config_path('migrator.php'),
            'config'
        ]);
        $this->mergeConfigFrom($localConfig, 'migrator');
    }
}
