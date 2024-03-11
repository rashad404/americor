<?php
namespace app\widgets\HistoryList\strategies\implementations;

use app\models\History;
use app\widgets\HistoryList\strategies\HistoryListStrategy;

// Default strategy for unknown events
class DefaultStrategy implements HistoryListStrategy
{
   public function getBody(History $model): string
   {
       // Simply return the event text
       return $model->eventText;
   }
}