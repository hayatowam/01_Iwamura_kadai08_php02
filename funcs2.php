<?php
//共通に使う関数を記述

//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

//この関数を使うには、別のファイルで読み込む必要がある
// phpは閉じタグをなくてもワークする


// test