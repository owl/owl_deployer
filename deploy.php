<?php

require 'recipe/laravel.php';

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

server('prod', 'sample.server', 22)
    ->user('sample')
    ->forwardAgent()
    ->stage('production')
    ->env('branch', 'develop')
    ->env('deploy_path', '/path/to/deploy');
