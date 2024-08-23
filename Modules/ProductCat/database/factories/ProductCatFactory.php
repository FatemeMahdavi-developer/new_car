<?php

namespace Modules\ProductCat\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\ProductCat\Models\ProductCat;

class ProductCatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\ProductCat\Models\ProductCat::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title'=>$this->faker->title,
            'seo_url'=>str_replace('','-',$this->faker->unique()->title),
            'seo_title'=>$this->faker->title,
            'parent_id'=>ProductCat::get()->random() ?? null
        ];
    }
}
