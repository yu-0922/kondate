<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Request $request)
    {
        $week_names = ['日', '月', '火', '水', '木', '金', '土'];
        //今日の年月日を取得して$carbonに代入
        $now = Carbon::now();
        $year = $now->year;
        $month = $now->month;
        $day = $now->day;
        $carbon = $now;

        $w = $request->get('w');
        if(isset($w) && is_numeric($w)) {
            $w = intval($w);
            //指定した週を追加
            $carbon->addWeeks($w);
            $before = $w-1;
            $after = $w+1;
        } else {
            $before = -1;
            $after = 1;
        }
        //曜日番号を取得
        $skip = $carbon->dayOfWeek;
        //取得した曜日番号の分だけ日数を減らす
        $carbon->subDays($skip);

        for($i=0; $i<=6; $i++) {
            $date = [];
            $text = $carbon->month. "月". $carbon->day. "日";
            if($carbon->year == $year && $carbon->month == $month && $carbon->day == $day)
                $text .= "\n[今日]";
            $date[] = $carbon->year. '-'. $carbon->month. "-". $carbon->day;
            $date[] = $text;
            $carbon->addDay();
            $w_day[] = $date;
        }

        $favorites = Auth::user()->favorites(Menu::class)->get('menu_id');

        return view('home', [
            'week_names' => $week_names,
            'carbon' => $carbon,
            'before' => $before,
            'after' => $after,
            'w_day' => $w_day,
            'favorites' => $favorites,
        ]);
    }
}
