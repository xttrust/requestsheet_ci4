<?php

function _messageForbidden() {
    $message = "Oops! Access Denied.";
    $message .= "<hr>";
    $message .= "We apologize, but you do not have the necessary privileges to "
            . "view this content. If you think this is a mistake, please contact our support team for assistance.";
    return $message;
}

function _messageLogin() {
    $message = "Access Restricted: Please Log in to Continue.";
    return $message;
}
