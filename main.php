<?php
require 'linebotfunctions.php';
require 'event/message.php';
require 'event/follow.php';
require 'event/unfollow.php';
require 'event/join.php';
require 'event/leave.php';

class Bot extends LineBotFunctions{

  public function index(){
    foreach($this->EventsHandler() as $event){
      $EventMessage = new EventMessage();
      $EventMessage->index($event);

      $EventFollow = new EventFollow();
      $EventFollow->index($event);

      $EventUnfollow = new EventUnfollow();
      $EventUnfollow->index($event);

      $EventJoin = new EventJoin();
      $EventJoin->index($event);

      $EventLeave = new EventLeave();
      $EventLeave->index($event);
    }
  }

}

?>
