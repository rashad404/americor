<?php

namespace app\widgets\HistoryList;

use app\models\search\HistorySearch;
use yii\base\Widget;
use yii\helpers\Url;
use Yii;

class HistoryList extends Widget
{
    /**
     * @return string
     */
    public function run()
    {
        $model = new HistorySearch();

        return $this->render('main', [
            'model' => $model,
            'dataProvider' => $model->search(Yii::$app->request->queryParams),
            'exportUrl' => Url::to(['/site/export-csv'])
        ]);
    }
}
