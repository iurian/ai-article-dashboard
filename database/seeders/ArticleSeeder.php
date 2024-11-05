<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate existing records to avoid conflicts
        Article::truncate();

        // Get users and companies to associate with articles
        $users = User::all();
        $companies = Company::all();

        $images = [
            'https://archintel.com/wp-content/uploads/2019/11/stock-market-trading-PRKKJK2-scaled-e1573747668551.jpg',
            'https://archintel.com/wp-content/uploads/2019/11/businessteam-are-analyzing-graphs-TP8ZNW3-scaled-e1573747675256.jpg',
            'https://archintel.com/wp-content/uploads/2019/11/business-charts-on-digital-tablet-PQ98AKX-scaled-e1573747659179.jpg',
            'https://archintel.com/wp-content/uploads/2019/11/partners-discussing-business-over-coffee-PYCDL5E-scaled-e1573747649730.jpg'
        ];


        // Seed 10 articles
        for ($i = 1; $i <= 10; $i++) {
            Article::create([
                'image' => $images[array_rand($images)], // Ensure this is a valid URL
                'title' => 'Article Title ' . $i,
                'link' => 'http://archintel.com/article' . $i,
                'date' => Carbon::now()->subDays(rand(0, 30)), // Random date within the last 30 days
                'content' => 'Content for article ' . $i . '. This is a sample content text.',
                'status' => 'Published', // Change status randomly if needed
                'writer_id' => $users->random()->id, // Assign a random user as writer
                'editor_id' => $users->random()->id, // Assign a random user as editor
                'company_id' => $companies->random()->id, // Assign a random company
            ]);
        }
    }
}

//https://archintel.com/wp-content/uploads/2019/11/business-charts-on-digital-tablet-PQ98AKX-scaled-e1573747659179.jpg