<?php
/**
 * Core Library.
 * 
 * @author Skylar Kelty <S.Kelty@kent.ac.uk>
 */

namespace Scrabble;

/**
 * A scrabble rack.
 */
class Rack
{
	private $_data;

	/**
	 * Construct a new rack.
	 */
	public function __construct() {
		global $SESSION;

		$this->clear_rack();

		if (isset($SESSION->rack_data)) {
			$this->unserialize($SESSION->rack_data);
		}
	}

	/**
	 * Return numbers of tiles in the rack.
	 */
	public function get_tiles() {
		for ($i = 0; $i < 7; $i++) {
			yield $i;
		}
	}

	/**
	 * Return a specific cell.
	 */
	public function get_tile($tile) {
		return $this->_data[$tile];
	}

	/**
	 * Return a specific tile.
	 */
	public function set_tile($tile, $value) {
		$this->_data[$tile] = strtolower($value);
	}

	/**
	 * Blank the tile set.
	 */
	private function clear_rack() {
		$this->_data = array();

		foreach ($this->get_tiles() as $tile) {
			$this->set_tile($tile, '');
		}
	}

	/**
	 * Return all letters in the rack.
	 */
	public function get_letters() {
		return array_values($this->_data);
	}

	/**
	 * Save the rack to session.
	 */
	public function save() {
		global $SESSION;

		$SESSION->rack_data = $this->serialize();
	}

	/**
	 * Serialize the rack.
	 */
	public function serialize() {
		$tiles = array();
		foreach ($this->get_letters() as $letter) {
			$tiles[] = $letter;
		}

		return implode('|', $tiles);
	}

	/**
	 * Get a rack from session.
	 */
	public function unserialize($data) {
		$tiles = explode('|', $data);
		foreach ($this->get_tiles() as $tile) {
			$this->set_tile($tile, $tiles[$tile]);
		}
	}
}