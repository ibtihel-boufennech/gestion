<?php
namespace App\Message;

class Notification
{
    private $content;
    private $sender;
    private $reciever;

    public function __construct(string $content, string $sender,string $reciever)
    {
        $this->content = $content;
        $this->sender = $sender;
        $this->reciever = $reciever;
    }

    public function getContent(): string
    {
        return $this->content;
    }
    public function getSender() :string
    {
       return $this->sender;
    }
    public function getReciever() :string
    {
       return $this->reciever;
    }
}
