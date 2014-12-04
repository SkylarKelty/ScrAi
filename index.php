<?php

require_once('config.php');

$PAGE->set_url('/');
$PAGE->set_title("Rapid Protoyping Framework Home");

echo $OUTPUT->header();

$board = new \Scrabble\Board();

$renderer = new \Renderer\Board();
echo $renderer->render($board);

echo $OUTPUT->footer();