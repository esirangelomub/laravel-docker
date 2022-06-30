<?php

namespace Database\Seeders;

use App\Models\Directory;
use App\Models\File;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         \App\Models\File::factory(10)->create();
         \App\Models\Directory::factory(10)
             ->has(File::factory()->count(5), 'files')
             ->has(Directory::factory()->count(5)->has(File::factory()->count(5), 'files'), 'parent_directories')
             ->create();
    }
}
