<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Offer;
use App\Models\Section;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            ['name'=>'Husein',
            'is_admin'=>1,
            'email'=>'husikaa_988@hotmail.com',
            'email_verified_at'=>Carbon::now(),
            'password'=>Hash::make(12345678),
        ],
        ['name'=>'Emina',
            'is_admin'=>0,
            'email'=>'emina_988@hotmail.com',
            'email_verified_at'=>Carbon::now(),
            'password'=>Hash::make(12345678),
        ],
        ['name'=>'Eminaa',
            'is_admin'=>0,
            'email'=>'emina_983338@hotmail.com',
            'email_verified_at'=>Carbon::now(),
            'password'=>Hash::make(12345678),
        ]
        ]);
        Section::insert([
            ['name'=>'ime sekcije',
            'slug'=>'nnn',
            'order'=>'naručio',
            'published'=>'objavio',
            'is_on_front'=>'da']
        ]);

        Offer::insert([
        ['title'=>'husein naslov',
        'slug'=>'jijii',
        'published_at'=>Carbon::now(),
        'unpublished_at'=>null,
        'published'=>0,
        'introduction'=>'uvod u ',
        'description'=>'opis ',
        'author_id'=>1,
        'section_id'=>1,
        'image'=>'slika'],

        ['title'=>'husein naslov',
        'slug'=>'jijii',
        'published_at'=>Carbon::now(),
        'unpublished_at'=>null,
        'published'=>0,
        'introduction'=>'uvod u ',
        'description'=>'opis ',
        'author_id'=>3,
        'section_id'=>1,
        'image'=>'slika']
        ]);

       
    
    }
}