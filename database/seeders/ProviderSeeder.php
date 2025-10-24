<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Provider;

class ProviderSeeder extends Seeder
{
    public function run(): void
    {
        Provider::truncate();
        Provider::create([
            'name' => 'Demo Provider',
            'email' => 'provider@example.com',
        ]);
    }
}
