<?php

namespace Phpleaks\Http\Middleware;

use Closure;
use Cache;

class Trending
{

    public function handle($request, Closure $next)
    {
        if (Cache::has('trending')) {
            $stats = Cache::get('trending');
        } else {
            $stats = file_get_contents('http://api.clicky.com/api/stats/4?site_id=100870004&sitekey=f5173ea2aad973c1&type=pages&output=json&date=last-30-days&limit=100');
            Cache::put('trending', $stats, 60);
        }


        $array = json_decode($stats, true);
        foreach ($array as $array) {
            foreach ($array['dates'] as $array) {
                foreach ($array['items'] as $array) {
                    if (strpos($array['url'], '/link/') !== false and strpos($array['url'], '/create') == false) {
                        $trending[] = '<tr><td><span class="glyphicon glyphicon-link"></span> <a href="' . $array['url'] . '">' . str_replace('http://devleaks.com/link/',
                                '', $array['url']) . '</a></tr></td>';
                    }
                }
            }
        }

        $request['trending'] = $trending;

        return $next($request);
    }
}
