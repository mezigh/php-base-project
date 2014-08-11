<?php

return [
    'debug'           => false,
    'url'             => 'http://localhost:8888',
    'timezone'        => 'Europe/Paris',
    'locale'          => 'fr',
    'fallback_locale' => 'en',
    'early_providers'       => [
        "\DevMediaLab\System\Event\EventSystemServiceProvider",
    ],
    'providers' => [
        "\DevMediaLab\System\Routing\RoutingServiceProvider",
        "\DevMediaLab\System\Html\HtmlServiceProvider",
        "\DevMediaLab\System\Http\HttpServiceProvider"
    ]
];
