<?php

namespace FormFactory;
use Models\Model;

class FormFactory
{

    public const METHOD_POST = "post";
    public const METHOD_GET = "get";

    private $Form = null;

    /**
     * @return $this
     */
    public function create() : FormFactory
    {
        $form = new Form();
        $this->Form = $form;
        return $this;
    }

    /**
     * @param Model $model
     * @return $this
     */
    public function createFromModel(Model $model) : FormFactory
    {
        $form = new Form();
        foreach ($model as $key => $value) {
            //ignore tableName and id
            if ($key == "tableName" || $key == "id") {
                continue;
            }
            $field = new Input(self::getInputTypeFromName($key), $key);
            if (isset($value)) $field->setValue($value);
            $form->addField($field);
        }
        $this->Form = $form;
        $this->Form->setClassOfModel(get_class($model));
        return $this;
    }

    /**
     * @param $method
     * @return $this
     */
    public function setMethod($method) : FormFactory
    {
        $this->Form->setMethod($method);
        return $this;
    }

    /**
     * @param $action
     * @return $this
     */
    public function setAction($action) : FormFactory
    {
        $this->Form->setAction($action);
        return $this;
    }

    /**
     * @param $inputName
     * @param null|string $inputType
     * @return $this
     */
    public function addInput($inputName, $inputType = null) : FormFactory
    {
        if ($inputType == null) $inputType = self::getInputTypeFromName($inputName);
        $input = new Input($inputType, $inputName);
        $this->Form->addField($input);
        return $this;
    }

    public function addSubmit() : FormFactory
    {
        $input = new Input(Input::INPUT_TYPE_SUBMIT, "");
        $this->Form->addField($input);
        return $this;
    }

    /**
     * @return Form
     */
    public function getForm() : Form
    {
        return $this->Form;
    }


    private static function getInputTypeFromName($inputName)
    {
        $inputType = "";
        //if name contains password, set input type to password
        if (strpos($inputName, "password") !== false) {
            $inputType = Input::INPUT_TYPE_PASSWORD;
        }
        else if (strpos($inputName, "email") !== false) {
            $inputType = Input::INPUT_TYPE_EMAIL;
        }
        else if (strpos($inputName, "number") !== false) {
            $inputType = Input::INPUT_TYPE_NUMBER;
        }
        else if (strpos($inputName, "date") !== false) {
            $inputType = Input::INPUT_TYPE_DATE;
        }
        else if (strpos($inputName, "hidden") !== false) {
            $inputType = Input::INPUT_TYPE_HIDDEN;
        }
        else if (strpos($inputName, "checkbox") !== false) {
            $inputType = Input::INPUT_TYPE_CHECKBOX;
        }
        else if (strpos($inputName, "radio") !== false) {
            $inputType = Input::INPUT_TYPE_RADIO;
        }
        else if (strpos($inputName, "file") !== false) {
            $inputType = Input::INPUT_TYPE_FILE;
        }
        else if (strpos($inputName, "color") !== false) {
            $inputType = Input::INPUT_TYPE_COLOR;
        }
        else if (strpos($inputName, "range") !== false) {
            $inputType = Input::INPUT_TYPE_RANGE;
        }
        else if (strpos($inputName, "reset") !== false) {
            $inputType = Input::INPUT_TYPE_RESET;
        }
        else if (strpos($inputName, "submit") !== false) {
            $inputType = Input::INPUT_TYPE_SUBMIT;
        }
        else {
            $inputType = Input::INPUT_TYPE_TEXT;
        }
        return $inputType;
    }

}