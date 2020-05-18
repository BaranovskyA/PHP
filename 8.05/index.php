<?php

require_once 'classes/Tag.php';

$div = new Tag('div');

$div->addClass('container'); // class="container"
$div->addClass('bg-blue'); // class="container bg-blue"
$div->addClass('bg-blue'); // class="container bg-blue"
$div->addClass('bg-blue2222222');

if ($div->classExists('container')) // true
    $div->removeClass('container'); //class="bg-blue"

echo $div;