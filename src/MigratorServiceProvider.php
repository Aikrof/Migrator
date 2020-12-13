<?php
/**
 * @link https://github.com/Aikrof
 * @package Aikrof\Migrator
 * @author Denys <AikrofStark@gmail.com>
 */

declare(strict_types=1);

namespace Aikrof\Migrator;

use Aikrof\Migrator\Database\Migrations\Migrator;
use Illuminate\Database\MigrationServiceProvider;
use Aikrof\Migrator\Console\Migrations\MigrateCommand;

/**
 * Class MigratorServiceProvider
 */
class MigratorServiceProvider extends MigrationServiceProvider
{
    /**
     * {@inheritDoc}
     */
    protected function registerMigrator(): void
    {
        // The migrator is responsible for actually running and rollback the migration
        // files in the application. We'll pass in our database connection resolver
        // so the migrator can resolve any of these connections when it needs to.
        $this->app->singleton('migrator', function ($app) {
            $repository = $app['migration.repository'];

            return new Migrator($repository, $app['db'], $app['files'], $app['events']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerMigrateCommand()
    {
        $this->app->singleton('command.migrate', function ($app) {
            return new MigrateCommand($app['migrator']);
        });
    }
}
