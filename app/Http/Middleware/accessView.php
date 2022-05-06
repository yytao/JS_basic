<?php
/**
 * Created by PhpStorm.
 * User: taoyy
 */

namespace App\Http\Middleware;
use Closure;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redis;

class accessView {

    /*
     * 判断用户是否登陆
     */
    public function handle($request, Closure $next){

        //验证是否有历史授权
        if(Cookie::get('salt') != '' && Cookie::get('signature') == Redis::get(Cookie::get('salt'))){

            //只要进入此分支，则判断成功
            return $next($request);

        }else{

            return redirect('/login');
        }

        return $next($request);
    }
}
