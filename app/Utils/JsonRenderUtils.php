<?php

namespace App\Utils;

class JsonRenderUtils
{
    public static function setDisplayRecursive(&$json, $currentDepth, $userDepth)
    {
        foreach ($json as &$jsonItem) {
            $currentDepth == $userDepth ? $jsonItem['display'] = 'none' : $jsonItem['display'] = '';
            self::setDisplayRecursive($jsonItem['children'], $currentDepth + 1, $userDepth);
        }
    }

    public static function getMaxDepth($json): int
    {
        $max_depth = 1;
        foreach ($json as $jsonItem) {
            if ($jsonItem['children']) {
                $depth = self::getMaxDepth($jsonItem['children']) + 1;
                if ($depth > $max_depth) {
                    $max_depth = $depth;
                }
            }
        }

        return $max_depth;
    }
}
