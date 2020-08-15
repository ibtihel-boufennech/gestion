<?php 
namespace App\MessageHandler;

use App\Message\AppDirectMessage;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

/**
 * 
 */
class DirectMessageHandler implements MessageHandlerInterface
{
	
	public function __invoke(AppDirectMessage $msg)
	{
		$contenu = $msg->getContenu();
		echo $contenu;
	}
}