<?php
namespace FormFactory\Factories;
use FormFactory\FormFactory;
use FormFactory\Input;

class UserRegisterFormFactory extends FormFactory
{
    public function __construct()
    {
        $form = parent::create()
            ->createFromModel(new \Models\User())
            ->setMethod(FormFactory::METHOD_POST)
            ->addSubmit()
            ->setAction("/register");
        return $form;
    }
}