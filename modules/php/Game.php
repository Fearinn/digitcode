<?php

/**
 *------
 * BGA framework: Gregory Isabelli & Emmanuel Colin & BoardGameArena
 * DigitCode implementation : © <Your name here> <Your email address here>
 *
 * This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
 * See http://en.boardgamearena.com/#!doc/Studio for more information.
 * -----
 *
 * Game.php
 *
 * This is the main file for your game logic.
 *
 * In this PHP file, you are going to defines the rules of the game.
 */

declare(strict_types=1);

namespace Bga\Games\DigitCode;

use Bga\GameFramework\Actions\CheckAction;
use Bga\GameFramework\Actions\Types\JsonParam;
use Bga\GameFramework\Actions\Types\StringParam;

const COUNTABLE_LINES = "countableLines";
const COUNTED_LINES = "countedLines";
const CHECKABLE_DIGITS = "checkableDigits";
const CHECKED_DIGITS = "checkDigits";
const CHECKABLE_SPACES = "checkableSpaces";
const CHECKED_SPACES = "checkedSpaces";
const COMPARABLE_DIGITS = "comparableDigits";
const COMPARED_DIGITS = "comparedDigits";
const DRAFT = "draft";

require_once(APP_GAMEMODULE_PATH . "module/table/table.game.php");

class Game extends \Table
{
    /**
     * Your global variables labels:
     *
     * Here, you can assign labels to global variables you are using for this game. You can use any number of global
     * variables with IDs between 10 and 99. If your game has options (variants), you also have to associate here a
     * label to the corresponding ID in `gameoptions.inc.php`.
     *
     * NOTE: afterward, you can get/set the global variables with `getGameStateValue`, `setGameStateInitialValue` or
     * `setGameStateValue` functions.
     */
    public array $DIGITS;
    public array $LINES;
    public array $ALGARISMS;

    public function __construct()
    {
        parent::__construct();

        require "material.inc.php";

        $this->initGameStateLabels([]);
    }

    /**
     * Player actions
     *
     * @throws BgaUserException
     */

    public function actCountSpaces(?int $CLIENT_VERSION, string $line_id)
    {
        $this->checkVersion($CLIENT_VERSION);

        $player_id = $this->getActivePlayerId();

        $line = (array) $this->LINES[$line_id];

        $lineType = (string) $line["type"];
        $linePosition = (int) $line["position"];
        $digit_ids = (array) $line["digits"];

        $spaceCount = 0;
        foreach ($digit_ids as $digit_id) {
            $digit = (array) $this->DIGITS[$digit_id];
            $digitPosition = (int) $digit["position"];

            $algarism = (int) $this->globals->get("digit-{$digitPosition}");
            $algarismSpaces = (array) $this->ALGARISMS[$algarism];

            if ($lineType === "column") {
                foreach ($algarismSpaces as $row) {
                    $space = (int) $row[$linePosition];
                    if ($space === 1) {
                        $spaceCount++;
                    }
                }
            }

            if ($lineType === "row") {
                $row = (array) $algarismSpaces[$linePosition];
                foreach ($row as $space) {
                    if ($space === 1) {
                        $spaceCount++;
                    }
                }
            }
        }

        $countableLines = $this->globals->get(COUNTABLE_LINES);

        if (!in_array($line_id, $countableLines)) {
            throw new \BgaVisibleSystemException("Invalid row or column");
        }

        $countableLines = array_filter(
            $countableLines,
            function ($l_line_id) use ($line_id) {
                return $l_line_id !== $line_id;
            }
        );
        $this->globals->set(COUNTABLE_LINES, array_values($countableLines));

        $countedLines = $this->globals->get(COUNTED_LINES);
        $countedLines[$line_id] = $spaceCount;
        $this->globals->set(COUNTED_LINES, $countedLines);

        $type_label = $lineType === "row" ? clienttranslate("row") : clienttranslate("column");

        $this->notify->all(
            "message",
            clienttranslate('${player_name} counts the spaces of ${row_or_column} ${line_label}'),
            [
                "player_id" => $player_id,
                "player_name" => $this->getPlayerNameById($player_id),
                "line_label" => $line_id,
                "row_or_column" => $type_label,
                "i18n" => ["row_or_column"],
                "line_id" => $line_id,
            ]
        );

        $this->notify->all(
            "countSpaces",
            clienttranslate('${row_or_column} ${line_label} has ${spaceCount} filled spaces'),
            [
                "spaceCount" => $spaceCount,
                "lineType" => $lineType,
                "row_or_column" => $type_label,
                "line_label" => $line_id,
                "i18n" => ["row_or_column"],
                "line_id" => $line_id,
            ]
        );

        $this->gamestate->nextState("nextPlayer");
    }

    public function actCheckParity(?int $CLIENT_VERSION, string $digit_id): void
    {
        $this->checkVersion($CLIENT_VERSION);

        $player_id = (int) $this->getActivePlayerId();

        $digit = (array) $this->DIGITS[$digit_id];
        $digitPosition = (int) $digit["position"];
        $algarism = $this->globals->get("digit-{$digitPosition}");

        $checkableDigits = $this->globals->get(CHECKABLE_DIGITS);

        $checkableDigits = array_filter(
            $checkableDigits,
            function ($l_digit_id) use ($digit_id) {
                return $l_digit_id !== $digit_id;
            }
        );
        $this->globals->set(CHECKABLE_DIGITS, array_values($checkableDigits));

        $parity = $algarism % 2 === 0 ? "even" : "odd";

        $checkedDigits = $this->globals->get(CHECKED_DIGITS);
        $checkedDigits[$digit_id] = $parity;
        $this->globals->set(CHECKED_DIGITS, $checkedDigits);

        $this->notify->all(
            "message",
            clienttranslate('${player_name} asks the parity of ${digit_label}'),
            [
                "player_id" => $player_id,
                "player_name" => $this->getPlayerNameById($player_id),
                "digit_label" => $digit_id,
                "digit_id" => $digit_id,
            ]
        );

        $this->notify->all(
            "checkParity",
            clienttranslate('${digit_label} is ${parity_label}'),
            [
                "parity_label" => $parity === "even" ? _("even") : _("odd"),
                "digit_label" => $digit_id,
                "i18n" => ["parity_label"],
                "parity" => $parity,
                "digit_id" => $digit_id,
            ]
        );

        $this->gamestate->nextState("nextPlayer");
    }

    public function actCheckSpace(?int $CLIENT_VERSION, #[StringParam(alphanum: true)] string $space_id): void
    {
        $this->checkVersion($CLIENT_VERSION);

        $player_id = (int) $this->getActivePlayerId();

        $checkableSpaces = $this->globals->get(CHECKABLE_SPACES);

        if (!in_array($space_id, $checkableSpaces)) {
            throw new \BgaVisibleSystemException("Invalid space");
        }

        $checkableSpaces = array_filter(
            $checkableSpaces,
            function ($l_space_id) use ($space_id) {
                return $l_space_id !== $space_id;
            }
        );
        $this->globals->set(CHECKABLE_SPACES, array_values($checkableSpaces));

        $this->notify->all(
            "message",
            clienttranslate('${player_name} checks the space ${space_label}'),
            [
                "player_id" => $player_id,
                "player_name" => $this->getActivePlayerName(),
                "space_label" => $space_id,
                "space_id" => $space_id,
            ]
        );

        $digit_id = substr($space_id, 0, 1);
        $digit = (array) $this->DIGITS[$digit_id];
        $digitPosition = (int) $digit["position"];

        $space = (array) $this->SPACES[$space_id];
        $x = (int) $space["x"];
        $y = (int) $space["y"];

        $algarism = $this->globals->get("digit-{$digitPosition}");
        $algarismSpaces = $this->ALGARISMS[$algarism];
        $spaceFilled = !!$algarismSpaces[$y][$x];

        $checkedSpaces = $this->globals->get(CHECKED_SPACES);
        $checkedSpaces[$space_id] = $spaceFilled;
        $this->globals->set(CHECKED_SPACES, $checkedSpaces);

        $this->notify->all(
            "checkSpace",
            clienttranslate('${space_label} is ${filled_or_empty}'),
            [
                "space_label" => $space_id,
                "filled_or_empty" => $spaceFilled ? clienttranslate("filled") : clienttranslate("empty"),
                "i18n" => ["filled_or_empty"],
                "space_id" => $space_id,
                "spaceFilled" => $spaceFilled,
            ]
        );

        $this->gamestate->nextState("nextPlayer");
    }

    public function actCompareDigits(
        ?int $checkVersion,
        #[StringParam(enum: ["T", "U", "V", "W", "X", "Y"])] string $digit1_id,
        #[StringParam(enum: ["T", "U", "V", "W", "X", "Y"])] string $digit2_id
    ): void {
        $this->checkVersion($checkVersion);

        $player_id = $this->getActivePlayerId();

        $digit_ids = [$digit1_id, $digit2_id];
        sort($digit_ids);
        $comparison_id = implode("", $digit_ids);

        $comparableDigits = $this->globals->get(COMPARABLE_DIGITS);

        if (!in_array($comparison_id, $comparableDigits)) {
            throw new \BgaVisibleSystemException("Invalid comparison");
        };

        $comparableDigits = array_filter(
            $comparableDigits,
            function ($comparison_id) use ($digit1_id, $digit2_id) {
                return !(str_contains($comparison_id, $digit1_id) && str_contains($comparison_id, $digit2_id));
            }
        );
        $this->globals->set(COMPARABLE_DIGITS, array_values($comparableDigits));

        $this->notify->all(
            "message",
            clienttranslate('${player_name} compares ${digit1_label} and ${digit2_label}'),
            [
                "player_id" => $player_id,
                "player_name" => $this->getPlayerNameById($player_id),
                "digit1_label" => $digit1_id,
                "digit2_label" => $digit2_id,
            ]
        );

        $position1 = (int) $this->DIGITS[$digit1_id]["position"];
        $position2 = (int) $this->DIGITS[$digit2_id]["position"];

        $algarism1 = $this->globals->get("digit-{$position1}");
        $algarism2 = $this->globals->get("digit-{$position2}");

        $algarisms = [$digit1_id => $algarism1, $digit2_id => $algarism2];
        arsort($algarisms);

        $largerDigit_id = key($algarisms);
        next($algarisms);
        $smallerDigit_id = key($algarisms);

        $comparedDigits = $this->globals->get(COMPARED_DIGITS);
        $comparedDigits[$comparison_id] = $largerDigit_id;
        $this->globals->set(COMPARED_DIGITS, $comparedDigits);

        $this->notify->all(
            "compareDigits",
            clienttranslate('${digit_label} is larger than ${smallerDigit_label}'),
            [
                "digit_label" => $largerDigit_id,
                "smallerDigit_label" => $smallerDigit_id,
                "digit_id" => $largerDigit_id,
                "smallerDigit_id" => $smallerDigit_id
            ]
        );

        $this->gamestate->nextState("nextPlayer");
    }

    #[CheckAction(false)]
    public function actSaveDraft(?int $CLIENT_VERSION, #[JsonParam(alphanum: true)] array $draft): void
    {
        $this->checkVersion($CLIENT_VERSION);

        $player_id = (int) $this->getCurrentPlayerId();
        $players = $this->loadPlayersBasicInfos();

        if (!array_key_exists($player_id, $players)) {
            throw new \BgaVisibleSystemException("Only players may perform this action");
        }

        $playersDraft = (array) $this->globals->get(DRAFT);
        $playersDraft[$player_id] = $draft;
        $this->globals->set(DRAFT, $playersDraft);

        $this->notify->player(
            $player_id,
            "saveDraft",
            ""
        );
    }

    #[CheckAction(false)]
    public function actDeleteDraft(?int $CLIENT_VERSION): void
    {
        $this->checkVersion($CLIENT_VERSION);

        $player_id = (int) $this->getCurrentPlayerId();
        $players = $this->loadPlayersBasicInfos();

        if (!array_key_exists($player_id, $players)) {
            throw new \BgaVisibleSystemException("Only players may perform this action");
        }

        $playersDraft = (array) $this->globals->get(DRAFT);
        $playersDraft[$player_id] = [];
        $this->globals->set(DRAFT, $playersDraft);

        $this->notify->player(
            $player_id,
            "deleteDraft",
            ""
        );
    }

    public function actSubmitSolution(?int $CLIENT_VERSION, #[StringParam(alphanum: true)] $solution): void
    {
        $this->checkVersion($CLIENT_VERSION);

        $this->validateSolution($solution);

        $player_id = (int) $this->getActivePlayerId();

        $code = $this->getCode();
        $isCorrect = $code === $solution;

        if ($isCorrect) {
            $this->notify->all(
                "message",
                clienttranslate('${player_name} cracks the code!'),
                [
                    "player_id" => $player_id,
                    "player_name" => $this->getPlayerNameById($player_id),
                ]
            );

            $this->notify->all(
                "revealCode",
                clienttranslate('The code was ${code_label}'),
                [
                    "code_label" => $code,
                    "code" => $code,
                ],
            );

            $this->DbQuery("UPDATE player SET player_score=1 WHERE player_id={$player_id}");
            $this->gamestate->nextState("gameEnd");
            return;
        }

        $this->notify->all(
            "message",
            clienttranslate('${player_name} submits an incorrect solution and loses one chance'),
            [
                "player_id" => $player_id,
                "player_name" => $this->getPlayerNameById($player_id),
            ]
        );

        $this->gamestate->nextState("nextPlayer");
    }

    /**
     * Game state arguments and actions
     *
     *
     * @return array
     * @see ./states.inc.php
     */
    public function arg_playerTurn(): array
    {
        $countableLines = $this->globals->get(COUNTABLE_LINES);
        $checkableDigits = $this->globals->get(CHECKABLE_DIGITS);
        $checkableSpaces = $this->globals->get(CHECKABLE_SPACES);
        $comparableDigits = $this->globals->get(COMPARABLE_DIGITS);

        return [
            "countableLines" => $countableLines,
            "checkableDigits" => $checkableDigits,
            "checkableSpaces" => $checkableSpaces,
            "comparableDigits" => $comparableDigits,
        ];
    }

    public function st_betweenPlayers(): void
    {
        $player_id = $this->getActivePlayerId();
        $this->giveExtraTime($player_id);
        $this->activeNextPlayer();

        $this->gamestate->nextState("nextPlayer");
    }

    // Utility functions

    public function checkVersion(?int $CLIENT_VERSION): void
    {
        if ($CLIENT_VERSION && $CLIENT_VERSION !== (int) $this->gamestate->table_globals[300]) {
            throw new \BgaUserException(clienttranslate("A new version is available. Please reload (F5) the page"));
        }
    }

    public function setupCode(array &$algarismsCounts, int $position = 1): void
    {
        if ($position > 6) {
            return;
        }

        $algarisms = range(0, 9);
        $index = bga_rand(0, 9);
        $digit = $algarisms[$index];

        $equalAdjacent = false;

        foreach ([1, 3] as $shift) {
            if (($position === 1 || $position === 4) && $shift === 1) {
                continue;
            }

            $adjacent_position = $position - $shift;

            if ($this->globals->get("digit-{$adjacent_position}") === $digit) {
                $equalAdjacent = true;
                break;
            }
        }

        $limitReached = $algarismsCounts[$digit] === 2;

        if (!$equalAdjacent && !$limitReached) {
            $this->globals->set("digit-$position", $digit);
            $algarismsCounts[$digit]++;
            $position++;
        }

        $this->setupCode($algarismsCounts, $position);
    }

    public function getCode(): string
    {
        $code = "";
        for ($position = 1; $position <= 6; $position++) {
            $digit = $this->globals->get("digit-{$position}");
            $code .= "$digit";
        }

        return $code;
    }

    public function validateSolution($solution): void
    {
        $algarisms = str_split($solution);

        if (count($algarisms) !== 6) {
            throw new \BgaUserException(clienttranslate("You must submit a valid solution"));
        }

        $equalAdjacent = false;

        $algarismsCounts = array_fill(0, 10, 0);

        foreach ($algarisms as $position => $algarism) {
            foreach ([1, 3] as $shift) {
                if (($position === 0 || $position === 3) && $shift === 1) {
                    continue;
                }

                $adjacent_position = $position - $shift;

                if (!isset($algarisms[$adjacent_position])) {
                    continue;
                }

                if ((int) $algarism === (int) $algarisms[$adjacent_position]) {
                    $equalAdjacent = true;
                    break;
                }
            }

            $limitReached = $algarismsCounts[$algarism] === 2;

            if ($limitReached || $equalAdjacent) {
                throw new \BgaUserException("You must submit a valid solution");
            }

            $algarismsCounts[$algarism]++;
        }
    }

    /**
     * Compute and return the current game progression.
     *
     * The number returned must be an integer between 0 and 100.
     *
     * This method is called each time we are in a game state with the "updateGameProgression" property set to true.
     *
     * @return int
     * @see ./states.inc.php
     */
    public function getGameProgression()
    {
        // TODO: compute and return the game progression

        return 0;
    }

    /**
     * Game state action, example content.
     *
     * The action method of state `nextPlayer` is called everytime the current game state is set to `nextPlayer`.
     */

    /**
     * Migrate database.
     *
     * You don't have to care about this until your game has been published on BGA. Once your game is on BGA, this
     * method is called everytime the system detects a game running with your old database scheme. In this case, if you
     * change your database scheme, you just have to apply the needed changes in order to update the game database and
     * allow the game to continue to run with your new version.
     *
     * @param int $from_version
     * @return void
     */
    public function upgradeTableDb($from_version)
    {
        //       if ($from_version <= 1404301345)
        //       {
        //            // ! important ! Use DBPREFIX_<table_name> for all tables
        //
        //            $sql = "ALTER TABLE DBPREFIX_xxxxxxx ....";
        //            $this->applyDbUpgradeToAllDB( $sql );
        //       }
        //
        //       if ($from_version <= 1405061421)
        //       {
        //            // ! important ! Use DBPREFIX_<table_name> for all tables
        //
        //            $sql = "CREATE TABLE DBPREFIX_xxxxxxx ....";
        //            $this->applyDbUpgradeToAllDB( $sql );
        //       }
    }

    /*
     * Gather all information about current game situation (visible by the current player).
     *
     * The method is called each time the game interface is displayed to a player, i.e.:
     *
     * - when the game starts
     * - when a player refreshes the game page (F5)
     */
    protected function getAllDatas(): array
    {
        $result = [];

        $current_player_id = (int) $this->getCurrentPlayerId();

        $result["GAME_VERSION"] = (int) $this->gamestate->table_globals[300];
        $result["players"] = $this->getCollectionFromDb(
            "SELECT `player_id` `id`, `player_score` `score` FROM `player`"
        );
        $result["code"] = $this->getCode();
        $result["countedLines"] = $this->globals->get(COUNTED_LINES, []);
        $result["checkedDigits"] = $this->globals->get(CHECKED_DIGITS, []);
        $result["checkedSpaces"] = $this->globals->get(CHECKED_SPACES, []);
        $result["comparedDigits"] = $this->globals->get(COMPARED_DIGITS, []);
        $result["draft"] = $this->globals->get(DRAFT)[$current_player_id];

        return $result;
    }

    /**
     * Returns the game name.
     *
     * IMPORTANT: Please do not modify.
     */
    protected function getGameName()
    {
        return "digitcode";
    }

    /**
     * This method is called only once, when a new game is launched. In this method, you must setup the game
     *  according to the game rules, so that the game is ready to be played.
     */
    protected function setupNewGame($players, $options = [])
    {
        // Set the colors of the players with HTML color code. The default below is red/green/blue/orange/brown. The
        // number of colors defined here must correspond to the maximum number of players allowed for the gams.
        $gameinfos = $this->getGameinfos();
        $default_colors = $gameinfos['player_colors'];

        foreach ($players as $player_id => $player) {
            $query_values[] = vsprintf("('%s', '%s', '%s', '%s', '%s')", [
                $player_id,
                array_shift($default_colors),
                $player["player_canal"],
                addslashes($player["player_name"]),
                addslashes($player["player_avatar"]),
            ]);
        }

        static::DbQuery(
            sprintf(
                "INSERT INTO player (player_id, player_color, player_canal, player_name, player_avatar) VALUES %s",
                implode(",", $query_values)
            )
        );

        $this->reattributeColorsBasedOnPreferences($players, $gameinfos["player_colors"]);
        $this->reloadPlayersBasicInfos();

        $algarismsCounts = array_fill(0, 10, 0);
        $this->setupCode($algarismsCounts);

        $this->globals->set(COUNTABLE_LINES, array_keys($this->LINES));
        $this->globals->set(COUNTED_LINES, []);

        $this->globals->set(CHECKABLE_DIGITS, array_keys($this->DIGITS));
        $this->globals->set(CHECKED_DIGITS, []);

        $this->globals->set(CHECKABLE_SPACES, array_keys($this->SPACES));
        $this->globals->set(CHECKED_SPACES, []);

        $this->globals->set(COMPARABLE_DIGITS, $this->COMPARISONS);
        $this->globals->set(COMPARED_DIGITS, []);

        $draft = [];
        foreach ($players as $player_id => $player) {
            $draft[$player_id] = [];
        }
        $this->globals->set(DRAFT, $draft);

        $this->activeNextPlayer();
    }

    /**
     * This method is called each time it is the turn of a player who has quit the game (= "zombie" player).
     * You can do whatever you want in order to make sure the turn of this player ends appropriately
     * (ex: pass).
     *
     * Important: your zombie code will be called when the player leaves the game. This action is triggered
     * from the main site and propagated to the gameserver from a server, not from a browser.
     * As a consequence, there is no current player associated to this action. In your zombieTurn function,
     * you must _never_ use `getCurrentPlayerId()` or `getCurrentPlayerName()`, otherwise it will fail with a
     * "Not logged" error message.
     *
     * @param array{ type: string, name: string } $state
     * @param int $active_player
     * @return void
     * @throws feException if the zombie mode is not supported at this game state.
     */
    protected function zombieTurn(array $state, int $active_player): void
    {
        $state_name = $state["name"];

        if ($state["type"] === "activeplayer") {
            switch ($state_name) {
                default: {
                        $this->gamestate->nextState("zombiePass");
                        break;
                    }
            }

            return;
        }

        if ($state["type"] === "multipleactiveplayer") {
            $this->gamestate->setPlayerNonMultiactive($active_player, '');
            return;
        }

        throw new \feException("Zombie mode not supported at this game state: \"{$state_name}\".");
    }

    public function debug_setupCode(): void
    {
        $algarismsCounts = array_fill(0, 10, 0);
        $this->setupCode($algarismsCounts);
    }

    public function debug_countSpaces(string $line_id): void
    {
        $this->actCountSpaces(null, $line_id);
    }

    public function debug_checkSpace(string $space_id): void
    {
        $this->actCheckSpace(null, $space_id);
    }

    public function debug_compareDigits(string $digit1_id, string $digit2_id): void
    {
        $this->actCompareDigits(null, $digit1_id, $digit2_id);
    }

    public function debug_submitSolution(string $solution): void
    {
        $this->actSubmitSolution(null, $solution);
    }
}
