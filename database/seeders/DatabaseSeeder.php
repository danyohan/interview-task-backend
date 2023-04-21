<?php

namespace Database\Seeders;
use App\Modules\Invoices\Infrastructure\Database\Seeders;
use Illuminate\Support\Facades\Artisan;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Artisan::call('db:seed', ['--class' => 'App\Modules\Invoices\Infrastructure\Database\Seeders\DatabaseSeeder']);
    }
}
