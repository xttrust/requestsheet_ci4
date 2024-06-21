<?php 

/** 
 * Displaying errors to form after validation
 */

function display_form_errors($validation, $field)
{
    if($validation->hasError($field))
    {
        return $validation->getError($field);
    }
}