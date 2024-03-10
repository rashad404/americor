<?php
namespace app\widgets\HistoryList\strategies\implementations;

use app\models\History;
use app\widgets\HistoryList\strategies\HistoryListStrategy;
use Yii;
use yii\helpers\Html;

// Strategy to handle fax-related events
class FaxStrategy implements HistoryListStrategy
{
   public function getBody(History $model): string
   {
       $fax = $model->fax;
       return $model->eventText . ' - ' .
           // If fax document exists, create a link to view it
           (isset($fax->document) ? Html::a(
               Yii::t('app', 'view document'),
               $fax->document->getViewUrl(),
               [
                   'target' => '_blank',
                   'data-pjax' => 0
               ]
           ) : '');
   }
}