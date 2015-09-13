<?php
namespace Dwm\CtalogueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Request;
use Dwm\CtalogueBundle\Entity\Contact;
use Dwm\CtalogueBundle\Form\ContactType;


class ContactController extends Controller{
    /**
     * @Route("/contact",name="contact")
     * @Template()
     */
    public function sendAction(Request $request)
    {
        $contact = new Contact();
        /*
        je peux aussi le générer

        $form= $this->createFormBuilder($contact)
        ->add('name','text')
        ->add('email','email')
        ->add('phone','text')
        ->add('message','textarea')
        ->add('send','submit')
        ->getForm()
        ;


*/
        $form = $this->get('form.factory')->create(new ContactType(), $contact);

        //---------------------------------------------------------------------


        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();



                $em->persist($contact);
                $em->flush();


                return $this->redirect($this->generateUrl("home"));

            }



        return array('rekik'=>$form->createView());
    }




}