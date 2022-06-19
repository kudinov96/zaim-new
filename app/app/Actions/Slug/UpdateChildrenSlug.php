<?php

namespace App\Actions\Slug;

use App\Models\Page;
use Illuminate\Database\Eloquent\Collection;

class UpdateChildrenSlug
{
    public function handle(Collection $childrenPages)
    {
        foreach ($childrenPages as $childrenPage) {
            (new UpdateSlug())->handle($childrenPage, Page::generateSlugFull($childrenPage->slug_single, $childrenPage->parent_id));

            if ($childrenPage->childrenPages) {
                $this->handle($childrenPage->childrenPages);
            }
        }
    }
}
