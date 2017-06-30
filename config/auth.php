<?php
$app->add(new \Slim\Middleware\HttpBasicAuthentication([
    "path" => "/api", /* or ["/admin", "/api"] */
    "realm" => "Protected",
    "users" => [
        "root" => "root",
        "user2" => "password2"
    ]
]));