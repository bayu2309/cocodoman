<?php

use \LINE\LINEBot\SignatureValidator as SignatureValidator;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

class LineBotCore{

    public $request;
    public $bot;
    public $httpClient;

    public function __construct(){

      //eloquent
      $capsule = new Capsule;
      //db connection
      $capsule->addConnection([
            'driver'    => $_ENV['DRIVER'],
            'host'      => $_ENV['HOST'],
            'database'  => $_ENV['DATABASE'],
            'username'  => $_ENV['USERNAME'],
            'password'  => $_ENV['PASSWORD'],
            'charset'   => $_ENV['CHARSET'],
            'collation' => $_ENV['COLLATION'],
            'prefix'    => $_ENV['PREFIX'],
        ]);

      $capsule->setEventDispatcher(new Dispatcher(new Container));
      $capsule->setAsGlobal();
      $capsule->bootEloquent();

      $this->request = file_get_contents('php://input');
  		/* Get Header Data */
  		$signature = $_SERVER['HTTP_X_LINE_SIGNATURE'];
  		/* Logging to Console*/
  		file_put_contents('php://stderr', 'Body: '.$this->request);
  		/* Validation */
  		if (empty($signature)) {
  			return "Siganature not Set";
  		}
  		if ($_ENV['PASS_SIGNATURE'] == false && !SignatureValidator::validateSignature($this->request, $_ENV['CHANNEL_SECRET'], $signature)) {
  			return "Invalid Signature";
  		}
  		/* Initialize bot*/
  		$this->httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($_ENV['CHANNEL_ACCESS_TOKEN']);
  		$this->bot  = new \LINE\LINEBot($this->httpClient, ['channelSecret' => $_ENV['CHANNEL_SECRET']]);
    }

    //return $this->httpClient->get($this->endpointBase . '/v2/bot/profile/' . urlencode($userId));

    public function EventsHandler(){
      $requestHandler = json_decode($this->request, true);
		  return $requestHandler['events'];
    }
}

?>
