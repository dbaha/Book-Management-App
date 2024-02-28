<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' =>'superstrongpassword', 
        ]);
        \App\Models\Author::factory()->create([
            'name' => 'Sun Tzu',
            'bio' => 'Master of war strategy',
        ]);

        \App\Models\Author::factory()->create([
            'title'=>'The art of war',
            'author_id'=>'1',
            'genre'=>'Strategy',
            'published_date'=>'1980-05-12'
        ]);
        
    }
}
