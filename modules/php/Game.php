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

use Bga\GameFramework\Actions\Types\StringParam;

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

    public function actCountSpaces(?int $clientVersion, string $line_id)
    {
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

        $this->notify->all(
            "countSpaces",
            clienttranslate('${player_name} finds ${spaceCount} space(s) ${line_type} ${line_id}'),
            [
                "player_id" => $player_id,
                "player_name" => $this->getPlayerNameById($player_id),
                "spaceCount" => $spaceCount,
                "lineType" => $lineType,
                "line_type" => $lineType === "row" ? clienttranslate("row") : clienttranslate("column"),
                "line_id" => $line_id,
                "i18n" => ["line_type"],
            ]
        );

        $this->gamestate->nextState("nextPlayer");
    }

    /**
     * Game state arguments, example content.
     *
     * This method returns some additional information that is very specific to the `playerTurn` game state.
     *
     * @return array
     * @see ./states.inc.php
     */
    public function argPlayerTurn(): array
    {
        return [];
    }

    public function st_betweenPlayers(): void
    {
        $player_id = $this->getActivePlayerId();
        $this->giveExtraTime($player_id);
        $this->activeNextPlayer();

        $this->gamestate->nextState("nextPlayer");
    }

    // Utility functions

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

    public function getCode(): int
    {
        $code = "";
        for ($position = 1; $position <= 6; $position++) {
            $digit = $this->globals->get("digit-{$position}");
            $code .= "$digit";
        }

        return (int) $code;
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
    public function stNextPlayer(): void {}

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

        $result["players"] = $this->getCollectionFromDb(
            "SELECT `player_id` `id`, `player_score` `score` FROM `player`"
        );
        $result["code"] = $this->getCode();

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
}
