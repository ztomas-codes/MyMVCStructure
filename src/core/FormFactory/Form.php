<?php
class Form
{
    public const METHOD_POST = "post";
    public const METHOD_GET = "get";

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
    public const INPUT_TYPE_BUTTON = "button";


    /**
     * @return string
     */
    public function __toString() : string
    {
        $html = "<form>";
        foreach ($this->fields as $field) {
            $html .= $field;
        }
        $html .= "</form>";
        return $html;
    }
}