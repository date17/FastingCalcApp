<!-- 性別、体重、体脂肪率を入力するページ -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>フォーム入力</title>
    <link href="../css/inputData.css" rel="stylesheet">
</head>

<body>
    <header>
        <div class="title">ファスティング用計算サイト</div>
    </header>
    <main>
        <div class="short-explain">
            <div class="title">サイトの説明</div>
            <div class="direction">・性別、体重、体脂肪率を入力してください</div>
            <div class="detail-app">・入力された情報を元に、基礎代謝量やファスティングの際に必要となるドリンクの摂取目安を計算します。</div>
        </div>
        <div class="form">
            <div class="form-title"><span>入力フォーム</span></div>
            <form action="/result.php" method="post">
                <div class="sex">
                    <div class="title">性別：<span>必須</span></div>
                    <div class="input">
                        <select name="sexNo">
                            <option value="" disabled selected>性別を選択してください</option>
                            <option value="0">男性</option>
                            <option value="1">女性</option>
                            <option value="2">その他</option>
                        </select>
                    </div>
                </div>
                <div class="weight">
                    <div class="title">体重(kg)：<span>必須</span></div>
                    <div class="input">
                        <input type="number" name="weight" min="0" max="200" step="0.1" required>
                    </div>
                </div>
                <div class="fat-percentage">
                    <div class="title">体脂肪率(%)：<span>必須</span></div>
                    <div class="input">
                        <input type="number" name="fatPercentage" min="0" max="100" step="0.1" required>
                    </div>
                </div>
                <div class="send-btn"><input type="submit" value="計算する"></div>
            </form>
        </div>
    </main>
</body>

</html>