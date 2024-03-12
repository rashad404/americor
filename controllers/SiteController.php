<?php

namespace app\controllers;

use app\models\search\HistorySearch;
use app\widgets\HistoryList\helpers\HistoryListHelper;
use Yii;
use yii\web\Controller;

class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Exports the history data as a CSV file.
     *
     * This action retrieves the history data using the HistorySearch model and the provided search criteria
     * from the request params. It then generates a CSV file with the history data
     *
     * @return void
     */
    public function actionExportCsv()
    {
        // Create an instance of the HistorySearch model
        $model = new HistorySearch();
        
        // Get the data provider using the search criteria from the request params
        $dataProvider = $model->search(Yii::$app->request->queryParams);
        
        $filename = 'history-' . time() . '.csv';
        
        // Set headers
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $fp = fopen('php://output', 'w');
        
        // Define the CSV header
        $headers = ['Date', 'User', 'Type', 'Event', 'Message'];

        fputcsv($fp, $headers);
        
        // Iterate over the data provider models
        foreach ($dataProvider->getModels() as $model) {
            // Prepare the CSV row data
            $row = [
                $model->ins_ts,
                isset($model->user) ? $model->user->username : Yii::t('app', 'System'),
                $model->object,
                $model->eventText,
                strip_tags(HistoryListHelper::getBodyByModel($model)),
            ];
            
            fputcsv($fp, $row);
        }
        
        fclose($fp);
        exit;
    }
}
