<?php
/**
 * Core Library.
 * 
 * @author Skylar Kelty <S.Kelty@kent.ac.uk>
 */

require_once('config.php');

$PAGE->set_url('/');
$PAGE->set_title("Rapid Protoyping Framework Home");

echo $OUTPUT->header();

echo '
<div id="cellinput" class="row">
	<div class="col-lg-6 col-lg-offset-3">
		<div class="input-group">
  			<input type="text" class="form-control" id="cellvalue">
			<span class="input-group-btn">
				<button class="btn btn-default btn-save" type="button">Save!</button>
			</span>
		</div>
	</div>
</div>
';

$board = new \Scrabble\Board();
$renderer = new \Renderer\Board();
echo $renderer->render($board);

$rack = new \Scrabble\Rack();
$renderer = new \Renderer\Rack();
echo $renderer->render($rack);

echo $OUTPUT->footer();