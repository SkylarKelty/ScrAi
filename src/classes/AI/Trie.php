<?php
/**
 * Core Library.
 * 
 * @author Skylar Kelty <S.Kelty@kent.ac.uk>
 */

namespace AI;

/**
 * A Trie data structure.
 */
class Trie
{
	/**
	 * The letter this trie represents.
	 * @var string
	 */
	private $_value;

	/**
	 * Reference to our parent (for statistics).
	 */
	private $_parent;

	/**
	 * The number of children we have below us (total).
	 * @var integer
	 */
	private $_children_count;

	/**
	 * All of our child nodes.
	 * @var array
	 */
	private $_children;

	/**
	 * The completed words this level contains.
	 * @var array
	 */
	private $_words;

	/**
	 * Constructor.
	 */
	private function __construct() {
		$this->_value = 0; // Root node.
		$this->_children_count = 0;
		$this->_children = array();
		$this->_words = array();
	}

	/**
	 * Build root node.
	 */
	public static function create_root_node() {
		static $trie;
		if (!isset($trie)) {
			$trie = new static();
		}

		return $trie;
	}

	/**
	 * Notify me of a new child.
	 */
	private function on_new_child() {
		$this->_children_count++;
	}

	/**
	 * Build child.
	 */
	private function create_child_node($value) {
		// Stats.
		$this->on_new_child();
		if ($this->_parent !== null) {
			$this->_parent->on_new_child();
		}

		// Create the new node.
		$trie = new static();
		$trie->_value = $value;
		$trie->_parent = $this;
		return $trie;
	}

	/**
	 * Add a word to this structure.
	 */
	public function add_word(array $letters, $word, $pos = 0) {
		if (!isset($letters[$pos])) {
			// End of the road.
			if (!in_array($word, $this->_words)) {
				$this->_words[] = $word;
			}
			return;
		}

		$char = $letters[$pos];

		// Do we have a child of this character?
		if (!isset($this->_children[$char])) {
			$this->_children[$char] = $this->create_child_node($char);
		}

		$this->_children[$char]->add_word($letters, $word, $pos + 1);
	}

	/**
	 * Return word count.
	 */
	public function get_child_count() {
		return $this->_children_count;
	}

	/**
	 * Lookup a set of letters in the dictionary.
	 */
	public function lookup($letters, $pos = 0) {
		if (!isset($letters[$pos])) {
			return $this->_words;
		}

		$char = $letters[$pos];
		if (!isset($this->_children[$char])) {
			return null;
		}

		$child = $this->_children[$char];
		return $child->lookup($letters, $pos + 1);
	}
}