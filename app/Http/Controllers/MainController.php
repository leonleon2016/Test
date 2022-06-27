<?php

namespace App\Http\Controllers;

use App\Http\Requests\RenderJsonRequest;
use App\Utils\JsonRenderUtils;

class MainController extends Controller
{
    public function renderJsonHtml(RenderJsonRequest $request)
    {
        $validatedRequest = $request->validated();
        $background = $validatedRequest['background'] ?? "rgb(255,255,255)";
        $json = json_decode($validatedRequest['json'], true);
        $depth = $validatedRequest['depth'] ?? 1;
        if($depth == 'max') {
            $depth = JsonRenderUtils::getMaxDepth($json["content"]);
        }
        JsonRenderUtils::setDisplayRecursive($json["content"], 1, $depth);

        return view('renderJsonHtml',
            [
                'json' => $json["content"],
                'background' => $background,
                'isBackgroundUrl' => filter_var($background, FILTER_VALIDATE_URL),

            ]
        );
    }
}
