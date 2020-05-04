<?php

require_once('./turnier.php');

class Importer
{
    function __construct()
    {
        $this->grid = [];
    }


    function import($filename)
    {
        $contents = file_get_contents($filename);
        $this->fillGrid($contents);
    }

    public function getTournaments()
    {
        $tournaments = [];
        for ($index = 1; $index < sizeof($this->grid[0]); $index+=8) {
            $tournament = new Tournament();

            $dateTimeString = $this->grid[2][$index] . "-" . $this->grid[3][$index];
            $dateTime = DateTime::createFromFormat('d.m.Y-H:i', $dateTimeString);

            $tournament->date = $dateTime ? $dateTime->getTimestamp() : 0;
            $tournament->buyIn = $this->grid[6][$index];

            $tournament->winner = $this->grid[12][$index];
            $tournament->second = $this->grid[13][$index];
            $tournament->third = $this->grid[14][$index];

            $tournament->moneyFirst = $this->grid[12][$index + 1];
            $tournament->moneySecond = $this->grid[13][$index + 1];
            $tournament->moneyThird = $this->grid[14][$index + 1];

            $tournaments[] = $tournament;
        }
        return $tournaments;
    }

    private function fillGrid($contents)
    {
        $rows = explode("\n", $contents);
        for ($rowIndex = 0; $rowIndex < sizeof($rows); $rowIndex++) {
            $row = $rows[$rowIndex];
            $row = preg_replace('/"(\d+),(\d+)"/i', '${1}.${2}', $row);
            $cols = explode(',', $row);
            for ($colIndex = 0; $colIndex < sizeof($cols); $colIndex++) {
                $this->grid[$rowIndex][$colIndex] = $cols[$colIndex];
            }
        }
    }
}
