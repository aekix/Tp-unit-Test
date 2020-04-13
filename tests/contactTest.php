<?php

use App\Entity\Contact;
use PHPUnit\Framework\TestCase;

class contactTest extends TestCase
{
    /** @test */
    public function notEmpty()
    {
        $contact = new Contact();
        $contact->setLastname('Kérubin');
        $contact->setFirstname('Cédric');
        $contact->setContent('Vivement la fin du confinement');
        $contact->setEmail('cédric@gmail.com');
        $contact->setPhone('0624151556');
        $this->assertNotEmpty($contact->getLastname());
        $this->assertNotEmpty($contact->getFirstname());
        $this->assertNotEmpty($contact->getEmail());
        $this->assertNotEmpty($contact->getContent());
        $this->assertNotEmpty($contact->getPhone());
    }

    /** @test */
    public function Empty()
    {
        $contact = new Contact();
        $contact->setLastname('');
        $contact->setFirstname('');
        $contact->setContent('');
        $contact->setEmail('');
        $contact->setPhone('');
        $this->assertEmpty($contact->getLastname());
        $this->assertEmpty($contact->getFirstname());
        $this->assertEmpty($contact->getEmail());
        $this->assertEmpty($contact->getContent());
        $this->assertEmpty($contact->getPhone());
    }

    /** @test */
    public function validFormat()
    {
        $contact = new Contact();
        $contact->setLastname('Kérubin');
        $contact->setFirstname('Cedric');
        $contact->setContent('Vivement la fin du confinement');
        $contact->setEmail('cedric@gmail.com');
        $contact->setPhone('0624151556');
        $this->assertMatchesRegularExpression("/^([a-zA-Z0-9-.]+)@([a-zA-Z0-9-.]+).([a-zA-Z]{2,5})$/", $contact->getEmail());
        $this->assertMatchesRegularExpression("/^([a-zA-Z0-9-.éèà]+)$/", $contact->getFirstname());
        $this->assertMatchesRegularExpression("/^([a-zA-Z0-9-.éèà]+)$/", $contact->getLastname());
        $this->assertMatchesRegularExpression("/^0[1-9](\d{2}){4}$/", $contact->getPhone());
    }

    /** @test */
    public function Null()
    {
        $contact = new Contact();

        $this->assertNull($contact->getLastname());
        $this->assertNull($contact->getFirstname());
        $this->assertNull($contact->getEmail());
        $this->assertNull($contact->getContent());
        $this->assertNull($contact->getPhone());
    }

    /** @test */
    public function notNull()
    {
        $contact = new Contact();
        $contact->setLastname('Kérubin');
        $contact->setFirstname('Cédric');
        $contact->setContent('Vivement la fin du confinement');
        $contact->setEmail('cédric@gmail.com');
        $contact->setPhone('0624151556');
        $this->assertNotNull($contact->getLastname());
        $this->assertNotNull($contact->getFirstname());
        $this->assertNotNull($contact->getEmail());
        $this->assertNotNull($contact->getContent());
        $this->assertNotNull($contact->getPhone());
    }
}