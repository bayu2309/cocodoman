<?php
class EventFollow extends LineBotFunctions{

  public function index($event){
    $profile = $this->botGetProfile($event);
    $displayName = $profile['displayName'];
    $this->botReplyText($event, "Thank you " . $displayName . " for adding me :)");
  }

}

?>
