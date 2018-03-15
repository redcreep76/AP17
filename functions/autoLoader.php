<?php

function autoLoader($className) {
    include_once "./classes/" . $className . ".php";
}