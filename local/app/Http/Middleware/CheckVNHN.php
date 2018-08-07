<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Model\News;
use App\Model\Group_vn;

use DB;
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
        if ($request->id == 0) {
            return $next($request);
        }
        $news = News::find($request->id);
        $group_id = explode(',', $news->groupid);



        $group_id_auth = explode(',', Auth::user()->group_id);


        $list_group = Group_vn::where('status', 1)->where(function ($query) use ($group_id_auth){
                $query->whereIn('id',$group_id_auth)
                      ->orWhereIn('parentid',$group_id_auth);
            })->get();

        


        foreach ($list_group as $group) {
            $group_id_auth[] = (int)$group->id;
        }

        
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
