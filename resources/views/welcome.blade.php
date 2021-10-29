<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        @php
//         $json = json_decode('', true);

// use App\Models\Menu;
//     $array = $json['result'];
//     for($i=0; $i<sizeof($json['result']); $i++){
//         $menu = new Menu();
//         $menu->recipe_category_id = 49;
//         $menu->user_id = 1;
//         $menu->step = '';
//         $menu->seasoning = '';
//         $menu->menu_name = $array[$i]['recipeTitle'];
//         $menu->image_path = $array[$i]['foodImageUrl'];
//         $menu->description = $array[$i]['recipeDescription'];
//         $menu->ingredient = implode(',', $array[$i]['recipeMaterial']);
//         $menu->save();
//     }
        @endphp
    </body>
</html>
