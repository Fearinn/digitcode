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

$this->SPACES = [
        "TAK" => [
                "x" => 0,
                "y" => 1,
                "digit" => "T",
        ],
        "TAM" => [
                "x" => 0,
                "y" => 3,
                "digit" => "T",
        ],
        "TBJ" => [
                "x" => 1,
                "y" => 0,
                "digit" => "T",
        ],
        "TBL" => [
                "x" => 1,
                "y" => 2,
                "digit" => "T",
        ],
        "TBN" => [
                "x" => 1,
                "y" => 4,
                "digit" => "T",
        ],
        "TCK" => [
                "x" => 2,
                "y" => 1,
                "digit" => "T",
        ],
        "TCM" => [
                "x" => 2,
                "y" => 3,
                "digit" => "T",
        ],
        "UDK" => [
                "x" => 0,
                "y" => 1,
                "digit" => "U",
        ],
        "UDM" => [
                "x" => 0,
                "y" => 3,
                "digit" => "U",
        ],
        "UEJ" => [
                "x" => 1,
                "y" => 0,
                "digit" => "U",
        ],
        "UEL" => [
                "x" => 1,
                "y" => 2,
                "digit" => "U",
        ],
        "UEN" => [
                "x" => 1,
                "y" => 4,
                "digit" => "U",
        ],
        "UFK" => [
                "x" => 2,
                "y" => 1,
                "digit" => "U",
        ],
        "UFM" => [
                "x" => 2,
                "y" => 3,
                "digit" => "U",
        ],
        "VGK" => [
                "x" => 0,
                "y" => 1,
                "digit" => "V",
        ],
        "VGM" => [
                "x" => 0,
                "y" => 3,
                "digit" => "V",
        ],
        "VHJ" => [
                "x" => 1,
                "y" => 0,
                "digit" => "V",
        ],
        "VHL" => [
                "x" => 1,
                "y" => 2,
                "digit" => "V",
        ],
        "VHN" => [
                "x" => 1,
                "y" => 4,
                "digit" => "V",
        ],
        "VIK" => [
                "x" => 2,
                "y" => 1,
                "digit" => "V",
        ],
        "VIM" => [
                "x" => 2,
                "y" => 3,
                "digit" => "V",
        ],
        "WAP" => [
                "x" => 0,
                "y" => 1,
                "digit" => "W",
        ],
        "WAR" => [
                "x" => 0,
                "y" => 3,
                "digit" => "W",
        ],
        "WBO" => [
                "x" => 1,
                "y" => 0,
                "digit" => "W",
        ],
        "WBQ" => [
                "x" => 1,
                "y" => 2,
                "digit" => "W",
        ],
        "WBS" => [
                "x" => 1,
                "y" => 4,
                "digit" => "W",
        ],
        "WCP" => [
                "x" => 2,
                "y" => 1,
                "digit" => "W",
        ],
        "WCR" => [
                "x" => 2,
                "y" => 3,
                "digit" => "W",
        ],
        "XDP" => [
                "x" => 0,
                "y" => 1,
                "digit" => "X"
        ],
        "XDR" => [
                "x" => 0,
                "y" => 3,
                "digit" => "X"
        ],
        "XEO" => [
                "x" => 1,
                "y" => 0,
                "digit" => "X"
        ],
        "XEQ" => [
                "x" => 1,
                "y" => 2,
                "digit" => "X"
        ],
        "XES" => [
                "x" => 1,
                "y" => 4,
                "digit" => "X"
        ],
        "XFP" => [
                "x" => 2,
                "y" => 1,
                "digit" => "X"
        ],
        "XFR" => [
                "x" => 2,
                "y" => 3,
                "digit" => "X"
        ],
        "YGP" => [
                "x" => 0,
                "y" => 1,
                "digit" => "Y",
        ],
        "YGR" => [
                "x" => 0,
                "y" => 3,
                "digit" => "Y",
        ],
        "YHO" => [
                "x" => 1,
                "y" => 0,
                "digit" => "Y",
        ],
        "YHQ" => [
                "x" => 1,
                "y" => 2,
                "digit" => "Y",
        ],
        "YHS" => [
                "x" => 1,
                "y" => 4,
                "digit" => "Y",
        ],
        "YIP" => [
                "x" => 2,
                "y" => 1,
                "digit" => "Y",
        ],
        "YIR" => [
                "x" => 2,
                "y" => 3,
                "digit" => "Y",
        ],
];

$this->COMPARISONS = [
        "TU",
        "TW",
        "UV",
        "UX",
        "VY",
        "WX",
        "XY",
];
