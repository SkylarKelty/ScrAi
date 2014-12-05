<?php
/**
 * Core Library.
 * 
 * @author Skylar Kelty <S.Kelty@kent.ac.uk>
 */

namespace Scrabble;

/**
 * A scrabble board.
 */
class Board {
	private $_data;

	/**
	 * Construct a new board.
	 */
	public function __construct() {
		global $SESSION;

		$this->clear_board();
		$this->set_bonuses();


		if (isset($SESSION->board_data)) {
			$this->unserialize($SESSION->board_data);
		}
	}

	/**
	 * Return numbers of rows.
	 */
	public function get_rows() {
		for ($i = 0; $i < 15; $i++) {
			yield $i;
		}
	}

	/**
	 * Return numbers of columns.
	 */
	public function get_columns() {
		for ($i = 0; $i < 15; $i++) {
			yield $i;
		}
	}

	/**
	 * Return a specific cell.
	 */
	public function get_cell($row, $column) {
		return $this->_data[$row][$column];
	}

	/**
	 * Blank the tile set.
	 */
	private function clear_board() {
		$this->_data = array();

		foreach ($this->get_rows() as $row) {
			$this->_data[$row] = array();
			foreach ($this->get_columns() as $column) {
				$this->_data[$row][$column] = new Cell();
			}
		}
	}

	/**
	 * Set bonuses.
	 */
	private function set_bonuses() {
		$twowords = array(
			1 => array(1, 13),
			2 => array(2, 12),
			3 => array(3, 11),
			4 => array(4, 10),
			10 => array(4, 10),
			11 => array(3, 11),
			12 => array(2, 12),
			13 => array(1, 13)
		);

		$threewords = array(
			0 => array(0, 7, 14),
			7 => array(0, 14),
			14 => array(0, 7, 14)
		);

		$twoletters = array(
			0 => array(3, 11),
			2 => array(6, 8),
			3 => array(0, 7, 14),
			6 => array(2, 6, 8, 12),
			7 => array(3, 11),
			8 => array(2, 6, 8, 12),
			11 => array(0, 7, 14),
			12 => array(6, 8),
			14 => array(3, 11)
		);

		$threeletters = array(
			1 => array(5, 9),
			5 => array(1, 5, 9, 13),
			9 => array(1, 5, 9, 13),
			13  =>array(5, 9),
		);

		foreach ($this->get_rows() as $row) {
			foreach ($this->get_columns() as $column) {
				$cell = $this->get_cell($row, $column);

				if (isset($twowords[$row]) && in_array($column, $twowords[$row])) {
					$cell->set_bonus(Cell::CELL_BONUS_2W);
				}

				if (isset($threewords[$row]) && in_array($column, $threewords[$row])) {
					$cell->set_bonus(Cell::CELL_BONUS_3W);
				}

				if (isset($twoletters[$row]) && in_array($column, $twoletters[$row])) {
					$cell->set_bonus(Cell::CELL_BONUS_2L);
				}

				if (isset($threeletters[$row]) && in_array($column, $threeletters[$row])) {
					$cell->set_bonus(Cell::CELL_BONUS_3L);
				}

				if ($row == 7 && $column == 7) {
					$cell->set_bonus(Cell::CELL_BONUS_ST);
				}
			}
		}
	}

	/**
	 * Save the board to session.
	 */
	public function save() {
		global $SESSION;

		$SESSION->board_data = $this->serialize();
	}

	/**
	 * Serialize the board.
	 */
	public function serialize() {
		$rows = array();
		foreach ($this->get_rows() as $row) {
			$columns = array();
			foreach ($this->get_columns() as $column) {
				$cell = $this->get_cell($row, $column);
				$columns[] = $cell->get_value();
			}

			$rows[] = implode(',', $columns);
		}

		return implode('|', $rows);
	}

	/**
	 * Get a board from session.
	 */
	public function unserialize($data) {
		$rows = explode('|', $data);
		foreach ($this->get_rows() as $row) {
			$columns = explode(',', $rows[$row]);
			foreach ($this->get_columns() as $column) {
				$cell = $this->get_cell($row, $column);
				$cell->set_value($columns[$column]);
			}
		}
	}
}