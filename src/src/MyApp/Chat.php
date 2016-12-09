<?php //This all needs to be edited... this was just pulled from the ratchet site
namespace MyApp; //Defining what namespace we're working in
use Ratchet\MessageComponentInterface; //Saying we're going to use Ratchet\MessageComponentInterface
use Ratchet\ConnectionInterface; //Saying we're going to use Ratchet\ConnectionInterface

//**When you create a variable inside a class, it is called a ‘property’.**
//**Functions created inside a class are called ‘methods’.**
class Chat implements MessageComponentInterface { //here, our class (Chat) uses MessageComponentInterface which has onOpen, onClose and onMessage
    protected $clients; //protected scope when you want to make your variable/function visible in all classes that extend current class including the parent class.
	
    public function __construct() { //scope to make that variable/function available from anywhere, other classes and instances of the object.
      
	    $this->clients = new \SplObjectStorage; //using Ratchet's SplObjectStorage to store connections as objects in 'clients'
    }

    public function onOpen(ConnectionInterface $conn) {
		
		
		
  		//find out what file they're accessing
	   $querystring = $conn->WebSocket->request->getQuery();
	   $fileName = $querystring -> get('file');//This is thefileName/page they're on!
  		// Store the new connection to send messages to later
		$this->clients->attach($conn);

		foreach ($this->clients as $client) {
			 $querystring = $client->WebSocket->request->getQuery();
	  		 $fileName = $querystring -> get('file');//This is thefileName/page they're on!
			//var_dump($client);
			echo($fileName);
			}
			
        echo "New connection!({$conn->resourceId})\n";//This echos to the console
    }

    public function onMessage(ConnectionInterface $from, $msg) {
			//find out what page the 'from' person is on
			$querystringFrom = $from->WebSocket->request->getQuery();
	  		$fileNameFrom = $querystringFrom -> get('file');//This is thefileName/page they're on	
        foreach ($this->clients as $client) {//loop through everyone connected to the websocket
            if ($from !== $client) {
				$queryStringClient = $client->WebSocket->request->getQuery();
	  			 $fileNameClient = $queryStringClient -> get('file');//This is thefileName/page that client is on!
				 if($fileNameClient === $fileNameFrom){
					// The sender is not the receiver AND they're on the same page send it to them!
					$client->send($msg);
				 }
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}