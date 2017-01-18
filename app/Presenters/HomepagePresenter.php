<?php

namespace App\Presenters;

use App\Model\User;
use Doctrine\ORM\EntityManager;
use Nette\Application\UI\Form;
use Nette\Utils\ArrayHash;
use Nette\Utils\Random;

class HomepagePresenter extends BasePresenter
{
    /** @var EntityManager @inject */
    public $em;

    // this whole component creation is only for demo - don't use components and EM like this :)
    protected function createComponentRegisterForm()
    {
        $form = new Form();
        $form->addText('name', 'Jméno:');
        $form->addText('email', 'E-mail:');
        $form->addPassword('password', 'Heslo:');
        $form->addSubmit('submit', 'Registrovat');
        
        $form->onSuccess[] = function (Form $form, ArrayHash $values) {
            $user = new User($values->email, $values->name, Random::generate(6), $values->password);
            
            $this->em->persist($user);
            $this->em->flush();
            
            $this->flashSuccess('Uživatel ' . $user->getName() . ' zaregistrován.');
        };
        
        return $form;
    }

    public function handleLogout()
    {
        $this->user->logout();
    }
}
