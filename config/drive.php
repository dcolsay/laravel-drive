<?php

return [

    'models' => [

        'file' => Dcolsay\Drive\Models\File::class,
    ],

    'pipeline' => [

        'batch' => [
            Dcolsay\Drive\AddToLaravelMedialibrary::class
        ]
    ]
];