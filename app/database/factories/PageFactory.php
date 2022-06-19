<?php

namespace Database\Factories;

use App\Enums\PageTemplateEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class PageFactory extends Factory
{
    public function definition()
    {
        $title = $this->faker->sentence(5);

        return [
            "title"             => $title,
            "template"          => PageTemplateEnum::DEFAULT,
            "visibility_status" => true,
            "content"           => $this->faker->sentence(5, 100),
        ];
    }
}
