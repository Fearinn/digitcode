<?php
/**
 *------
 * BGA framework: Gregory Isabelli & Emmanuel Colin & BoardGameArena
 * DigitCode implementation : © Matheus Gomes matheusgomesforwork@gmail.com
 *
 * This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
 * See http://en.boardgamearena.com/#!doc/Studio for more information.
 * -----
 *
 * states.inc.php
 *
 * DigitCode game states description
 *
 */

$machinestates = [
    // The initial state. Please do not modify.
    1 => array(
        "name" => "gameSetup",
        "description" => "",
        "type" => "manager",
        "action" => "stGameSetup",
        "transitions" => ["" => 2]
    ),

    2 => [
        "name" => "playerTurn",
        "description" => clienttranslate('${actplayer} must ask a question or submit a solution'),
        "descriptionmyturn" => clienttranslate('${you} must ask a question or submit a solution'),
        "type" => "activeplayer",
        "args" => "arg_playerTurn",
        "possibleactions" => [
            "actCountSpaces",
            "actCheckParity",
            "actCompareDigits",
            "actCheckSpace",
            "actSubmitSolution",
        ],
        "transitions" => ["nextPlayer" => 3, "gameEnd" => 99],
    ],

    3 => [
        "name" => "betweenPlayers",
        "description" => '',
        "type" => "game",
        "action" => "st_betweenPlayers",
        "updateGameProgression" => true,
        "transitions" => ["gameEnd" => 99, "nextPlayer" => 2]
    ],

    // Final state.
    // Please do not modify (and do not overload action/args methods).
    99 => [
        "name" => "gameEnd",
        "description" => clienttranslate("End of game"),
        "type" => "manager",
        "action" => "stGameEnd",
        "args" => "argGameEnd"
    ],
];



