<?php
defined('DS') OR define('DS', DIRECTORY_SEPARATOR);
// All needed functions to help the website go faster.

function activeLink2($segment, $link) {
    if($segment == $link) {
        $row = ' active ';
    } else {
        $row = ' ';
    }
    return $row;
}


function activeLink($segment, $link) {
    if (empty($segment) && empty($link)) {
        return 'active';
    } elseif ($segment == $link) {
        return 'active';
    } else {
        return '';
    }
}


function formSelected($target, $value) {
    if($target == $value) {
        $row = ' selected ';
    } else {
        $row = ' ';
    }
    return $row;
}


