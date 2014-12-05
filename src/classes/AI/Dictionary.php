<?php
/**
 * Core Library.
 * 
 * @author Skylar Kelty <S.Kelty@kent.ac.uk>
 */

namespace AI;

/**
 * A Dictionary.
 */
class Dictionary
{
	private $_count;
	private $_wordlist;

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->_wordlist = Trie::create_root_node();
		$this->generate_wordlist();
	}

	/**
	 * Grab valid words from dictionary.
	 */
	private function generate_wordlist() {
		gc_collect_cycles();
		gc_disable();
		$this->_count = 0;

		$file = "/usr/share/dict/british-english";
		$contents = file_get_contents($file);

		preg_match_all("/\b([a-z]+)\b/", $contents, $matches, PREG_SET_ORDER);
		foreach ($matches as $match) {
			$this->_count++;
			$letters = str_split($match[0]);
			sort($letters);
			$this->_wordlist->add_word($letters, $match[0]);
		}
	}

	/**
	 * Return word count.
	 */
	public function get_word_count() {
		return $this->_count;
	}

	/**
	 * Lookup a set of letters in the dictionary.
	 */
	public function lookup(array $letters) {
		sort($letters);
		return $this->_wordlist->lookup($letters);
	}
}