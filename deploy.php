<?php

require 'recipe/laravel.php';
require __DIR__.'/vendor/autoload.php';

use Noodlehaus\Config;

/**
 * Get config from .env
 */
$config = new Config(__DIR__.'/config.json');

$serverHost   = $config->get('server.host');
$serverUser   = $config->get('server.user');
$deployPath   = $config->get('server.deploy_path');
$deployBranch = $config->get('branch');

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
    ->env('branch', $deployBranch)
    ->env('deploy_path', $deployPath);
