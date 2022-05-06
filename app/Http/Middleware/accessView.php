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
        if(Cookie::get('openid') != '' && Cookie::get('openid') == Redis::get(Cookie::get('openid'))){
            //if(1==1){//本地测试时打开
            $user = IndexUsers::find(Cookie::get('user_id'));

            if(empty($user)){
                Cookie::queue(Cookie::forget('openid'));
                return redirect('/login');
            }

            return redirect('/');
        }else{

            return redirect('/login');
        }

        return $next($request);
    }
}
