<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
class SecurityController extends AbstractController
{
  public function __construct(UserPasswordEncoderInterface $passwordEncoder)
  {
    $this->passwordEncoder = $passwordEncoder;
  }
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('index');
        }else{

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }}

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        redirectToRoute("app_login");
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
    /**
     * @Route("/", name="index")
     */
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {

            return $this->render('index.html.twig',[
              'user'=>$this->getUser(),
            ]);
        }else{
            // get the login error if there is one
            $error = $authenticationUtils->getLastAuthenticationError();
            // last username entered by the user
            $lastUsername = $authenticationUtils->getLastUsername();
            return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
        }
 }
    /**
     * @Route("/signup", name="register")
     */
    public function signup(Request $request, ValidatorInterface $validator)
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $errors = $validator->validate($user);
            if($errors){
                return $this->render("security/signup.html.twig",[
                    "form"=>$form->createView(),
                    "errors"=> $errors,
                ]);
            }else{
            $entitymanager=$this->getDoctrine()->getManager();
            $user->setPassword($this->passwordEncoder->encodePassword(
                 $user,
                $user->getPassword()
            ));
            $entitymanager->persist($user);
            $entitymanager->flush();
            return $this->render("index.html.twig",["sucess"=>"utilisateur enregisté avec succes"]);


        }}
        return $this->render("security/signup.html.twig",["form"=>$form->createView()]);
    }
    /**
     * @Route("/presentation", name="presentation")
     */
   public function presentation()
   {
     return $this->render("presentation.html.twig");
   }
}
