<?php
/**
 * @link https://github.com/Aikrof
 * @package Aikrof\Migrator\Console
 * @author Denys <AikrofStark@gmail.com>
 */

declare(strict_types=1);

namespace Aikrof\Migrator\Console;

use Illuminate\Database\Console\WipeCommand as LaravelWipeCommand;

/**
 * Class WipeCommand
 */
class WipeCommand extends LaravelWipeCommand
{
    /**
     * {@inheritDoc}
     */
    public function handle(): void
    {
        if (!$this->input->getOption('database') &&
            $databases = \config('migrator')
        ) {
            foreach (\array_keys($databases) as $name) {
                $this->input->setOption('database', $name);
                parent::handle();
            }

            $this->input->setOption('database', null);
        }
        else {
            parent::handle();
        }
    }
}
