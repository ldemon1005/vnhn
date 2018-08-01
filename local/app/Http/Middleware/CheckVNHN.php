<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Model\News;
class CheckVNHN
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $news = News::find($request->id);
        $group_id = explode(',', $news->groupid);
        $group_id_auth = explode(',', Auth::user()->group_id);
        if (in_array(0, $group_id_auth)) {
            return $next($request);
        }
        $count = 0;
        foreach ($group_id as $group_item) {
            foreach ($group_id_auth as $group_item_auth) {
                if ($group_item == $group_item_auth) {
                    $count++;
                }
            }
        }
        if ($count == 0) {
            return redirect('admin');
        }
        else{
            return $next($request);
        }
        
    }
}
