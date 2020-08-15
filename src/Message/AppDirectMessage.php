<?php
namespace App\Messsage;

class AppDirectMessage{
	private $contenu;
	public function __construct(string $ch){
		$this->contenu = $ch;
	}
	public function getContenu()
	{
		return $this->contenu;
	}
	public function setContenu($value='')
	{
		$this->contenu = $value;
	}

}
