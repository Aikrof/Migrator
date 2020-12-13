<?php
/**
 * @link https://github.com/Aikrof
 * @package Aikrof\Migrator\Database\Migrations
 * @author Denys <AikrofStark@gmail.com>
 */

declare(strict_types=1);

namespace Aikrof\Migrator\Database\Migrations;

use Illuminate\Database\Migrations\Migrator as LaravelMigrator;

/**
 * Class Migrator
 */
class Migrator extends LaravelMigrator
{
    /**
     * @var bool
     */
    protected $isMigrate = true;

    /**
     * {@inheritDoc}
     *
     * @param  array  $migrations
     * @param  array  $options
     */
    public function runPending(array $migrations, array $options = []): void
    {
        if (empty($migrations)) {
            $this->isMigrate = false;
        }

        parent::runPending($migrations, $options);
    }

    /**
     * @return bool
     */
    public function isMigrate(): bool
    {
        return $this->isMigrate;
    }
}
