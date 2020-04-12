<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("", name="contact_")
 */
class ContactController extends AbstractController
{
    private $em;
    private $repo;

    public function __construct(EntityManagerInterface $em, ContactRepository $repo)
    {
        $this->em = $em;
        $this->repo = $repo;
    }

    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $contacts = $this->repo->findAll();
        return $this->render('contact/index.html.twig', [
            'contacts' => $contacts,
        ]);
    }

    /**
     * @Route("/contact/create", name="create")
     */
    public function create(Request $request)
    {
        $form = $this->createForm(ContactType::class, null);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $contact = new Contact();
            $contact->setPhone($data->getPhone());
            $contact->setEmail($data->getEmail());
            $contact->setFirstname($data->getFirstname());
            $contact->setLastname($data->getLastname());
            $contact->setContent($data->getContent());
            $this->em->persist($contact);
            $this->em->flush();
            return $this->redirectToRoute('contact_home');
        }

        return $this->render('contact/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/contact/{id}", name="read")
     */
    public function read(Contact $contact)
    {
        return $this->render('contact/read.html.twig', [
            'contact' => $contact,
        ]);
    }

    /**
     * @Route("/contact/update/{id}", name="update")
     */
    public function update(Contact $contact, Request $request)
    {
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($contact);
            $this->em->flush();
            return $this->redirectToRoute('contact_home');
        }
        return $this->render('contact/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/contact/delete/{id}", name="delete")
     */
    public function delete(Contact $contact)
    {
        $contacts = $this->repo->findAll();
        $this->em->remove($contact);
        $this->em->flush();
       return $this->redirectToRoute('contact_home');
    }
}
