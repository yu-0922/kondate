<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\RecipeCategory;
use Facades\App\Models\Recipe;
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $menus = Menu::paginate(15);
        return view('recipes.create',[
            'menus' => $menus,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'cooking_day' => 'required|date',
            'recipe_time' => 'required',
            'menu_id' => 'max:255',
        ]);

        $cooking_day = $request->get('cooking_day');
        $recipe_time = $request->get('recipe_time');
        $menu_id = $request->get('menu_id');

        Recipe::create(
            $cooking_day,
            $recipe_time,
            $menu_id
        );

        return redirect()->route('home.store', [
            'cooking_day' => $cooking_day,
            'recipe_time' => $recipe_time,
            'menu_id' => $menu_id
        ]);

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
            $today = $year. "-". $month. "-". $day;
            // 0埋めして日付を取得
            $d = sprintf("%04d", $carbon->year). '-'. sprintf("%02d", $carbon->month). "-". sprintf("%02d", $carbon->day);
            $date[] = $d;
            $date[] = $text;
            $date[] = \App\Models\Recipe::where('cooking_day', $d)->get();
            $carbon->addDay();
            $w_day[] = $date;
        }

        $categories = RecipeCategory::orderBy('created_at', 'desc')->get();

        $menu_name = $request->get("menu_name");
        //requestから取得したmenu_nameが空なら全てのメニューを表示、空でなければ該当の者を表示
        if (empty($menu_name)) {
            $query = Menu::query();
        } else {
            $query = Menu::where("menu_name", "LIKE", "%$menu_name%");
        }
        //新しい順に並び替え、1ページあたり10件表示
        $menus = $query->orderBy('created_at', 'desc')->paginate(20);


        return view('home', [
            'week_names' => $week_names,
            'carbon' => $carbon,
            'before' => $before,
            'after' => $after,
            'w_day' => $w_day,
            'today' => $today,
            'categories' => $categories,
            'menus' => $menus
        ]);
    }

    public function destroy(Request $request)
    {
        $recipe = Recipe::find($request->id);
        $recipe->delete();

        return redirect()->route('home');
    }
}
