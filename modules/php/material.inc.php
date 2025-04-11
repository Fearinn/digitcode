<?php

$this->ALGARISMS = [
        0 => [
                [0, 1, 0],
                [1, 0, 1],
                [0, 0, 0],
                [1, 0, 1],
                [0, 1, 0],
        ],
        1 => [
                [0, 0, 0],
                [0, 0, 1],
                [0, 0, 0],
                [0, 0, 1],
                [0, 0, 0],
        ],
        2 => [
                [0, 1, 0],
                [0, 0, 1],
                [0, 1, 0],
                [1, 0, 0],
                [0, 1, 0],
        ],
        3 => [
                [0, 1, 0],
                [0, 0, 1],
                [0, 1, 0],
                [0, 0, 1],
                [0, 1, 0],
        ],
        4 => [
                [0, 0, 0],
                [1, 0, 1],
                [0, 1, 0],
                [0, 0, 1],
                [0, 0, 0],
        ],
        5 => [
                [0, 1, 0],
                [1, 0, 0],
                [0, 1, 0],
                [0, 0, 1],
                [0, 1, 0],
        ],
        6 => [
                [0, 1, 0],
                [1, 0, 0],
                [0, 1, 0],
                [1, 0, 1],
                [0, 1, 0],
        ],
        7 => [
                [0, 1, 0],
                [0, 0, 1],
                [0, 0, 0],
                [0, 0, 1],
                [0, 0, 0],
        ],
        8 => [
                [0, 1, 0],
                [1, 0, 1],
                [0, 1, 0],
                [1, 0, 1],
                [0, 1, 0],
        ],
        9 => [
                [0, 1, 0],
                [1, 0, 1],
                [0, 1, 0],
                [0, 0, 1],
                [0, 1, 0],
        ],
];

$this->LINES = [
        "A" => [
                "type" => "column",
                "position" => 0,
                "digits" => ["T", "W"],
        ],
        "B" => [
                "type" => "column",
                "position" => 1,
                "digits" => ["T", "W"],
        ],
        "C" => [
                "type" => "column",
                "position" => 2,
                "digits" => ["T", "W"],
        ],
        "D" => [
                "type" => "column",
                "position" => 0,
                "digits" => ["U", "X"],
        ],
        "E" => [
                "type" => "column",
                "position" => 1,
                "digits" => ["U", "X"],
        ],
        "F" => [
                "type" => "column",
                "position" => 2,
                "digits" => ["U", "X"],
        ],
        "G" => [
                "type" => "column",
                "position" => 0,
                "digits" => ["V", "Y"],
        ],
        "H" => [
                "type" => "column",
                "position" => 1,
                "digits" => ["V", "Y"],
        ],
        "I" => [
                "type" => "column",
                "position" => 2,
                "digits" => ["V", "Y"],
        ],
        "J" => [
                "type" => "row",
                "position" => 0,
                "sequence" => 1,
                "digits" => ["T", "U", "V"],
        ],
        "K" => [
                "type" => "row",
                "position" => 1,
                "sequence" => 1,
                "digits" => ["T", "U", "V"],
        ],
        "L" => [
                "type" => "row",
                "position" => 2,
                "sequence" => 1,
                "digits" => ["T", "U", "V"],
        ],
        "M" => [
                "type" => "row",
                "position" => 3,
                "sequence" => 1,
                "digits" => ["T", "U", "V"],
        ],
        "N" => [
                "type" => "row",
                "position" => 4,
                "sequence" => 2,
                "digits" => ["T", "U", "V"],
        ],
        "O" => [
                "type" => "row",
                "position" => 0,
                "sequence" => 2,
                "digits" => ["W", "X", "Y"],
        ],
        "P" => [
                "type" => "row",
                "position" => 1,
                "sequence" => 2,
                "digits" => ["W", "X", "Y"],
        ],
        "Q" => [
                "type" => "row",
                "position" => 2,
                "sequence" => 2,
                "digits" => ["W", "X", "Y"],
        ],
        "R" => [
                "type" => "row",
                "position" => 3,
                "sequence" => 2,
                "digits" => ["W", "X", "Y"],
        ],
        "S" => [
                "type" => "row",
                "position" => 4,
                "sequence" => 2,
                "digits" => ["W", "X", "Y"],
        ],
];

$this->DIGITS = [
        "T" => [
                "position" => 1,
        ],
        "U" => [
                "position" => 2,
        ],
        "V" => [
                "position" => 3,
        ],
        "W" => [
                "position" => 4,
        ],
        "X" => [
                "position" => 5,
        ],
        "Y" => [
                "position" => 6,
        ],
];
