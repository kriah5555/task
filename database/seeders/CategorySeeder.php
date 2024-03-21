<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Gst;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'data' => ['name' => 'Category 123'], 
                'code_data' => [
                    ['name' => 'code1', 'description' => 'description 1', 'units' => 1], 
                    ['name' => 'code2', 'description' => 'description 2', 'units' => 2], 
                    ['name' => 'code3', 'description' => 'description 3', 'units' => 3]
                ],
            ],
            [
                'data' => ['name' => 'Category 456'], 
                'code_data' => [
                    ['name' => 'code4', 'description' => 'description 4', 'units' => 4], 
                    ['name' => 'code5', 'description' => 'description 5', 'units' => 5], 
                    ['name' => 'code6', 'description' => 'description 6', 'units' => 6]
                ],
            ],
            [
                'data' => ['name' => 'Category 789'], 
                'code_data' => [
                    ['name' => 'code7', 'description' => 'description 7', 'units' => 7], 
                    ['name' => 'code8', 'description' => 'description 8', 'units' => 8], 
                    ['name' => 'code9', 'description' => 'description 9', 'units' => 9]
                ],
            ]
        ];

        foreach ($categories as $index => $category) {
            $data = Category::create($category['data']);
            Gst::create(['value' => $index + 8]);
            $data->codes()->createMany($category['code_data']);
        }

        
    }
}
