<?php

namespace App\Actions\Page;

use App\Http\Requests\Page\CreatePageRequest;
use App\Models\Page;

class UpdatePage
{
    public function handle(Page $item, CreatePageRequest $request): Page
    {
        $item->title             = $request->title;
        $item->template          = $request->template;
        $item->content           = $request->content;
        $item->visibility_status = $request->visibility_status;

        $item->save();

        return $item;
    }
}
