<?php
// Supported languages
const SUPPORTED_LANGS = ['cs', 'sk', 'en'];
const DEFAULT_LANG    = 'cs';

// Switch language via ?lang=xx
if (isset($_GET['lang']) && in_array($_GET['lang'], SUPPORTED_LANGS, true)) {
    setcookie('lang', $_GET['lang'], time() + 60 * 60 * 24 * 365, '/');
    $_COOKIE['lang'] = $_GET['lang'];

    // Redirect without ?lang= in URL
    $url = strtok($_SERVER['REQUEST_URI'], '?');
    header('Location: ' . $url);
    exit;
}

// Active language
$lang = $_COOKIE['lang'] ?? DEFAULT_LANG;
if (!in_array($lang, SUPPORTED_LANGS, true)) {
    $lang = DEFAULT_LANG;
}

// Load translations
require_once __DIR__ . '/../lang/' . $lang . '.php';
