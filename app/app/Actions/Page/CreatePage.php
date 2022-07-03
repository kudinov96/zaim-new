<?php

namespace App\Actions\Page;

use App\Actions\Slug\CreateSlug;
use App\Http\Requests\Page\CreatePageRequest;
use App\Models\Page;
use Illuminate\Support\Facades\DB;

class CreatePage
{
    public function handle(CreatePageRequest $request): Page
    {
        $item                    = new Page();
        $item->title             = $request->title;
        $item->template          = $request->template;
        $item->content           = $request->content;
        $item->parent_id         = $request->parent_id;
        $item->visibility_status = $request->visibility_status;

        DB::transaction(function () use ($item, $request) {
            $item->save();
            $item->setManyMeta($request->metas);

            (new CreateSlug())->handle($item, $request->slug_full);
        });

        return $item;
    }
}
