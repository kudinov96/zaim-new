<?php

namespace App\Actions\Slug;

use App\Models\Slug;
use Illuminate\Database\Eloquent\Collection;

class UpdateChildrenSlug
{
    private UpdateSlug $updateSlug;

    public function __construct()
    {
        $this->updateSlug = new UpdateSlug();
    }

    public function handle(Collection $childrenPages)
    {
        foreach ($childrenPages as $childrenPage) {
            $this->updateSlug->handle($childrenPage, Slug::generateSlugFull($childrenPage->slug_single, $childrenPage->parent));

            if ($childrenPage->childrenPages) {
                $this->handle($childrenPage->childrenPages);
            }
        }
    }
}
