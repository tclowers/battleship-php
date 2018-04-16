<?php

use PHPUnit\Framework\TestCase;

require './Battleship.php';

final class BattleshipTest extends TestCase
{
	protected $battleship;

	protected function setUp()
	{
		$this->battleship = new Battleship();
	}

	public function testHasToString() {
		$this->assertTrue(
			method_exists('Battleship', 'toString')
		);
	}

	public function testToStringHasOutput() {
		$board = $this->battleship->toString();
		$this->assertNotNull($board);
	}

	public function testToStringOutputsString() {
		$board = $this->battleship->toString();
		$this->assertInternalType('string', $board);
	}

	public function testSetupOutputs10Lines() {
		$board = $this->battleship->toString();

		$lines = substr_count($board, PHP_EOL);
		$this->assertEquals(10, $lines);
	}

	public function testHasSetupBoard() {
		$this->assertTrue(
			method_exists('Battleship', 'setupBoard')
		);
	}

	public function testHasIsVertical() {
		$this->assertTrue(
			method_exists('Battleship', 'isVertical')
		);
	}

	public function testIsVerticalReturnsBool() {
		$result = $this->battleship->isVertical();
		$this->assertInternalType('bool', $result);
	}

	public function testHasGetSpace() {
		$this->assertTrue(
			method_exists('Battleship', 'getSpace')
		);
	}

	public function testHasSetPiece() {
		$this->assertTrue(
			method_exists('Battleship', 'setPiece')
		);
	}

    /**
     * @dataProvider sizeProvider
     */
	public function testGetSpaceReturnsInt($size, $expected) {
		$this->assertEquals(
			$expected,
			is_int($this->battleship->getSpace($size))
		);
	}

	/**
	 * @dataProvider pieceProvider
	 */
	public function testSetPiece($symbol, $size, $expected) {
		$this->battleship->setupBoard();
		$board = $this->battleship->toString();
		echo($board);

		$piece_size = substr_count($board, $symbol);
		$equal = $size == $piece_size;
		$this->assertEquals($expected, $equal);
	}

	/* Data Providers */
	public function sizeProvider()
    {
        return [
            [2, true],
            [6, true],
            [5, true],
            [3, true],
            ['taco', false],
            ['34dsfae', false]
        ];
    }

	public function pieceProvider()
    {
        return [
			['T', 2, true],
			['D', 3, true],
			['S', 3, true],
			['B', 4, true],
			['C', 5, true],
			['B', 8, false],
			['Y', 4, false]
		];
    }
}