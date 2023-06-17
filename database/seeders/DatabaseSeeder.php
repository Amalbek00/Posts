<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Follower;
use App\Models\Photo;
use App\Models\User;
use Database\Factories\UserFollowerFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call([
          UserSeeder::class,
           PhotoSeeder::class,
           CommentSeeder::class
       ]);
    }
}
