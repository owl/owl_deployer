<?php

require 'recipe/laravel.php';
require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Input\InputOption;

/**
 * CLI options
 */
option('host', null, InputOption::VALUE_OPTIONAL, 'Host name for dpeloy');
option('user', null, InputOption::VALUE_OPTIONAL, 'Username on the deploy server');
option('deploypath', null, InputOption::VALUE_OPTIONAL, 'Path on the deploy server.');
option('tag', null, InputOption::VALUE_OPTIONAL, 'Target tag name.');

/**$serverHost = input()->getOption('host');
$serverUser = input()->getOption('user');
$deployPath = input()->getOption('deploypath');
$deployTag  = input()->getOption('tag');*/

/**
 * Config
 */
set('repository', 'https://github.com/owl/owl.git');
set('shared_dirs', [
    'storage',
    'public/images',
]);
set('writable_dirs', ['bootstrap/cache', 'storage']);

/**
 * Copy files and folders
 */
set('copy_dirs', ['../vendor', '../public/css', '../public/packages']);

task('npm', function () {
    run('cd {{release_path}} && npm install');
    run('cd {{release_path}} && npm run build');
});

after('deploy', 'npm');

server('prod', $serverHost, 22)
    ->user($serverUser)
    ->forwardAgent()
    ->stage('production')
    ->env('branch', $deployTag)
    ->env('deploy_path', $deployPath);
