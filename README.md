# Tmp readme
1. add `Aikrof\Laraver\Migrator\MigratorConsoleSupportServiceProvider` to provider array in ./config/app.php
2. use php artisan vendor:publish --provider="Aikrof\Laraver\Migrator\MigratorConsoleSupportServiceProvider" to publish config file `migrator.php`
3. we fire event `\Aikrof\Migrator\Events\MigrationsFinish` when all migrations was finished
