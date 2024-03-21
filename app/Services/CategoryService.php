<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Code;
use App\Models\Gst;

class CategoryService
{
    public function getCategories()
    {
        return Category::select('id as value', 'name as label')->get()->toArray();
    }

    public function getGst()
    {
        return Gst::select('id as value', 'value as label')->get()->toArray();
    }

    public function getCategorycodesWithDetails()
    {
        $return = [];
        $code_details = [];
        Category::all()->each(function ($category) use (&$return, &$code_details) {
            $codes = [];
            foreach ($category->codes as $code) {
                $codes[$code->id] = $code->name;
                $code_details[$code->id] = [
                    'name' => $code->name,
                    'description' => $code->description,
                    'units' => $code->units,
                ];
            }
            $return[$category->id] = $codes;
        });


        return ['category_codes' => $return, 'code_details' => $code_details];
    }
}
