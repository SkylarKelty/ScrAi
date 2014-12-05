<?php
/**
 * Core Library.
 * 
 * @author Skylar Kelty <S.Kelty@kent.ac.uk>
 */

namespace AI;

/**
 * AI Core.
 */
class Core
{
	private $_dictionary;
	private $_board;

	/**
	 * Constructor.
	 */
	public function __construct($board) {
		$this->_dictionary = new Dictionary();
		$this->_board = $board;
	}

	/**
	 * The big suggest method.
	 * Given a rack, and knowing the board, find the best move.
	 */
	public function suggest($rack) {
		$letters = $rack->get_letters();

		// Is the board empty?
		if ($this->_board->is_empty()) {
			// First go!
			// Just find a big word.
			$matches = $this->_dictionary->lookup($letters);
			$word = $this->get_largest($matches);
			return $this->generate_move($word, 7, 7);
		}
	}

	/**
	 * Generate a move.
	 */
	public function generate_move($word, $startrow, $startcol, $direction = 1) {
		$move = array();
		$row = $startrow;
		$column = $startcol;

		$letters = str_split($word);
		foreach ($letters as $letter) {
			$move[$row][$column] = $letter;

			if ($direction == 1) {
				$column++;
			} else {
				$row++;
			}
		}

		return $move;
	}

	/**
	 * Grab the biggest word in a set.
	 */
	public function get_largest($set) {
		usort($set, function($a, $b) {
			return strlen($a) < strlen($b);
		});

		return reset($set);
	}
}