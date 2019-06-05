<?php
/**
 * Created by PhpStorm.
 * User: tuanminh
 * Date: 05/06/2019
 * Time: 10:55
 */
namespace App\Service;


use App\Helper\LoggerTrait;
use Nexy\Slack\Client;

class SlackClient{
    use LoggerTrait;

    private $slack;

    public function __construct(Client $slack)
    {
        $this->slack = $slack;
    }

    public function sendMessage(string $from, string $message){

        if($this->logger){
            $this->logInfo('Beaming a message to Slack!',[
                'message'=>$message, 

            ]);

        }

        $slackMessage = $this->slack->createMessage()
            ->from($from)
            ->withIcon(':ghost:')
            ->setText('Ah, Kirk, my old friend...');
        $this->slack->sendMessage($slackMessage);

    }


}
