// 初期設定
$(document).ready(function() {
    // 初期設定
    ini();

    // イベント追加
    addEvent();
});

// 初期設定
const ini = function() {
    // メールアドレス
    const ma = String.fromCharCode(104,105,116,111,114,105,103,111,116,111,52,52,64,103,109,97,105,108,46,99,111,109);
    document.getElementById("target").textContent = ma;

    // Twitter
    const tw = String.fromCharCode(64,112,108,101,105,97,100,101,115,95,98,111,120);
    document.getElementById("testes").textContent = tw;
}

// イベント追加
const addEvent = function() {
    $("#btnShowPass").on('click', function() {
        $("#pass").removeClass("transparent");
    });
}
