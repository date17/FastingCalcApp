<?php

class FastingCalc
{


    public function __construct($sexNo = 0, $weight, $fatPercentage)
    {
        $sexWitch = ["男", "女", "その他"];
        //性別
        $this->sex = $sexWitch[$sexNo];
        //体重
        $this->weight = round($weight, 1);
        //体脂肪率
        $this->fatPercentage = round($fatPercentage / 100, 2);
    }

    //体脂肪量の計算 体重✖︎体脂肪率
    protected function fatQuantityCalc()
    {
        $this->bodyFatQuantity = round($this->weight * $this->fatPercentage, 1);
    }
    //除脂肪体重 体重-体脂肪量
    protected function nonFatQuantityCalc()
    {
        $this->nonBodyFatQuantity = round($this->weight - $this->bodyFatQuantity, 1);
    }

    //基礎代謝量 28.5✖︎除脂肪体重
    protected function basalMetabolismQuantityCalc()
    {
        $this->basalMetabolismQuantity = round(28.5 * $this->nonBodyFatQuantity);
    }

    //総消費カロリー 基礎代謝量 / 0.6
    protected function totalConsumptionCalc()
    {
        $this->totalConsumption = round($this->basalMetabolismQuantity / 0.6);
    }

    //ファスティング時の必要摂取カロリ-少 総消費カロリー * 1/4
    protected function needCalorieMinCalc()
    {
        $this->calorieMin = round($this->totalConsumption / 4);
    }
    //ファスティング時の必要摂取カロリ-多 総消費カロリー * 1/3
    protected function needCalorieMaxCalc()
    {
        $this->calorieMax = round($this->totalConsumption / 3);
    }

    //ファスティング時のMANA必要摂取量少 ファスティング時の必要摂取カロリー少 / 2.17
    protected function needManaMinCalc()
    {
        $this->manaMin = round($this->calorieMin / 2.17);
    }
    //ファスティング時のMANA必要摂取量多 ファスティング時の必要摂取カロリー多 / 2.17
    protected function needManaMaxCalc()
    {
        $this->manaMax = round($this->calorieMax / 2.17);
    }

    //ファスティング時のKARA必要摂取量少 ファスティング時の必要摂取カロリー少 / 2.22
    protected function needKaraMinCalc()
    {
        $this->karaMin = round($this->calorieMin / 2.22);
    }
    //ファスティング時のKARA必要摂取量多 ファスティング時の必要摂取カロリー多 / 2.22
    protected function needKaraMaxCalc()
    {
        $this->karaMax = round($this->calorieMax / 2.22);
    }

    //上記した計算を全て１まとまりで行うメソッド
    public function allCalc()
    {
        $this->fatQuantityCalc();
        $this->nonFatQuantityCalc();
        $this->basalMetabolismQuantityCalc();
        $this->totalConsumptionCalc();
        $this->needCalorieMinCalc();
        $this->needCalorieMaxCalc();
        $this->needManaMinCalc();
        $this->needManaMaxCalc();
        $this->needKaraMinCalc();
        $this->needKaraMaxCalc();
    }
}
