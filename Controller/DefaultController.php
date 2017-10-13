<?php

namespace Lilworks\MessageBundle\Controller;

use Lilworks\MessageBundle\Entity\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {

        return $this->render('LilworksMessageBundle:Default:index.html.twig');
    }
    public function formAction(Request $request)
    {
        $message = new Message();
        $form = $this->createForm('Lilworks\MessageBundle\Form\MessageType', $message,array('user'=>$this->getUser()));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if($this->getUser()){
                $message->setEmail($this->getUser()->getEmail());
            }
            $em->persist($message);
            $em->flush();

            return $this->redirectToRoute('lil_works_message_sent', array(
                'id' => $message->getId()
            ));
        }

        return $this->render('LilworksMessageBundle:Default:form.html.twig', array(
            'form' => $form->createView(),
        ));


    }

    public function sentAction(Message $message)
    {

        return $this->render('LilworksMessageBundle:Default:sent.html.twig',array(
            'message'=>$message
        ));
    }
}
