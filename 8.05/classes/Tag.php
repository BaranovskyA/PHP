<?php

require_once 'TagName.php';
require_once 'TagAttributes.php';

class Tag
{

    private $name;
    private $attributes;
    private $body;

    public function __construct(string $name)
    {
        $this->name = new TagName($name);
        $this->attributes = new TagAttributes();
    }

    public function addClass(string $string) 
    {
        if($this->countAttributes() > 0)
            $this->appendAttribute('class', ' ' . $string);
        else 
            $this->appendAttribute('class', $string);
    }

    public function classExists(string $string)
    {
        return $this->checkAttributes($string);
    }

    public function removeClass(string $string)
    {
        $val = $this->attributes()->get('class');
        $val = str_replace($string, '', $val);
        $val = trim($val, ' ');
        $this->setAttribute('class', $val);
        return $this->attributes();
    }

    //region NAME METHODS
    public function name()
    {
        return $this->name;
    }

    function isSelfClosing() {
        return $this->name()->isSelfClosing();
    }
    //endregion

    //region BODY METHODS
    public function getBody()
    {
        if ( $this->isSelfClosing() )
            return '';

        return $this->body;
    }

    private function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    function appendBody($value) {
        return $this->setBody( $this->getBody() . $value );
    }

    function prependBody($value) {
        return $this->setBody( $value . $this->getBody() );
    }
    //endregion

    //region ATTRIBUTES METHODS
    function attributes() {
        return $this->attributes;
    }

    function countAttributes() {
        return count($this->attributes()->keys());
    }

    function checkAttributes(string $value) {
        $checkArray = $this->attributes()->get('class');
        $parts = explode(' ', $checkArray);
        foreach ($parts as $key => $v) {
            if($v == $value)
                return true;
        }
        return false;
    }

    function setAttribute(string $key, $value) {
        $this->attributes()->$key = $value;
        return $this;
    }

    function getAttribute(string $key) {
        return $this->attributes()->$key ?? null;
    }

    function appendAttribute(string $key, $value) {
        $this->attributes()->append($key, $value);
        return $this;
    }

    function prependAttribute(string $key, $value) {
        $this->attributes()->prepend($key, $value);
        return $this;
    }
    //endregion

    //region GENERATING METHODS
    function start(): string {

        $str = "<{$this->name()}{$this->attributes()}";

        if ( $this->isSelfClosing() )
            $str .= " /";

        return "$str>";
    }

    function end(): string {

        if ( $this->isSelfClosing() )
            return '';

        return "</{$this->name()}>";
    }

    function __toString(): string {
        return $this->start() . $this->getBody() . $this->end();
    }

    function __get($name)
    {
        return $this->getAttribute($name);
    }

    function __set($name, $value)
    {
        $this->setAttribute($name, $value);
    }
    //endregion

}
