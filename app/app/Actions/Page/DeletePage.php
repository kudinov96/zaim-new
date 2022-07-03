<?php

namespace App\Actions\Page;

use App\Actions\Slug\UpdateChildrenSlug;
use App\Models\Page;
use Illuminate\Support\Facades\DB;

class DeletePage
{
    public function handle(Page $item): void
    {
        $childrenPages = $item->childrenPages;

        DB::transaction(function () use ($item, $childrenPages) {
            $item->purgeMeta();
            $item->slug()->delete();
            $item->delete();

            (new UpdateChildrenSlug())->handle($childrenPages);
        });
    }
}
