<?php

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Ingredient;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = '{"result": [
            {
              "foodImageUrl": "https://image.space.rakuten.co.jp/d/strg/ctrl/3/fbd7dd260d736654532e6c0b1ec185a0cede8675.49.2.3.2.jpg",
              "mediumImageUrl": "https://image.space.rakuten.co.jp/d/strg/ctrl/3/fbd7dd260d736654532e6c0b1ec185a0cede8675.49.2.3.2.jpg?thum=54",
              "nickname": "はぁぽじ",
              "pickup": 0,
              "rank": "1",
              "recipeCost": "300円前後",
              "recipeDescription": "そのままでも、ご飯にのせて丼にしても♪",
              "recipeId": 1760028309,
              "recipeIndication": "約10分",
              "recipeMaterial": [
                "鶏むね肉",
                "塩",
                "酒",
                "片栗粉",
                "水",
                "塩",
                "鶏がらスープの素",
                "黒胡椒",
                "長ネギ",
                "いりごま",
                "ごま油"
              ],
              "recipePublishday": "2017/10/10 22:37:34",
              "recipeTitle": "ご飯がすすむ！鶏むね肉のねぎ塩焼き",
              "recipeUrl": "https://recipe.rakuten.co.jp/recipe/1760028309/",
              "shop": 0,
              "smallImageUrl": "https://image.space.rakuten.co.jp/d/strg/ctrl/3/fbd7dd260d736654532e6c0b1ec185a0cede8675.49.2.3.2.jpg?thum=55"
            },
            {
              "foodImageUrl": "https://image.space.rakuten.co.jp/d/strg/ctrl/3/3e5906a3607b2f1321cda1158b251c4223204420.40.2.3.2.jpg",
              "mediumImageUrl": "https://image.space.rakuten.co.jp/d/strg/ctrl/3/3e5906a3607b2f1321cda1158b251c4223204420.40.2.3.2.jpg?thum=54",
              "nickname": "*ももら*",
              "pickup": 1,
              "rank": "2",
              "recipeCost": "300円前後",
              "recipeDescription": "鶏胸肉なのにウイング風♬骨が無いので食べ易くお弁当にもピッタリ♡油で揚げないのでヘルシーです♪",
              "recipeId": 1400014946,
              "recipeIndication": "約10分",
              "recipeMaterial": [
                "鶏むね肉",
                "片栗粉",
                "塩コショウ",
                "炒め用サラダ油",
                "醤油",
                "みりん",
                "お酒",
                "砂糖"
              ],
              "recipePublishday": "2015/09/30 14:28:09",
              "recipeTitle": "鶏胸肉で簡単♪手羽風揚げない甘辛照焼チキンお弁当に",
              "recipeUrl": "https://recipe.rakuten.co.jp/recipe/1400014946/",
              "shop": 0,
              "smallImageUrl": "https://image.space.rakuten.co.jp/d/strg/ctrl/3/3e5906a3607b2f1321cda1158b251c4223204420.40.2.3.2.jpg?thum=55"
            },
            {
              "foodImageUrl": "https://image.space.rakuten.co.jp/d/strg/ctrl/3/aedd5fa798b463b0371dceb8e3d0f529e4dc1b48.79.2.3.2.jpg",
              "mediumImageUrl": "https://image.space.rakuten.co.jp/d/strg/ctrl/3/aedd5fa798b463b0371dceb8e3d0f529e4dc1b48.79.2.3.2.jpg?thum=54",
              "nickname": "く〜-Qoo-",
              "pickup": 0,
              "rank": "3",
              "recipeCost": "500円前後",
              "recipeDescription": "好評の為レシピを分かりやすくしました。分量を多少変更しました。（２０１３年３月）以前載せていたポテサラパケットはレシピID: 1590004701です。",
              "recipeId": 1590002716,
              "recipeIndication": "約1時間",
              "recipeMaterial": [
                "ハンバーグ材料",
                "牛豚合びき肉",
                "豚ひき肉",
                "玉ねぎ",
                "パン粉",
                "卵",
                "塩",
                "胡椒",
                "マヨネーズ",
                "合わせ味噌",
                "ナツメグ",
                "コーヒーフレッシュ",
                "ハンバーグソース材料",
                "玉ねぎ",
                "みかんやオレンジの果汁",
                "水",
                "醤油",
                "料理酒",
                "みりん",
                "サラダ",
                "大根",
                "人参",
                "レタスか白菜",
                "サウザンドレッシング（ダイムドレ代用）",
                "醤油マヨ",
                "炒りごま",
                "ミニトマト"
              ],
              "recipePublishday": "2012/01/27 21:13:53",
              "recipeTitle": "元店長がこっそり教えるびっくり◯ンキーのハンバーグ",
              "recipeUrl": "https://recipe.rakuten.co.jp/recipe/1590002716/",
              "shop": 0,
              "smallImageUrl": "https://image.space.rakuten.co.jp/d/strg/ctrl/3/aedd5fa798b463b0371dceb8e3d0f529e4dc1b48.79.2.3.2.jpg?thum=55"
            },
            {
              "foodImageUrl": "https://image.space.rakuten.co.jp/d/strg/ctrl/3/86c80c740d2391d75772e27b6f3f4652475f07c5.12.2.3.2.jpg",
              "mediumImageUrl": "https://image.space.rakuten.co.jp/d/strg/ctrl/3/86c80c740d2391d75772e27b6f3f4652475f07c5.12.2.3.2.jpg?thum=54",
              "nickname": "みさきらりんず",
              "pickup": 0,
              "rank": "4",
              "recipeCost": "300円前後",
              "recipeDescription": "具材はたっぷりの白菜と少しの豚肉のみ♫寒い季節にぴったりなとろ〜りあんかけです(*´꒳`*)鶏ガラスープの素とオイスターソースで中華味に仕上げました♡",
              "recipeId": 1510021232,
              "recipeIndication": "約15分",
              "recipeMaterial": [
                "白菜",
                "豚薄切り肉",
                "水",
                "みりん",
                "醤油",
                "オイスターソース",
                "鶏ガラスープ",
                "砂糖",
                "ごま油",
                "片栗粉",
                "水"
              ],
              "recipePublishday": "2019/01/13 10:38:17",
              "recipeTitle": "節約☆簡単☆白菜と豚肉の中華あんかけ",
              "recipeUrl": "https://recipe.rakuten.co.jp/recipe/1510021232/",
              "shop": 0,
              "smallImageUrl": "https://image.space.rakuten.co.jp/d/strg/ctrl/3/86c80c740d2391d75772e27b6f3f4652475f07c5.12.2.3.2.jpg?thum=55"
            }
          ]
        }';
        $recipe = json_decode($json);

        foreach ($recipe->result as $recipe) {
            $menu = new Menu();
            $url = $recipe->foodImageUrl;
            $img = file_get_contents($url);
            $imginfo = pathinfo($url);
            $img_name = $imginfo['basename'];
            //画像を保存
            file_put_contents(storage_path(). '/app/public/images/'. $img_name, $img);

            $menu->category_id = 10;
            $menu->user_id = 1;
            $menu->step = '';
            $menu->menu_name = $recipe->recipeTitle;
            $menu->image_path = $img_name;
            $menu->description = $recipe->recipeDescription;
            $menu->menu_release = '';
            // $menu->save();

            $menu = new Ingredient();
            //材料
            $ingredient = [];
            foreach($recipe->recipeMaterial as $material) {
                $ingredient[] = [
                    $material, // 材料名
                    // ''         // 単位
                ];
            }
            $menu->menu_id = '0';
            $menu->ingredient_name = json_encode($ingredient);
            // $menu->ingredient_name = $recipe->recipeMaterial;
            $menu->unit = '';
            $menu->save();
        }
    }
}
