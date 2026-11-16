<?php

declare(strict_types=1);

/*
 * Overrides for Laravel Boost, merged over its defaults. The commands Boost writes into the
 * generated agent guidance (CLAUDE.md, AGENTS.md and the skills) go through DDEV, because this
 * project's PHP, Composer and Node run in the container and never on the host.
 */
return [
    'executable_paths' => [
        'php' => 'ddev php',
        'composer' => 'ddev composer',
        'npm' => 'ddev npm',
        'vendor_bin' => 'ddev exec vendor/bin/',
        'current_directory' => env('BOOST_CURRENT_DIRECTORY_EXECUTABLE_PATH'),
    ],
];
