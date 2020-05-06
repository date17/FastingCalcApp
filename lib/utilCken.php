<!-- 文字エンコードのチェックを行う -->
<?php
function cken(array $data)
{
    $result = true;
    foreach ($data as $key => $value) {
        //含まれている値が配列の時文字列に連結する
        if (is_array($value)) {
            //配列に入っている値を連結したストリングにしてチェックする
            $value = implode("", $value);
        }
        if (!mb_check_encoding($value)) {
            //文字エンコードが一致しない時
            $result = false;
            //foreachでの操作をブレイクする
            break;
        }
    }
    return $result;
}
?>