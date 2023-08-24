<?php
namespace Controllers;
use Models\User;
use Views\View;


class RegisterController extends Controller
{

    /**
     * @param $params
     * @return void
     */
    public function index($params) : void
    {
        $userFormFactory = new \FormFactory\Factories\UserRegisterFormFactory();
        $userForm = $userFormFactory->getForm();

        if ($userForm->isSubmitted()) {
            /** @var User $newUser */
            $newUser = $userForm->validate();
            if ($newUser != []) {
                $this->getDb()->addNewModel($newUser);
                $newUser = $this->getDb()->getModelByParam(["username" => $newUser->username], "Models\\User");
                $_SESSION["loggedUser"] = $newUser->id;
                $this->redirect("http://localhost");
            }
            else
            {
                $view = new View("index", $this);
                $view->setData("form", $userForm);
                $view->setData("errors", "Invalid data");
                $view->render();
            }
        }
        else
        {
            $view = new View("index", $this);
            $view->setData("form", $userForm);
            $view->render();
        }

    }
}