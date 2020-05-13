<?php

include_once "autoload.php";

class Queue implements Iterator {
    protected $queue;
    protected $position = 0;

    function get($key, $default = null) {
        return $this->queue[$key] ?? $default;
    }

    function enqueue($value) {
        $this->queue[] = $value;
    }

    function dequeue() {
        unset($this->queue[key($this->queue)]);
        return $this->queue[key($this->queue)];
    }

    function toArray(): array {
        return $this->queue;
    }

    function keys() {
        return array_keys($this->toArray());
    }

    function rewind() {
        $this->position = 0;
    }

    function next() {
        $this->position++;
    }

    function current() {
        return $this->get($this->key());
    }

    function key() {
        $keys = $this->keys();
        return $keys[$this->position];
    }

    function valid() {
        $keys = $this->keys();
        return isset($keys[$this->position]);
    }
}

$people = new Queue();
$people->enqueue("John");
$people->enqueue("Mike");
$people->enqueue("Sarah");
$people->enqueue("Trevor");

$people->dequeue();

foreach ($people as $key => $value) {
    echo "<br>{$value}<br>";
}
