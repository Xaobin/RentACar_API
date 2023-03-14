<?php
 
return [
    'vars' => [
        'token' => '',
        'validate'=>'FALSE'
    ]
];

/*
USE THE GLOBAL

    dd(config('global.roles')); // Return all roles

 
Route::get('user-roles/super-admin', function() {
    dd(config('global.roles.super_admin')); // Specific role
});
 
Route::get('emails/dev', function() {
    dd(config('global.emails.dev')); // Specific dev email
});

Config::set('social_links', $social_links);

Config::get('social_links');
*/