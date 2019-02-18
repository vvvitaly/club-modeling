<?php declare(strict_types=1);

return [
    'musicTrackDurationSeconds' => 5,
    'playlist' => [
        [
            'title' => 'random',
            'genre' => 'random',
        ],
        [
            'title' => 'Song RNB',
            'genre' => \Club\Music\Genre::rnb(),
        ],
        [
            'title' => 'Song POP',
            'genre' => \Club\Emulating\ConfigurationFactory::GENRE_POP_MUSIC,
        ],
        [
            'title' => 'Song Random',
            'genre' => 'random',
        ],
        [
            'title' => 'random',
            'genre' => 'random',
        ],
        [
            'title' => 'random',
            'genre' => 'random',
        ],
    ],
    'persons' => [
        [
            'name' => 'random',
            'gender' => 'random',
            'styles' => 'random',
        ],
        [
            'name' => 'Не рандом',
            'gender' => \Club\Persons\Gender::male(),
            'styles' => 'random',
        ],
        [
            'name' => 'Какая-то девочка',
            'gender' => \Club\Emulating\ConfigurationFactory::GENDER_FEMALE,
            'styles' => 'random',
        ],
        [
            'name' => 'Кто-то с 3 стилями',
            'gender' => 'random',
            'styles' => 3,
        ],
        [
            'name' => 'random',
            'gender' => 'random',
            'styles' => [new \Club\Dances\Styles\HipHop(), 'random'],
        ],
        [
            'name' => 'random',
            'gender' => 'random',
            'styles' => [\Club\Emulating\ConfigurationFactory::STYLE_RNB, \Club\Emulating\ConfigurationFactory::STYLE_POP_MUSIC],
        ],
    ],
];