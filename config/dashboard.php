<?php
return [


    //'roles'  => ['editor', 'administrator', 'author', 'blogger'],

    'status' => ["Active", "Not Active"],

    'status_v2' => [
        [
            'code' => 'Active',
            'name' => 'المقالات المفعلة',
        ],
        [
            'code' => 'Not Active',
            'name' => 'مقالات غير مفعلة',
        ]
    ],


    /*
    |
    | Sorting
    |
    */
    'sort' => [
        [
            'code' => 'desc',
            'name' => 'من الأحدث للأقدم',
        ],
        [
            'code' => 'asc',
            'name' => 'من الأقدم إلي الأحدث',
        ]
    ],


    /*
    |
    | Default Language
    |
    */
    'default_language' => [
        'code'    => 'en',
        'unicode' => 'en-us',
        'name'    => 'English'
    ]

];
