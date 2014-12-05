<?php
/**
 * Core Library.
 * 
 * @author Skylar Kelty <S.Kelty@kent.ac.uk>
 */

if (!defined('CLI_SCRIPT')) {
    define('CLI_SCRIPT', false);
}

// Register the autoloader now.
spl_autoload_register(function($class) {
    global $CFG;

    $parts = explode('\\', $class);

    $filename = $CFG->dirroot . '/src/classes/' . implode('/', $parts) . '.php';
    if (file_exists($filename)) {
        require_once($filename);
    }
});

// Register the composer autoloaders.
require_once($CFG->dirroot . '/vendor/autoload.php');

// Cache connection.
$CACHE = new \Rapid\Data\Memcached($CFG->cache['servers'], $CFG->cache['prefix']);

if (!defined('CLI_SCRIPT') || !CLI_SCRIPT) {
    // Start a session.
    $SESSION = new \Rapid\Auth\Session();

    // Setup a guest user by default.
    $USER = new \Rapid\Auth\User();

    // Output library.
    $OUTPUT = new \Rapid\Presentation\Output();

    // Page library.
    $PAGE = new \Rapid\Presentation\Page();

    // Set a default page title.
    $PAGE->set_title('ScrAi');

    // Setup navigation.
    $PAGE->menu($CFG->menu);
} else {
    if (isset($_SERVER['REMOTE_ADDR']) || php_sapi_name() != 'cli') {
        die("Must be run from CLI.");
    }
}

function format_bytes($bytes) {
    $unit = 'b';

    if ($bytes > 10000) {
        $bytes = $bytes / 1024;
        $unit = 'kb';
    }

    if ($bytes > 10000) {
        $bytes = $bytes / 1024;
        $unit = 'mb';
    }

    if ($bytes > 1000) {
        $bytes = $bytes / 1024;
        $unit = 'gb';
    }

    return round($bytes, 2) . $unit;
}

function print_memory() {
    $memory = memory_get_usage();
    $peak = memory_get_peak_usage();

    echo format_bytes($memory) . " / " . format_bytes($peak) . "\n";
}