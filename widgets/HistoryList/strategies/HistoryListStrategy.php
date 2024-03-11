<?php
namespace app\widgets\HistoryList\strategies;

use app\models\History;

// Contract for strategy classes to generate body text for History events
interface HistoryListStrategy
{
   // Generates body text for a given History model
   public function getBody(History $model): string;
}