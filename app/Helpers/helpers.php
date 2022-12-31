<?php

if (!function_exists('activeSegment')) {
    function activeSegment($uri = '')
    {
        $active = '';
        if (Request::is(Request::segment(1).'/'.$uri.'/*') || Request::is(Request::segment(1).'/'.$uri) || Request::is($uri)) {
            $active = 'active';
        }

        return $active;
    }
}
