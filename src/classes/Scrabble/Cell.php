<?php
/**
 * Core Library.
 * 
 * @author Skylar Kelty <S.Kelty@kent.ac.uk>
 */

namespace Scrabble;

/**
 * A scrabble cell.
 */
class Cell {
	const CELL_BONUS_ST = 0;
	const CELL_BONUS_2W = 1;
	const CELL_BONUS_3W = 2;
	const CELL_BONUS_2L = 4;
	const CELL_BONUS_3L = 8;

	private $_bonus;
	private $_value;

	/**
	 * A cell.
	 */
	public function __construct() {
		$this->_bonus = -1;
		$this->set_value('');
	}

	/**
	 * Get the value.
	 */
	public function get_value() {
		return $this->_value;
	}

	/**
	 * Set the value.
	 */
	public function set_value($letter) {
		$this->_value = $letter;
	}

	/**
	 * Set the cell bonus.
	 */
	public function set_bonus($bonus) {
		$this->_bonus = $bonus;
	}

	/**
	 * Get the cell bonus.
	 */
	public function get_bonus() {
		return $this->_bonus;
	}

	/**
	 * Get the cell bonus as a string.
	 */
	public function get_bonus_string() {
		switch ($this->_bonus) {
			case static::CELL_BONUS_ST:
			return "ST";

			case static::CELL_BONUS_2W:
			return "2W";

			case static::CELL_BONUS_3W:
			return "3W";

			case static::CELL_BONUS_2L:
			return "2L";

			case static::CELL_BONUS_3L:
			return "3L";
		}

		return "";
	}
}