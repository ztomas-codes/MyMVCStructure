<?php

namespace FormFactory;
use Models\Model;

class Form
{


    /**
     * @var null | string
     */
    private $classOfModel = null;
    /**
     * @var array
     */
    private $fields = [];

    /**
     * @var string
     */
    private $method;

    public function getMethod(): string
    {
        return $this->method;
    }

    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function setAction(string $action): void
    {
        $this->action = $action;
    }

    /**
     * @var string
     */
    private $action;

    /**
     * @return string
     */
    public function __toString() : string
    {
        $html = "<form method='$this->method' action='$this->action'>";
        foreach ($this->fields as $input) {
            if ($input->getType() == Input::INPUT_TYPE_SUBMIT) {
                $html .= $input;
            }
            else
            {
                if ($input->getLabel() != null)
                    $html .= "<br>".$input->getLabel(). $input;
                else
                    $html .= "<br>".$input;
            }
        }
        $html .= "</form>";
        return $html;
    }

    public function addField(Input $field)
    {
        $this->fields[] = $field;
    }

    /**
     * @return array
     */
    public function getFields()
    {
        $fields = array_filter($this->fields, function($field) {
            return $field->getType() != Input::INPUT_TYPE_SUBMIT;
        });
        return $fields;
    }


    /**
     * @return array|Model
     */
    public function validate()
    {

        $validatedValues = [];
        $modelInstance = null;
        if ($this->classOfModel != null) {
            $modelInstance = new $this->classOfModel();
        }


        $form = $this;
        $fields = $form->getFields();
        foreach ($fields as $field) {

            $postRequestFieldValue = $_POST[$field->getName()];

            //validate for XSS and SQL injection
            $postRequestFieldValue = htmlspecialchars($postRequestFieldValue);
            $postRequestFieldValue = stripslashes($postRequestFieldValue);
            $postRequestFieldValue = trim($postRequestFieldValue);

            if ($postRequestFieldValue == null) {
                return [];
            }
            // TODO: add more validation
            /*else if ($field->getType() == Input::INPUT_TYPE_EMAIL) {
                if (!filter_var($postRequestFieldValue, FILTER_VALIDATE_EMAIL)) {
                    return [];
                }
            }*/
            else
            {
                //add to validated values
                if ($modelInstance != null) {
                    $fieldName = $field->getName();
                    $modelInstance->$fieldName = $postRequestFieldValue;
                }
                else $validatedValues[$field->getName()] = $postRequestFieldValue;

            }
        }
        return $modelInstance != null ? $modelInstance : $validatedValues;
    }


    /**
     * @return bool
     */
    public function isSubmitted() : bool
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            return true;
        }
        return false;
    }

    public function setClassOfModel($classOfModel)
    {
        $this->classOfModel = $classOfModel;
    }



}