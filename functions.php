<?php

function dd(mixed $data){
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die();
}