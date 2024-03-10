<?php
namespace app\widgets\HistoryList\strategies\implementations;

use app\models\History;
use app\widgets\HistoryList\strategies\HistoryListStrategy;

// Strategy to handle task-related events
class TaskStrategy implements HistoryListStrategy
{
   public function getBody(History $model): string
   {
       $task = $model->task;
       
       // Return the event text followed by the task title if it exists, otherwise an empty string
       return "$model->eventText: " . ($task->title ?? '');
   }
}