<?php
/**
 * Core Library.
 * 
 * @author Skylar Kelty <S.Kelty@kent.ac.uk>
 */

define('CLI_SCRIPT', true);

require_once(dirname(__FILE__) . '/../config.php');

$letters = $argv[1];
$letters = str_split($letters);

$time = microtime(true);
print_memory();

$dictionary = new \AI\Dictionary();
$count = $dictionary->get_word_count();

$point = microtime(true) - $time;
echo "Prepared lookup table of {$count} words in {$point}s.\n";
print_memory();

$result = $dictionary->lookup($letters);
print_r($result);

$point = microtime(true) - $time;

$count = count($result);
echo "Found {$count} results in {$point}s.\n";
print_memory();