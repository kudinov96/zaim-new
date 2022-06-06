<?php

namespace App\Actions\Page;

use App\Http\Requests\Page\CreatePageRequest;
use App\Models\Page;

class CreatePage
{
    public function handle(CreatePageRequest $request): Page
    {
        $item                    = new Page();
        $item->title             = $request->title;
        $item->template          = $request->template;
        $item->content           = $request->content;
        $item->visibility_status = $request->visibility_status;

        $item->save();

        return $item;
    }
}
