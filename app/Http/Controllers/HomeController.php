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

        $now = Carbon::now();
        $month = $now->month;
        $year = $now->year;
        $day = $now->day;
        $carbon = $now;
        $w = $request->get('w');
        if(isset($w) && is_numeric($w)) {
            $w = intval($w);
            $carbon->addWeeks($w);
            $before = $w-1;
            $after = $w+1;
        } else {
            $before = -1;
            $after = 1;
        }

        $skip = $carbon->dayOfWeek;
        $carbon->subDays($skip);
        for($i=0; $i<=6; $i++) {
            $text = $carbon->month. "月". $carbon->day. "日";
            if($carbon->month == $month && $carbon->year == $year && $carbon->day == $day)
                $text .= "\n[今日]";
            $carbon->addDay();
            $w_day[] = $text;
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
