<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * yipl_citation_get_path
 *
 * Returns the plugin path to a specified file.
 *
 * @param   string $filename The specified file.
 * @return  string
 */
function yipl_citation_get_path($filename = '') {
    return YIPL_CITATION_PATH . ltrim($filename, '/');
}

/**
 * Includes a file within the yipl-citation plugin.
 *
 * @param   string $filename The specified file.
 * @return  void
 */
function yipl_citation_include($filename = '') {
    $file_path = yipl_citation_get_path($filename);
    if (file_exists($file_path)) {
        include_once $file_path;
    }
}


/**
 * requires all ".php" files from dir defined in "include_dir_paths" at first level.
 * @param array $include_dir_paths will be [__DIR__.'/inc'];
 */
function yipl_citation_include_path_files($include_dir_paths) {
    foreach ($include_dir_paths as $key => $file_path) {
        if (!file_exists($file_path)) {
            continue;
        }
        foreach (new \DirectoryIterator($file_path) as $file) {
            if ($file->isDot() || $file->isDir()) {
                continue;
            }
            $fileExtension = $file->getExtension(); // Get the current file extension
            if ($fileExtension != "php") {
                continue;
            }
            // $fileName = $file->getFilename(); // Get the full name of the current file.
            $filePath = $file->getPathname(); // Get the full path of the current file
            if ($filePath) {
                require_once $filePath;
            }
        }
    }
}


/**
 * include lib files
 */
$include_paths = [
    YIPL_CITATION_PATH . '/lib',
];
yipl_citation_include_path_files($include_paths);
