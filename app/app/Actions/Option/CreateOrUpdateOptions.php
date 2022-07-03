<?php

namespace App\Actions\Option;

use App\Models\Option;
use Plank\Metable\Meta;

class CreateOrUpdateOptions
{
    public function handle(?array $options = null): void
    {
        if ($options) {
            foreach ($options as $key => $value) {
                $item = getOption($key) ?? new Meta();

                $item->metable_type = Option::class;
                $item->metable_id   = Option::OPTION_ID;
                $item->key          = $key;
                $item->value        = $value;

                $item->save();
            }
        } else {
            Option::deleteAllOptions();
        }
    }
}
