<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EmployeeRepository::class)
 */
class Employee
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank
     * @Assert\Type(
     *   type = "alpha",
     *  message = "le nom doit etre une chaine des characteres"
     *)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(
        message = "le nom ne peut pas etre vide" 
     )
      * @Assert\Type(
     *   type = "alpha",
     *  message = "le prenom doit etre une chaine des characteres"
     *)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=100)
      * @Assert\Type(
     *   type = "alpha",
     *  message = "le poste doit etre une chaine des characteres"
     *)
     */
    private $post;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
      * @Assert\Type(
     *   type = {"alpha","digit"},
     *  message = "l'adresse doit etre une chaine des characteres"
     *)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="bigint", nullable=true)
      * @Assert\Type(
     *   type = "digit",
     *  message = "le telephone doit etre un numero"
     *)
     * @Assert\Length(
     *      min = 8,
     *      max = 8,
     *     exactMessage =  "La longueur de numero de telephone doit etre 8",
     *      allowEmptyString = false
     * )
     */
    private $telephone;

    /**
     * @ORM\Column(type="bigint")
     * 
     * @Assert\Positive(
        message = "le salaire doit etre positif"
     )
     */
    private $salaire;


    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPost(): ?string
    {
        return $this->post;
    }

    public function setPost(string $post): self
    {
        $this->post = $post;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getSalaire(): ?string
    {
        return $this->salaire;
    }

    public function setSalaire(string $salaire): self
    {
        $this->salaire = $salaire;

        return $this;
    }

    

   
}
