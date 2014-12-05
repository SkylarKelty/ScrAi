<?php
/**
 * Core Library.
 * 
 * @author Skylar Kelty <S.Kelty@kent.ac.uk>
 */

require_once(dirname(__FILE__) . '/../config.php');

$value = $_GET['value'];
$rackid = $_GET['rackid'];

$rack = new \Scrabble\Rack();
$rack->set_tile($rackid, $value);
$rack->save();
