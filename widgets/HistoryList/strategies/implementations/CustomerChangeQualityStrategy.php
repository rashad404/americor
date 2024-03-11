<?php
namespace app\widgets\HistoryList\strategies\implementations;

use app\models\Customer;
use app\models\History;
use app\widgets\HistoryList\strategies\HistoryListStrategy;

// Strategy to handle customer quality change event
class CustomerChangeQualityStrategy implements HistoryListStrategy
{
   public function getBody(History $model): string
   {
       return "$model->eventText " .
           // Get old quality text or "not set" if null
           (Customer::getQualityTextByQuality($model->getDetailOldValue('quality')) ?? "not set") .
           ' to ' .
           // Get new quality text or "not set" if null
           (Customer::getQualityTextByQuality($model->getDetailNewValue('quality')) ?? "not set");
   }
}