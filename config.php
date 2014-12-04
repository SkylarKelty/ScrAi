<?php
/**
 * Rapid Prototyping Framework in PHP.
 * 
 * @author Skylar Kelty <skylarkelty@gmail.com>
 */
global $CFG;

$CFG = new \stdClass();
$CFG->brand = 'ScrAi';
$CFG->dirroot = dirname(__FILE__);
$CFG->cssroot = $CFG->dirroot . '/media/css';
$CFG->jsroot = $CFG->dirroot . '/media/js';
$CFG->wwwroot = 'http://localhost:9000';
$CFG->tilesize = 256;
$CFG->cachedir = '/tmp';
$CFG->developer_mode = true;

$CFG->cache = array(
    'servers' => array(
        array('localhost', '11211')
    ),
    'prefix' => 'rapid_'
);

$CFG->menu = array(
    'Home' => '/demo/index.php'
);

require_once($CFG->dirroot . '/src/setup.php');
