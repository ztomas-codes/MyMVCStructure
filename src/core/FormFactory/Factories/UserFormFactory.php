<?php
namespace FormFactory\Factories;
use FormFactory\FormFactory;
use FormFactory\Input;

class UserFormFactory extends FormFactory
{
    public function __construct()
    {
        $form = parent::create()
            ->createFromModel(new \Models\User())
            ->setMethod(FormFactory::METHOD_POST)
            ->addSubmit()
            ->setLabelByName("username", "Username")
            ->setLabelByName("password", "Password")
            ->setLabelByName("email", "Email");
        return $form;
    }
}