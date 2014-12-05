<?php
/**
 * Core Library.
 * 
 * @author Skylar Kelty <S.Kelty@kent.ac.uk>
 */

namespace Renderer;

/**
 * A scrabble rack renderer.
 */
class Rack
{
	/**
	 * Render a player rack.
	 */
	public function render($rack) {
		echo '<table class="rack">';
		echo '<tr>';
		foreach ($rack->get_tiles() as $tile) {
			$value = $rack->get_tile($tile);
			echo "<td data-rackid=\"{$tile}\">{$value}</td>";
		}
		echo '</tr>';
		echo '</table>';
	}
}