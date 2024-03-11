<?php
namespace app\widgets\HistoryList\strategies\implementations;

use app\models\Customer;
use app\models\History;
use app\widgets\HistoryList\strategies\HistoryListStrategy;

// Strategy to handle customer type change event
class CustomerChangeTypeStrategy implements HistoryListStrategy
{
   public function getBody(History $model): string
   {
       return "$model->eventText " .
           // Get old type text or "not set" if null
           (Customer::getTypeTextByType($model->getDetailOldValue('type')) ?? "not set") .
           ' to ' .
           // Get new type text or "not set" if null
           (Customer::getTypeTextByType($model->getDetailNewValue('type')) ?? "not set");
   }
}