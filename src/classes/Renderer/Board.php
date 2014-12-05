<?php
/**
 * Core Library.
 * 
 * @author Skylar Kelty <S.Kelty@kent.ac.uk>
 */

namespace Renderer;

/**
 * A scrabble board renderer.
 */
class Board {
	/**
	 * Render a board.
	 */
	public function render($board) {
		echo '<table>';
		foreach ($board->get_rows() as $row) {
			echo '<tr>';
			foreach ($board->get_columns() as $column) {
				$cell = $board->get_cell($row, $column);
				$class = $cell->get_bonus_string();
				if (!empty($class)) {
					$class = " class=\"bonus_{$class}\"";
				}

				$htmlrow = " data-row=\"{$row}\"";
				$htmlcolumn = " data-column=\"{$column}\"";

				echo "<td{$class}{$htmlrow}{$htmlcolumn}>" . $cell->get_value(). "</td>";
			}
			echo '</tr>';
		}
		echo '</table>';
	}
}