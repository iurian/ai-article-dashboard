<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::truncate();

        Company::create([
            'logo' => 'https://archintel.com/wp-content/uploads/2019/10/archintel-logo.gif', // Ensure this is a valid URL
            'name' => 'Company One',
            'status' => 'Active',
        ]);

        Company::create([
            'logo' => 'https://archintel.com/wp-content/uploads/2019/10/archintel-logo.gif', // Ensure this is a valid URL
            'name' => 'Company Two',
            'status' => 'Active',
        ]);

        Company::create([
            'logo' => 'https://archintel.com/wp-content/uploads/2019/10/archintel-logo.gif', // Ensure this is a valid URL
            'name' => 'Company Three',
            'status' => 'Inactive',
        ]);
    }
}
