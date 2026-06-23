<?php
/**
 * Proxy View
 * 
 * Injects a <base> tag to ensure faithful rendering of external content.
 */
$url = $url ?? '';
$content = $content ?? '';

// Inject <base> tag in the <head>
if (strpos($content, '<head>') !== false) {
    $content = str_replace('<head>', '<head><base href="' . $url . '">', $content);
} elseif (strpos($content, '<HEAD>') !== false) {
    $content = str_replace('<HEAD>', '<HEAD><base href="' . $url . '">', $content);
} else {
    // If no <head> is found, we might still want to add it or just output
    $content = '<base href="' . $url . '">' . $content;
}

echo $content;
