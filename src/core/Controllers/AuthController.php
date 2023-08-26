<?php

namespace Controllers;
use FormFactory\Factories\UserFormFactory;
use FormFactory\Form;
use Views\View;

class AuthController extends Controller
{

    private UserFormFactory $formFactory;

    public function __construct()
    {
        $this->formFactory = new UserFormFactory();
    }

    /**
     * @param $params
     * @return void
     */
    public function login($params) : void
    {
        $form = $this->formFactory->getForm();
        $form->setAction("/auth/login");
        if ($form->isSubmitted())
        {
            $validated = $form->validate();
            if ($validated != [])
            {
                $user = $this->getDb()->getModelByParam([
                    "username" => $validated->username,
                    "password" => $validated->password
                ], "Models\\User");

                if ($user != null)
                {
                    $_SESSION["loggedUser"] = $user->id;
                    $this->redirect();
                }
                else
                {
                    $view = new View("login", $this);
                    $view->setData("form", $form);
                    $view->setData("error", "Invalid username or password");
                    $view->render();
                }
            }
            else
            {
                $view = new View("login", $this);
                $view->setData("form", $form);
                $view->setData("error", "Invalid username or password");
                $view->render();
            }
        }
        else
        {
            $view = new View("login", $this);
            $view->setData("form", $form);
            $view->render();
        }

    }

    /**
     * @param $params
     * @return void
     */
    public function register($params) : void
    {
        $form = $this->formFactory->getForm();
        $form->setAction("/auth/register");
        if ($form->isSubmitted())
        {
            $validated = $form->validate();
            if ($validated != [])
            {
                $user = $this->getDb()->getModelByParam([
                    "username" => $validated->username
                ], "Models\\User");

                if ($user == null)
                {
                    $this->getDb()->addNewModel($validated);
                    $this->redirect();
                }
                else
                {
                    $view = new View("register", $this);
                    $view->setData("form", $form);
                    $view->setData("error", "Username already exists");
                    $view->render();
                }
            }
            else
            {
                $view = new View("register", $this);
                $view->setData("form", $form);
                $view->setData("error", "Invalid username or password");
                $view->render();
            }
        }
        else
        {
            $view = new View("register", $this);
            $view->setData("form", $form);
            $view->render();
        }
    }

    public function logout($params) : void
    {
        session_destroy();
        $this->redirect();
    }
}