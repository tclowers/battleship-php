<?php

final class Battleship {
	public $board;
	public $pieces;
	public $boardSize;
	public $emptySpace;

	public function __construct() {
		$this->emptySpace = ". ";

		$this->board = [];

		$line = [];
		for ($b = 0; $b < 10; $b++) {
			$line[]= $this->emptySpace;
		}

		for ($a = 0; $a < 10; $a++) {
			$this->board[]= $line;
		}

		$this->pieces = [
			'tug' => [
				'symbol' => 'T',
				'size' => 2
			],
			'destroyer' => [
				'symbol' => 'D',
				'size' => 3
			],
			'submarine' => [
				'symbol' => 'S',
				'size' => 3
			],
			'battleship' => [
				'symbol' => 'B',
				'size' => 4
			],
			'cruiser' => [
				'symbol' => 'C',
				'size' => 5
			]
		];

		// 10 columns x 10 rows (offset by 1 for index starting at 0)
		$this->boardSize = 10 - 1;
	}

	public function getSpace($size = 0) {
		if (is_int($size)) {
			$space_limit = $this->boardSize - $size;
			return rand(0,$space_limit);
		}
		return (bool)false;
	}

	public function isVertical() {
		return (bool)rand(0,1);
	}

	public function setPiece($piece) {
		$space_available = false;
		$is_vertical = $this->isVertical();
		while (!$space_available) {
			$random_row = $is_vertical ? $this->getSpace($piece['size']) : $this->getSpace();
			$random_column = $is_vertical ? $this->getSpace() : $this->getSpace($piece['size']);
			$space_available = $this->checkSpaces($piece['size'], $random_column, $random_row, $is_vertical);
		}
		for ($i = 0; $i < $piece['size']; $i++) {
			$this->board[$random_row][$random_column] = $piece['symbol'] . " ";
			if ($is_vertical) {
				$random_row++;
			} else {
				$random_column++;
			}
		}
	}

	public function checkSpaces($size, $column, $row, $is_vertical) {
		for ($i = 0; $i < $size; $i++) {
			if ($this->board[$row][$column] != $this->emptySpace) {
				return false;
			}
			if ($is_vertical) {
				$row++;
			} else {
				$column++;
			}
		}

		return true;
	}

	public function setupBoard() {
		foreach($this->pieces as $piece) {
			$this->setPiece($piece);
		}
	}

	public function toString() {
		$board = "";
		foreach($this->board as $line) {
			foreach($line as $space) {
				$board .= $space;
			}
			$board .= PHP_EOL;
		}
		return $board;
	}
}


$battleship = new Battleship();
$battleship->setupBoard();
echo $battleship->toString();