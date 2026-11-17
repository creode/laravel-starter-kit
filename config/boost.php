<?php

declare(strict_types=1);

/*
 * Overrides for Laravel Boost, merged over its defaults.
 *
 * The commands Boost writes into the generated agent guidance (CLAUDE.md, AGENTS.md and the
 * skills) go through DDEV, because PHP, Composer and Node run in the container. The composer,
 * npm and vendor_bin paths are only used for that text, so they are set here.
 *
 * The php path is different: Boost also runs it to start its MCP tools, where "ddev php" would
 * fail inside the container. Leave it unset normally and use `ddev boost-update`, which sets
 * BOOST_PHP_EXECUTABLE_PATH only while the guidance is generated.
 */
return [
    // Boost otherwise decides by counting the output of `artisan test --list-tests`, which varies
    // between environments and can make the Test Enforcement section appear and disappear.
    'enforce_tests' => true,

    'executable_paths' => [
        'php' => env('BOOST_PHP_EXECUTABLE_PATH'),
        'composer' => 'ddev composer',
        'npm' => 'ddev npm',
        'vendor_bin' => 'ddev exec vendor/bin/',
        'current_directory' => env('BOOST_CURRENT_DIRECTORY_EXECUTABLE_PATH'),
    ],
];
