<?php

namespace App\Http\Controllers;

use App\Http\Requests\RenderJsonRequest;
use App\Rules\DepthCheckRule;
use App\Rules\JsonCheckRule;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function setDisplayRecursive(&$json, $currentDepth, $userDepth)
    {
        foreach ($json  as &$jsonItem) {
            $currentDepth == $userDepth ? $jsonItem['display'] = 'none': $jsonItem['display'] = '';
            self::setDisplayRecursive($jsonItem['children'], $currentDepth + 1, $userDepth);
        }
    }

    public function renderJsonHtml(RenderJsonRequest $request)
    {
        $validatedRequest = $request->validated();
        $depth = $validatedRequest['depth'] ?? 1;
        $background = $validatedRequest['background'] ?? "rgb(255,255,255)";
        $json = json_decode($validatedRequest['json'], true);
        self::setDisplayRecursive($json["content"], 1, $depth);

        return view('renderJsonHtml',
            [
                'json' => $json["content"],
                'background' => $background,
                'isBackgroundUrl' => filter_var($background, FILTER_VALIDATE_URL),

            ]
        );
    }
}
