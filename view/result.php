<!-- 入力されたデータを元にインスタンスを生成し、計算を行いその結果を表示するページ -->

<!-- 入力されたデータのエンコードやhtmlエスケープを行う -->
<?php
//ファイルを読み込む
require_once("../lib/utilEscape.php");
require_once("../lib/utilCken.php");
//文字エンコードの検証
if (!cken($_POST)) {
    $encoding = mb_internal_encoding();
    $err = "Encoding Error! The expected encoding is " + $encoding;
    //エラーメッセージを出して、以下のコードを全てキャンセルする
    exit($err);
}
//HTMLエスケープ（xss対策）
$_POST = es($_POST);
?>

<?php
//エラーフラグ
$isErrorSex = false;
$isErrorWeight = false;
$isErrorFat = false;
$inputErrors = [
    "sexNo" => [
        "bool" => false,
        "message" => []
    ],
    "weight" => [
        "bool" => false,
        "message" => []
    ],
    "fatPercentage" => [
        "bool" => false,
        "message" => []
    ]
];

//性別を取り出す
if (isset($_POST["sexNo"])) {
    $sexNo = trim($_POST["sexNo"]);
    if ($sexNo === "") {
        //空白の時エラー
        $inputErrors["sexNo"]["bool"] = true;
        $inputErrors["sexNo"]["message"][] = "性別の入力が空です";
    }
} else {
    //未設定の時エラー
    $inputErrors["sexNo"]["bool"] = true;
    $inputErrors["sexNo"]["message"][] = "性別が未設定です";
}
//体重を取り出す
if (isset($_POST["weight"])) {
    $weight = trim($_POST["weight"]);
    if ($weight === "") {
        //空白の時エラー
        $inputErrors["weight"]["bool"] = true;
        $inputErrors["weight"]["message"][] = "体重の入力が空です";
    }
} else {
    //未設定の時エラー
    $inputErrors["weight"]["bool"] = true;
    $inputErrors["weight"]["message"][] = "体重が未設定です";
}
//体脂肪率を取り出す
if (isset($_POST["fatPercentage"])) {
    $fatPercentage = trim($_POST["fatPercentage"]);
    if ($fatPercentage === "") {
        //空白の時エラー
        $inputErrors["fatPercentage"]["bool"] = true;
        $inputErrors["fatPercentage"]["message"][] = "体脂肪率の入力が空です";
    }
} else {
    //未設定の時エラー
    $inputErrors["fatPercentage"]["bool"] = true;
    $inputErrors["fatPercentage"]["message"][] = "体脂肪率が未設定です";
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>計算結果</title>
    <link rel="stylesheet" href="../css/result.css">
</head>

<body>
    <header>
        <div class="title">計算結果</div>
    </header>
    <main>
        <?php
        if ($inputErrors["sexNo"]["bool"] === true || $inputErrors["weight"]["bool"] === true || $inputErrors["fatPercentage"]["bool"] === true) {
        ?>
            <div class="errors">
                <?php if ($inputErrors["sexNo"]["bool"]) { ?>
                    <div class="error">
                        <?php
                        foreach ($inputErrors["sexNo"]["message"] as $error) {
                            echo $error;
                        }
                        ?>
                    </div>
                <?php } ?>
                <?php if ($inputErrors["weight"]["bool"]) { ?>
                    <div class="error">
                        <?php
                        foreach ($inputErrors["weight"]["message"] as $error) {
                            echo $error;
                        }
                        ?>
                    </div>
                <?php } ?>
                <?php if ($inputErrors["fatPercentage"]["bool"]) { ?>
                    <div class="error">
                        <?php
                        foreach ($inputErrors["fatPercentage"]["message"] as $error) {
                            echo $error;
                        }
                        ?>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
        <?php
        require_once("../calc.php");

        if ($inputErrors["sexNo"]["bool"] === true || $inputErrors["weight"]["bool"] === true || $inputErrors["fatPercentage"]["bool"] === true) {
            echo '<a href="/inputData.php">入力フォームに戻る</a>';
            exit();
        }
        try {
            $calc = new FastingCalc($sexNo, $weight, $fatPercentage);
            $calc->allCalc();
        } catch (Exception $e) {
            echo '<div class="error-calc">計算途中でエラーがありました</div>';
            exit();
        }
        ?>

        <div class="result-all">
            <div class="result">
                <div class="title">体脂肪量(kg)</div>
                <div class="result-calc">
                    <?php
                    echo "{$calc->bodyFatQuantity}kg";
                    ?>
                </div>
            </div>
            <div class="result">
                <div class="title">除脂肪体重(kg)</div>
                <div class="result-calc">
                    <?php
                    echo "{$calc->nonBodyFatQuantity}kg";
                    ?>
                </div>
            </div>
            <div class="result">
                <div class="title">基礎代謝量(kcal)</div>
                <div class="result-calc">
                    <?php
                    echo "{$calc->basalMetabolismQuantity}kcal";
                    ?>
                </div>
            </div>
            <div class="result">
                <div class="title">総消費カロリー(kcal)</div>
                <div class="result-calc">
                    <?php
                    echo "{$calc->totalConsumption}kcal";
                    ?>
                </div>
            </div>
            <div class="result">
                <div class="title">ファスティング時の必要摂取カロリー(kcal)</div>
                <div class="result-calc">
                    <?php
                    echo "{$calc->calorieMin}kcal ~ {$calc->calorieMax}kcal";
                    ?>
                </div>
            </div>
            <div class="result">
                <div class="title">ファスティング時のMANA必要摂取量(ml)</div>
                <div class="result-calc">
                    <?php
                    echo "{$calc->manaMin}ml ~ {$calc->manaMax}ml";
                    ?>
                </div>
            </div>
            <div class="result">
                <div class="title">ファスティング時のKARA必要摂取量(ml)</div>
                <div class="result-calc">
                    <?php
                    echo "{$calc->karaMin}ml ~ {$calc->karaMax}ml";
                    ?>
                </div>
            </div>
        </div>
        <a href="http://localhost:8888/Fasting-app/view/inputData.php">入力フォームに戻る</a>
    </main>
</body>

</html>