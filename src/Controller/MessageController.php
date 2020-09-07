<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Messenger\MessageBusInterface;
use App\Message\Notification;
use App\Repository\UserRepository;
use App\Entity\Message;
use  App\Form\MessageType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class MessageController extends AbstractController
{
     private $userrepository;
     public function __construct(UserRepository $userrepository)
     {
       $this->userrepository = $userrepository;
     }
    /**
     * @Route("/message", name="message")
     */
    public function index( )
    {
      $users = $this->userrepository->findAll();
      $message = new Message();
      $form = $this->createForm(MessageType::class, $message);
      return $this->render('message/index.html.twig', [
          'users'=>$users,
          'form'=>$form->createView(),
      ]);
    }
    /**
     * @Route("/sendmessage{id}", name="send_message", methods= {"GET","HEAD"} )
     *
     */

    public function send(Request $request, MessageBusInterface $bus, $id)
    {
      $message = new Message();
      $form = $this->createForm(MessageType::class, $message);
      $form->handleRequest($request);
      if($form->isSubmitted()&&$form->isValid())
      $bus->dispatch($sentmessage = new Notification($this->getUser()->getUsername(),$message->getContent(),$id));
      return $this->render('index.html.twig');
    }
}
