<?php
/**
 * Core Library.
 * 
 * @author Skylar Kelty <S.Kelty@kent.ac.uk>
 */

require_once(dirname(__FILE__) . '/../config.php');

$board = new \Scrabble\Board();
$rack = new \Scrabble\Rack();

// Okay so we need a word.
$ai = new \AI\Core($board);
$move = $ai->suggest($rack);

echo json_encode($move);