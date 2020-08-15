<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Messenger\MessageBusInterface;
use App\Message\AppDirectMessage;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AppDirectMessageController extends AbstractController
{
    /**
     * @Route("/message", name="messenger")
     */
    public function processMessage(MessageBusInterface $bus)
    {
    	$msg = new AppDirectMessage();
        $msgForm = $this->createFormBuilder($msg)
        ->add("contenu", TextType::class)
        ->add("Envoyer", SubmitType::class, ['label'=>'Envoyer'])
        ->getForm();
        if($msgForm->issubmitted()){
        $msg= $msgForm->getData();
        	$bus->dispatch($msg->getContenu);
        }
        return $this->render("message/new.html.twig",[
        	'form' => $msgForm
        ]);


    }
}
