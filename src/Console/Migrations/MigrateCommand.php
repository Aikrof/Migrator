<?php
/**
 * @link https://github.com/Aikrof
 * @package Aikrof\Migrator\Console\Migrations
 * @author Denys <AikrofStark@gmail.com>
 */

declare(strict_types=1);

namespace Aikrof\Migrator\Console\Migrations;

use Illuminate\Database\Console\Migrations\MigrateCommand as LaravelMigrateCommand;
use Aikrof\Migrator\Events\MigrationsFinish;

/**
 * Class MigrateCommand
 */
class MigrateCommand extends LaravelMigrateCommand
{
    /**
     * {@inheritDoc}
     */
    public function handle(): void
    {
        if (!$this->input->getOption('database') &&
            !$this->input->getOption('path') &&
            $databases = \config('migrator')
        ) {
            foreach ($databases as $name => $path) {
                $this->setOptions($name, $path);
                parent::handle();
            }

            $this->setOptions(null, null);
        }
        else {
            parent::handle();
        }

        $this->afterMigrate();
    }

    /**
     * Set migration options
     *
     * @param string|null $database
     * @param string|null $path
     */
    protected function setOptions(?string $database, ?string $path): void
    {
        $this->input->setOption('database', $database);
        $this->input->setOption('path', $path);
    }

    /**
     * After migrate
     */
    protected function afterMigrate(): void
    {
        if ($this->migrator->isMigrate()) {
            $this->migrator->fireMigrationEvent(new MigrationsFinish);
        }
    }
}
