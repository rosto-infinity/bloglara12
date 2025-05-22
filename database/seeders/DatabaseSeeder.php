<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Author;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
   
    public function run(): void
    {
        info('Creating blog authors...');
        Author::factory()->count(12)
            ->create();
        info('Blog authors created.');
    }
}
