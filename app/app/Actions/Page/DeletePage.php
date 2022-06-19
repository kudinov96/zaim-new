<?php

namespace App\Actions\Page;

use App\Actions\Slug\UpdateChildrenSlug;
use App\Models\Page;

class DeletePage
{
    public function handle(Page $item): void
    {
        $childrenPages = $item->childrenPages;

        $item->delete();
        $item->slug()->delete();

        (new UpdateChildrenSlug())->handle($childrenPages);
    }
}
