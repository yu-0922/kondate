'use strict';

// 材料追加
let inputPlural = document.getElementById('input_plural');

function add() {
    var count = 0;

    let div = document.createElement('DIV');
    div.classList.add('d-flex');

    var input = document.createElement('INPUT');
    input.classList.add('form-control');
    input.setAttribute('name', 'ing_name[]');
    div.appendChild(input);

    var input = document.createElement('INPUT');
    input.classList.add('form-control');
    input.setAttribute('name', 'ing_size[]');
    div.appendChild(input);

    var input = document.createElement('INPUT');
    input.setAttribute('type', 'button');
    input.setAttribute('value', '削除');
    input.setAttribute('onclick', 'del(this)');
    div.appendChild(input);

    inputPlural.appendChild(div);
    count++;
}

// 手順追加
let inputPlural2 = document.getElementById('input_plural2');

function addStep() {
    var count = 0;

    let div = document.createElement('DIV');
    div.classList.add('d-flex');

    var input = document.createElement('INPUT');
    input.classList.add('form-control');
    input.setAttribute('name', 'step[]');
    div.appendChild(input);

    var input = document.createElement('INPUT');
    input.setAttribute('type', 'button');
    input.setAttribute('value', '削除');
    input.setAttribute('onclick', 'del(this)');
    div.appendChild(input);

    inputPlural2.appendChild(div);
    count++;
}

// モーニング追加
// let inputPlural3 = document.getElementById('input_plural3');

// function addMorning() {
//     var count = 0;

//     let div = document.createElement('DIV');
//     div.classList.add('d-flex');

//     var select = document.createElement('SELECT');
//     select.classList.add('form-control');
//     select.setAttribute('id', 'inputMorning');
//     select.setAttribute('name', 'morning_recipe');
//     div.appendChild(select);

//     var option = document.createElement('OPTION');
//     option.setAttribute('value', '');
//     div.appendChild(option);

//     var input = document.createElement('INPUT');
//     input.setAttribute('type', 'button');
//     input.setAttribute('value', '削除');
//     input.setAttribute('onclick', 'del(this)');
//     div.appendChild(input);

//     inputPlural3.appendChild(div);
//     count++;
// }

function del(o) {
    o.parentNode.remove();
}

// モーダルウィンドウ
// $(function () {
//     $('.js-open').on('click', function () {
//         $('#overlay, .modal-window').fadeIn();
//     });
//     $('.js-close, #overlay').on('click', function () {
//         $('#overlay, .modal-window').fadeOut();
//     });
// });

//初期化することでformのresetとinputのchangeイベントにリスナが追加→選択したファイルが表示される
bsCustomFileInput.init();

// ファイル削除
if(document.getElementById('inputFileReset') !== null){
    document.getElementById('inputFileReset').addEventListener('click', function() {
        bsCustomFileInput.destroy();

        var elem = document.getElementById('inputFile');
        elem.value = '';
        var clone = elem.cloneNode(false);
        elem.parentNode.replaceChild(clone, elem);

        bsCustomFileInput.init();
    });
}
