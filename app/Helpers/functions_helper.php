<?php

defined('DS') OR define('DS', DIRECTORY_SEPARATOR);

// Helper functions to make the website development faster and easier

/**
 * Add 'active' class to the link if the segment matches.
 *
 * @param string $segment Current URL segment
 * @param string $link Expected URL segment
 * @return string 'active' class if segments match, empty string otherwise
 */
function activeLink($segment, $link) {
    return (empty($segment) && empty($link)) || ($segment == $link) ? 'active' : '';
}

/**
 * Add 'selected' attribute to the form option if the target matches the value.
 *
 * @param string $target Selected value
 * @param string $value Option value
 * @return string 'selected' attribute if values match, empty string otherwise
 */
function formSelected($target, $value) {
    return ($target == $value) ? ' selected ' : ' ';
}

/**
 * Generate an absolute URL from a relative path.
 *
 * @param string $path Relative URL path
 * @return string Absolute URL
 */
function absolute_url($path = '') {
    return base_url($path);
}

/**
 * Generate the full path for assets (e.g., CSS, JS, images).
 *
 * @param string $path Relative path to the asset
 * @return string Full URL to the asset
 */
function asset_url($path = '') {
    return base_url('public/assets/' . $path);
}

/**
 * Generate the full path for uploads
 *
 * @param string $path Relative path to the uploads
 * @return string Full URL to the uploads
 */
function uploads_url($path = '') {
    return base_url('public/uploads/' . $path);
}

/**
 * Truncate a text string to a specified length, appending an ending if truncated.
 *
 * @param string $text The text to truncate
 * @param int $limit Maximum length of the text
 * @param string $ending String to append if text is truncated
 * @return string Truncated text
 */
function truncate_text($text, $limit = 100, $ending = '...') {
    return strlen($text) > $limit ? substr($text, 0, $limit) . $ending : $text;
}

/**
 * Convert HTML content to plain text.
 *
 * @param string $html HTML content
 * @return string Plain text content
 */
function html_to_text($html) {
    return strip_tags($html);
}

/**
 * Format a date to a specified format.
 *
 * @param string $date Date string
 * @param string $format Desired date format (e.g., 'Y-m-d')
 * @return string Formatted date
 */
function format_date($date, $format = 'Y-m-d') {
    return date($format, strtotime($date));
}

/**
 * Get the time elapsed since a given datetime.
 *
 * @param string $datetime Datetime string
 * @param bool $full Whether to show the full or just the largest unit of time
 * @return string Human-readable time ago format
 */
function time_ago($datetime, $full = false) {
    $now = new DateTime();
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );

    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full)
        $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

/**
 * Check if a file's extension is allowed.
 *
 * @param string $filename Name of the file
 * @param array $allowed_extensions List of allowed extensions
 * @return bool True if extension is allowed, false otherwise
 */
function check_file_extension($filename, $allowed_extensions = []) {
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    return in_array($ext, $allowed_extensions);
}

/**
 * Get the size of a file.
 *
 * @param string $file_path Path to the file
 * @return int File size in bytes
 */
function get_file_size($file_path) {
    return filesize($file_path);
}

/**
 * Create a formatted input field with attributes.
 *
 * @param string $name Name attribute of the input field
 * @param string $value Value attribute of the input field
 * @param string $type Type of the input field (e.g., 'text', 'password')
 * @param array $attributes Additional HTML attributes
 * @return string HTML input field
 */
function formatted_input($name, $value = '', $type = 'text', $attributes = []) {
    $attr = '';
    foreach ($attributes as $key => $val) {
        $attr .= $key . '="' . htmlspecialchars($val) . '" ';
    }
    return "<input type='$type' name='$name' value='" . htmlspecialchars($value) . "' $attr />";
}

/**
 * Retrieve a flash message from the session.
 *
 * @param string $key Flash message key
 * @return string Flash message content
 */
function get_flash_message($key) {
    return session()->getFlashdata($key) ?? '';
}

/**
 * Sanitize a string for safe output in HTML.
 *
 * @param string $string The string to sanitize
 * @return string Sanitized string
 */
function sanitize_output($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

/**
 * Generate a random alphanumeric string of a specified length.
 *
 * @param int $length Length of the random string
 * @return string Random string
 */
function random_string($length = 10) {
    return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length);
}
