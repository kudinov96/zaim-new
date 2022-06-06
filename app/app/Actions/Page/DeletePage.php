<?php

namespace App\Actions\Page;

use App\Models\Page;

class DeletePage
{
    public function handle(Page $item): void
    {
        $item->delete();
    }
}
