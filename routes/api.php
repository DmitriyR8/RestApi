<?php

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('/user/register',  'Auth\RegisterController@register');
    $router->post('/user/sign-in',  'Auth\AuthController@login');
    $router->post('/user/recover-password',  'Auth\PasswordResetController@sendResetLink');
    $router->patch('/user/recover-password',  'Auth\PasswordResetController@resetPassword');

    $router->group(['middleware' => 'auth'], function () use ($router) {
        $router->get('/user/companies', 'CompanyController@getUserCompanies');
        $router->post('/user/companies', 'CompanyController@store');

        $router->post('/user/logout',  'Auth\AuthController@logout');

    });
});
