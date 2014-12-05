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
		$this->_wordlist = array();
		$this->generate_wordlist();
	}

	/**
	 * Grab valid words from dictionary.
	 */
	private function generate_wordlist() {
		$this->_count = 0;

		$file = "/usr/share/dict/words";
		$contents = file_get_contents($file);

		preg_match_all("/\b([a-z]+)\b/", $contents, $matches, PREG_SET_ORDER);
		foreach ($matches as $match) {
			$this->_count++;
			$this->_wordlist[$match[0]] = str_split($match[0]);
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
		$results = array();
		foreach ($this->_wordlist as $key => $arr) {
			$lookup = $letters;
			$valid = true;
			foreach ($arr as $letter) {
				$lookupindex = array_search($letter, $lookup);
				if ($lookupindex === false) {
					$valid = false;
					break;
				}

				unset($lookup[$lookupindex]);
			}

			if ($valid) {
				$results[] = $key;
			}
		}

		return $results;
	}
}