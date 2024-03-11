<?php
namespace app\widgets\HistoryList\strategies\implementations;

use app\models\History;
use app\models\Sms;
use app\widgets\HistoryList\strategies\HistoryListStrategy;
use Yii;

// Strategy to handle SMS-related events
class SmsStrategy implements HistoryListStrategy
{
   public function getBody(History $model): string
   {
       // Return the SMS message if it exists, otherwise an empty string
       return $model->sms->message ? $model->sms->message : '';
   }
}