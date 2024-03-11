<?php
namespace app\widgets\HistoryList\strategies;

use app\models\History;
use app\widgets\HistoryList\strategies\implementations\CustomerChangeQualityStrategy;
use app\widgets\HistoryList\strategies\implementations\CustomerChangeTypeStrategy;
use app\widgets\HistoryList\strategies\implementations\DefaultStrategy;
use app\widgets\HistoryList\strategies\implementations\FaxStrategy;
use app\widgets\HistoryList\strategies\implementations\SmsStrategy;
use app\widgets\HistoryList\strategies\implementations\TaskStrategy;

// Factory class to create appropriate strategy based on the event type
class HistoryListStrategyFactory
{
   // Returns the strategy instance based on the event type
   public static function getStrategy(string $event): HistoryListStrategy
   {
       switch ($event) {
           // Handle task-related events
           case History::EVENT_CREATED_TASK:
           case History::EVENT_COMPLETED_TASK:
           case History::EVENT_UPDATED_TASK:
               return new TaskStrategy();
           
           // Handle SMS-related events
           case History::EVENT_INCOMING_SMS:
           case History::EVENT_OUTGOING_SMS:
               return new SmsStrategy();
           
           // Handle fax-related events
           case History::EVENT_OUTGOING_FAX:
           case History::EVENT_INCOMING_FAX:
               return new FaxStrategy();
           
           // Handle customer type change event
           case History::EVENT_CUSTOMER_CHANGE_TYPE:
               return new CustomerChangeTypeStrategy();
           
           // Handle customer quality change event
           case History::EVENT_CUSTOMER_CHANGE_QUALITY:
               return new CustomerChangeQualityStrategy();
           
           // Default strategy for unknown events
           default:
               return new DefaultStrategy();
       }
   }
}