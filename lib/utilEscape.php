<!-- 引数に対してhtmlspecialchars()を実行する -->
<?php
//XSS(クロスサイトスクリプティング)対策のためのHTMLエスケープ
function es($data)
{
    //引数$dataが配列の時
    if (is_array($data)) {
        //再起呼び出し（値を１つずつ引数にして再起呼び出しをする。）
        //__METHOD__は現在実行中のメソッド自身を指す特殊な定数（マジック定数）ここではes()を指す
        return array_map(__METHOD__, $data);
    } else {
        //HTMLエスケープを行う
        return htmlspecialchars($data, ENT_QUOTES, "UTF-8");
    }
}
?>