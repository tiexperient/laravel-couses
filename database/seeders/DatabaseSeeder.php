<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Course;
use App\Models\CourseBatch;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeds que devem rodar em produção
        if (App::environment() === 'production') {
            $this->call([
                UserSeeder::class,
                StatusSeeder::class,

                CourseStatusSeeder::class
            ]);
        }

        // Seeds que devem rodar em ambiente diferente de produção
        if (App::environment() !== 'production') {
            $this->call([
                PermissionSeeder::class,
                RoleSeeder::class,
                
                UserSeeder::class,
                CourseSeeder::class,
                
                StatusSeeder::class,
                CourseBatchSeeder::class,
                ModuleSeeder::class,
                LessonSeeder::class,
                CourseStatusSeeder::class
            ]);
        }
    }
}
