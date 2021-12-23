<?php

return [
    'admin-user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
            'edit_profile' => 'Edit Profile',
            'edit_password' => 'Edit Password',
        ],

        'columns' => [
            'id' => 'ID',
            'last_login_at' => 'Last login',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'password_repeat' => 'Password Confirmation',
            'activated' => 'Activated',
            'forbidden' => 'Forbidden',
            'language' => 'Language',
                
            //Belongs to many relations
            'roles' => 'Roles',
                
        ],
    ],

    'gym-staff' => [
        'title' => 'Gym Staff',

        'actions' => [
            'index' => 'Gym Staff',
            'create' => 'New Gym Staff',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'clubready_owner_id' => 'Clubready owner',
            'event_uuid' => 'Event uuid',
            'gym_staff_type_id' => 'Gym staff type',
            'gym_location_id' => 'Gym location',
            
        ],
    ],

    'gym-location' => [
        'title' => 'Gym Locations',

        'actions' => [
            'index' => 'Gym Locations',
            'create' => 'New Gym Location',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            
        ],
    ],

    'gym-staff-type' => [
        'title' => 'Gym Staff Types',

        'actions' => [
            'index' => 'Gym Staff Types',
            'create' => 'New Gym Staff Type',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            
        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];