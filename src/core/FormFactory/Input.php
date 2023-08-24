<?php

namespace FormFactory;
class Input
{
    public const INPUT_TYPE_TEXT = "text";
    public const INPUT_TYPE_PASSWORD = "password";
    public const INPUT_TYPE_SUBMIT = "submit";
    public const INPUT_TYPE_EMAIL = "email";
    public const INPUT_TYPE_NUMBER = "number";
    public const INPUT_TYPE_DATE = "date";
    public const INPUT_TYPE_HIDDEN = "hidden";
    public const INPUT_TYPE_CHECKBOX = "checkbox";
    public const INPUT_TYPE_RADIO = "radio";
    public const INPUT_TYPE_FILE = "file";
    public const INPUT_TYPE_COLOR = "color";
    public const INPUT_TYPE_RANGE = "range";
    public const INPUT_TYPE_RESET = "reset";

    private $type;
    private $name;

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    private $value;

    public function __construct($type, $name)
    {
        $this->type = $type;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        if ($this->type == self::INPUT_TYPE_SUBMIT) return "<input type='$this->type'>";
        else return "<input type='$this->type' name='$this->name'>";
    }

    public function setValue($value)
    {
        $this->value = $value;
    }
}