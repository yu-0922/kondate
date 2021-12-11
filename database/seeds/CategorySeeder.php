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
        Category::create(["category_name" => "肉料理"]);
        Category::create(["category_name" => "魚料理"]);
        Category::create(["category_name" => "野菜"]);
        Category::create(["category_name" => "その他の食材"]);
        Category::create(["category_name" => "ご飯もの"]);
        Category::create(["category_name" => "パスタ"]);
        Category::create(["category_name" => "麺・粉物料理"]);
        Category::create(["category_name" => "汁物・スープ"]);
        Category::create(["category_name" => "サラダ"]);
        Category::create(["category_name" => "ソース・調味料・ドレッシング"]);
        Category::create(["category_name" => "お弁当"]);
        Category::create(["category_name" => "お菓子"]);
        Category::create(["category_name" => "パン"]);
        Category::create(["category_name" => "鍋料理"]);
        Category::create(["category_name" => "西洋料理"]);
        Category::create(["category_name" => "飲みもの"]);
        Category::create(["category_name" => "人気メニュー"]);
        Category::create(["category_name" => "定番の肉料理"]);
        Category::create(["category_name" => "定番の魚料理"]);
        Category::create(["category_name" => "卵料理"]);
        Category::create(["category_name" => "果物"]);
        Category::create(["category_name" => "大豆・豆腐"]);
        Category::create(["category_name" => "簡単料理・時短"]);
        Category::create(["category_name" => "節約料理"]);
        Category::create(["category_name" => "健康料理"]);
        Category::create(["category_name" => "中華料理"]);
        Category::create(["category_name" => "韓国料理"]);
        Category::create(["category_name" => "イタリア料理"]);
        Category::create(["category_name" => "フランス料理"]);
        Category::create(["category_name" => "エスニック料理・中南米"]);
    }
}
