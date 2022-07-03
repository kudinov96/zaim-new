<?php

namespace App\Actions\Page;

use App\Actions\Slug\UpdateChildrenSlug;
use App\Actions\Slug\UpdateSlug;
use App\Http\Requests\Page\UpdatePageRequest;
use App\Models\Page;
use Illuminate\Support\Facades\DB;

class UpdatePage
{
    public function handle(Page $item, UpdatePageRequest $request): Page
    {
        $item->title             = $request->title;
        $item->template          = $request->template;
        $item->content           = $request->content;
        $item->parent_id         = $request->parent_id;
        $item->visibility_status = $request->visibility_status;

        DB::transaction(function () use ($item, $request) {
            $item->save();
            $item->syncMeta($request->metas);

            if ($item->slug_full !== $request->slug_full) {
                (new UpdateChildrenSlug())->handle($item->childrenPages);
            }

            (new UpdateSlug())->handle($item, $request->slug_full);
        });


        return $item;
    }
}
