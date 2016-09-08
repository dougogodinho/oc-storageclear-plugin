<?php

return [
    'plugin' => [
        'name' => 'Storage Cleaner',
        'description' => 'Scan the Uploads folder searching disconnected files with the database.',
    ],
    'clear' => [
        'seeking' => [
            'files' => 'Seeking unregistered Files...',
            'registers' => 'Seeking registers without Files or without related Model...',
            'directories' => 'Seeking empty directories...'
        ],
        'removed' => [
            'files' => '... :count files removed, :total found!',
            'registers' => '... :count registers removed, :total found!',
            'directories' => '... :count empty directories removed, :total found!'
        ]
    ],
    'project' => [
        'cleaning' => 'Running a fast cleaning to generate a small zip...',
        'start' => 'Building a Zip file for your amazing project...',
        'end' => '... Finish! Your project zip is in your project root: :file'
    ],
    'database' => [
        'start' => 'Building a dump file for your database...',
        'end' => '... Finish! Your database dump is in your project root: :file'
    ]
];