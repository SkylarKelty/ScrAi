<?php
/**
 * Core Library.
 * 
 * @author Skylar Kelty <S.Kelty@kent.ac.uk>
 */

require_once(dirname(__FILE__) . '/../config.php');

$value = $_GET['value'];
$row = $_GET['row'];
$column = $_GET['column'];

$board = new \Scrabble\Board();
$cell = $board->get_cell($row, $column);

$cell->set_value($value);

$board->save();
