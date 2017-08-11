<?php

/* Line BOT Examples */

class EventMessage extends LineBotFunctions{

  public function index($event){
    if($this->botEventType($event) == "message"){
      if($this->botEventMessageType($event) == "text"){
        switch ($this->botEventMessageText($event)) {
          // Button Template
          case 'buttons':
            // Action Button Array
            $action = [
              ["label" => "button 1","text" => "button 1"],
              ["label" => "button 2","text" => "button 2"],
              ["label" => "button 3","text" => "button 3"]
            ];
            $button = $this->botButtonTemplateBuilder("Example","LineBot Button Template","https://i.imgur.com/bYFMygZ.jpg",$action);
            $template = $this->botTemplateMessageBuilder("Message Builder Sample", $button);
            $this->botReplyMessage($event,$template);
            break;
          //Confirm Template
          case 'confirm':
            // Action Button Array
            $action = [ //Max 2
              ["label" => "button 1","text" => "button 1"],
              ["label" => "button 2","text" => "button 2"]
            ];
            $confirm = $this->botConfirmTemplateBuilder("Example?",$action);
            $template = $this->botTemplateMessageBuilder("Message Builder Sample", $confirm);
            $this->botReplyMessage($event,$template);
            break;
          // Carousel Template
          case 'carousel':
            // Carousel Array Data
            $array = [
              [
                'title' => "Carousel 1",
                'text' => "Carousel Example 1",
                'thumbnail' => "https://i.imgur.com/bYFMygZ.jpg",
                'actions' => [ //Action Button Array
                  ["label" => "button 1","text" => "button 1"],
                  ["label" => "button 2","text" => "button 2"]
                ]
              ],
              [
                'title' => "Carousel 2",
                'text' => "Carousel Example 2",
                'thumbnail' => "https://i.imgur.com/bYFMygZ.jpg",
                'actions' => [
                  ["label" => "button 1","text" => "button 1"],
                  ["label" => "button 2","text" => "button 2"]
                ]
              ]
            ];
            $carousel = $this->botCarouselTemplateBuilder($array);
            $template = $this->botTemplateMessageBuilder("Message Builder Sample", $carousel);
            $this->botReplyMessage($event,$template);
            break;
          default:
            // Reply Text
            $this->botReplyText($event,$this->botEventMessageText($event));
            break;
        }
      }
    }
  }

}

?>
