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
              "foodImageUrl": "https://image.space.rakuten.co.jp/d/strg/ctrl/3/c16945a3103101b164d1b95214e5c2f8b13a5e7e.36.2.3.2.jpg",
              "mediumImageUrl": "https://image.space.rakuten.co.jp/d/strg/ctrl/3/c16945a3103101b164d1b95214e5c2f8b13a5e7e.36.2.3.2.jpg?thum=54",
              "nickname": "ハル　haru",
              "pickup": 0,
              "rank": "1",
              "recipeCost": "300円前後",
              "recipeDescription": "随分前からこの下処理の方法を利用していますが、処理をするとしないでは牡蠣のふっくら具合が違ってくると思います。是非お試しください。",
              "recipeId": 1820003517,
              "recipeIndication": "5分以内",
              "recipeMaterial": [
                "牡蠣",
                "塩",
                "片栗粉"
              ],
              "recipePublishday": "2011/10/15 19:59:10",
              "recipeTitle": "お魚屋さんに教わった、牡蠣の下処理の方法。",
              "recipeUrl": "https://recipe.rakuten.co.jp/recipe/1820003517/",
              "shop": 0,
              "smallImageUrl": "https://image.space.rakuten.co.jp/d/strg/ctrl/3/c16945a3103101b164d1b95214e5c2f8b13a5e7e.36.2.3.2.jpg?thum=55"
            },
            {
              "foodImageUrl": "https://image.space.rakuten.co.jp/d/strg/ctrl/3/9672a7e7cfbd1da82af6d46696777746d8662157.82.2.3.2.jpg",
              "mediumImageUrl": "https://image.space.rakuten.co.jp/d/strg/ctrl/3/9672a7e7cfbd1da82af6d46696777746d8662157.82.2.3.2.jpg?thum=54",
              "nickname": "nkkmarine",
              "pickup": 0,
              "rank": "2",
              "recipeCost": "500円前後",
              "recipeDescription": "海老マヨは、子供たちの大好きなメニューの1つで、練乳とか使うと更に美味しいんやけど、おうちにある調味料だけでも簡単に出来るので、みなさんも是非作ってみてね！",
              "recipeId": 1390032207,
              "recipeIndication": "約10分",
              "recipeMaterial": [
                "むきエビ（大きい海老の方が良い）",
                "酒",
                "片栗粉",
                "塩・胡椒",
                "サラダ油（オリーブオイルでもOK）",
                "レタスなど",
                "☆マヨダレ",
                "マヨネーズ",
                "ケチャップ",
                "牛乳",
                "砂糖",
                "※練乳の方がコクが出て美味しいのですが…"
              ],
              "recipePublishday": "2016/12/26 15:36:18",
              "recipeTitle": "手抜きでも簡単美味しい！ぷりぷり海老マヨ！！！",
              "recipeUrl": "https://recipe.rakuten.co.jp/recipe/1390032207/",
              "shop": 0,
              "smallImageUrl": "https://image.space.rakuten.co.jp/d/strg/ctrl/3/9672a7e7cfbd1da82af6d46696777746d8662157.82.2.3.2.jpg?thum=55"
            },
            {
              "foodImageUrl": "https://image.space.rakuten.co.jp/d/strg/ctrl/3/bf354c159f684b2f16ca1229c28a135e17040a46.32.2.3.2.jpg",
              "mediumImageUrl": "https://image.space.rakuten.co.jp/d/strg/ctrl/3/bf354c159f684b2f16ca1229c28a135e17040a46.32.2.3.2.jpg?thum=54",
              "nickname": "nyanpyow",
              "pickup": 1,
              "rank": "3",
              "recipeCost": "指定なし",
              "recipeDescription": "安いむきえびを使いますがすごく美味しいです（＾ｖ＾）そして超簡単です！おつまみに◎",
              "recipeId": 1490006111,
              "recipeIndication": "約10分",
              "recipeMaterial": [
                "むきえび",
                "☆にんにくチューブ",
                "☆オリーブオイル",
                "☆白ワイン",
                "☆塩",
                "☆ブラックペッパー"
              ],
              "recipePublishday": "2015/04/21 20:47:14",
              "recipeTitle": "うまっ！超簡単！☆ガーリックシュリンプ☆",
              "recipeUrl": "https://recipe.rakuten.co.jp/recipe/1490006111/",
              "shop": 0,
              "smallImageUrl": "https://image.space.rakuten.co.jp/d/strg/ctrl/3/bf354c159f684b2f16ca1229c28a135e17040a46.32.2.3.2.jpg?thum=55"
            },
            {
              "foodImageUrl": "https://image.space.rakuten.co.jp/d/strg/ctrl/3/7f82f7bf9c7e6915e28d7cca9060420f652d8e1a.75.2.3.2.jpg",
              "mediumImageUrl": "https://image.space.rakuten.co.jp/d/strg/ctrl/3/7f82f7bf9c7e6915e28d7cca9060420f652d8e1a.75.2.3.2.jpg?thum=54",
              "nickname": "fukuwajutu",
              "pickup": 1,
              "rank": "4",
              "recipeCost": "300円前後",
              "recipeDescription": "めんつゆとみりんで餡を作ると、簡単に割烹の味に!? 淡泊な味の鱈も、たっぷり野菜餡で立派な和のおかず♪水菜と人参、鷹の爪が彩りよく、見た目も楽しい一品です。",
              "recipeId": 1830004236,
              "recipeIndication": "約15分",
              "recipeMaterial": [
                "鱈（甘塩）",
                "長ネギ",
                "人参",
                "水菜",
                "えのき",
                "胡椒",
                "めんつゆ（3倍濃縮タイプ使用）",
                "みりん",
                "水",
                "片栗粉",
                "鷹の爪",
                "サラダオイル"
              ],
              "recipePublishday": "2013/12/09 23:23:43",
              "recipeTitle": "めんつゆとみりんで割烹の味★鱈の彩り野菜あん",
              "recipeUrl": "https://recipe.rakuten.co.jp/recipe/1830004236/",
              "shop": 0,
              "smallImageUrl": "https://image.space.rakuten.co.jp/d/strg/ctrl/3/7f82f7bf9c7e6915e28d7cca9060420f652d8e1a.75.2.3.2.jpg?thum=55"
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

            $menu->category_id = 11;
            $menu->user_id = 1;
            $menu->step = '';
            $menu->menu_name = $recipe->recipeTitle;
            $menu->image_path = $img_name;
            $menu->description = $recipe->recipeDescription;
            $menu->menu_release = '';
            $menu->save();

            $menu = new Ingredient();
            //材料
            $ingredient = [];
            foreach($recipe->recipeMaterial as $material) {
                $ingredient[] = [
                    $material, // 材料名
                    // ''         // 単位
                ];
            }
            $menu->menu_id = '';
            $menu->ingredient_name = json_encode($ingredient);
            $menu->unit = '';
            $menu->save();
        }
    }
}
