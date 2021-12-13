<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(["id" => "10", "category_name" => "肉"]);
        Category::create(["id" => "11", "category_name" => "魚"]);
        Category::create(["id" => "12", "category_name" => "野菜"]);
        Category::create(["id" => "13", "category_name" => "その他の食材"]);
        Category::create(["id" => "14", "category_name" => "ご飯もの"]);
        Category::create(["id" => "15", "category_name" => "パスタ"]);
        Category::create(["id" => "16", "category_name" => "麺・粉物料理"]);
        Category::create(["id" => "17", "category_name" => "汁物・スープ"]);
        Category::create(["id" => "18", "category_name" => "サラダ"]);
        Category::create(["id" => "19", "category_name" => "ソース・調味料・ドレッシング"]);
        Category::create(["id" => "20", "category_name" => "お弁当"]);
        Category::create(["id" => "21", "category_name" => "お菓子"]);
        Category::create(["id" => "22", "category_name" => "パン"]);
        Category::create(["id" => "23", "category_name" => "鍋料理"]);
        Category::create(["id" => "25", "category_name" => "西洋料理"]);
        Category::create(["id" => "27", "category_name" => "飲みもの"]);
        Category::create(["id" => "30", "category_name" => "人気メニュー"]);
        Category::create(["id" => "31", "category_name" => "定番の肉料理"]);
        Category::create(["id" => "32", "category_name" => "定番の魚料理"]);
        Category::create(["id" => "33", "category_name" => "卵料理"]);
        Category::create(["id" => "34", "category_name" => "果物"]);
        Category::create(["id" => "35", "category_name" => "大豆・豆腐"]);
        Category::create(["id" => "36", "category_name" => "簡単料理・時短"]);
        Category::create(["id" => "37", "category_name" => "節約料理"]);
        Category::create(["id" => "39", "category_name" => "健康料理"]);
        Category::create(["id" => "41", "category_name" => "中華料理"]);
        Category::create(["id" => "42", "category_name" => "韓国料理"]);
        Category::create(["id" => "43", "category_name" => "イタリア料理"]);
        Category::create(["id" => "44", "category_name" => "フランス料理"]);
        Category::create(["id" => "46", "category_name" => "エスニック料理・中南米"]);
    }
}
