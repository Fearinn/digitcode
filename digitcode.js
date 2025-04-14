/**
 *------
 * BGA framework: Gregory Isabelli & Emmanuel Colin & BoardGameArena
 * DigitCode implementation : © Matheus Gomes matheusgomesforwork@gmail.com
 *
 * This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
 * See http://en.boardgamearena.com/#!doc/Studio for more information.
 * -----
 *
 * digitcode.js
 *
 * DigitCode user interface script
 *
 * In this file, you are describing the logic of your user interface, in Javascript language.
 *
 */

define([
  "dojo",
  "dojo/_base/declare",
  "ebg/core/gamegui",
  "ebg/counter",
], function (dojo, declare) {
  return declare("bgagame.digitcode", ebg.core.gamegui, {
    constructor: function () {
      console.log("digitcode constructor");
    },

    setup: function (gamedatas) {
      this.setupNotifications();

      console.log(gamedatas.code, "CODE");
      console.log("Ending game setup");

      for (const line_id in gamedatas.countedLines) {
        const spaceCount = gamedatas.countedLines[line_id];
        const lineMarker = document.querySelector(
          `[data-lineMarker=${line_id}`
        );
        lineMarker.classList.add("dgt_lineMarker-confirmed");
        lineMarker.textContent = spaceCount;
      }

      for (const digit_id in gamedatas.checkedDigits) {
        const parity = gamedatas.checkedDigits[digit_id];
        const parityMarker = document.getElementById(
          `dgt_parityMarker-${parity}-${digit_id}`
        );
        parityMarker.classList.add("dgt_parityMarker-confirmed");
      }

      for (const space_id in gamedatas.checkedSpaces) {
        const spaceFilled = gamedatas.checkedSpaces[space_id];

        const filledOrEmpty = spaceFilled ? "filled" : "empty";
        const spaceElement = document.getElementById(`dgt_space-${space_id}`);
        spaceElement.classList.add(`dgt_space-confirmed-${filledOrEmpty}`);
        this.addTooltip(spaceElement.id, _(filledOrEmpty), "");
      }

      for (const comparison_id in gamedatas.comparedDigits) {
        const digit_id = gamedatas.comparedDigits[comparison_id];
        const smallerDigit_id = comparison_id.split("").filter((l_digit_id) => {
          return digit_id != l_digit_id;
        })[0];

        const comparisonIcon = document.querySelector(
          `[data-comparisonIcon="${digit_id}>${smallerDigit_id}"]`
        );
        comparisonIcon.classList.add(`dgt_comparisonIcon-confirmed`);
        this.addTooltip(
          comparisonIcon.id,
          this.format_string(_("${digit_id} is larger"), { digit_id }),
          ""
        );
      }
    },

    ///////////////////////////////////////////////////
    //// Game & client states

    onEnteringState: function (stateName, args) {
      console.log("Entering state: " + stateName, args);

      if (!this.isCurrentPlayerActive()) {
        return;
      }

      if (stateName.includes("client_")) {
        this.statusBar.addActionButton(
          _("Cancel"),
          () => {
            this.restoreServerGameState();
          },
          {
            color: "alert",
          }
        );
      }

      if (stateName === "playerTurn") {
        const {
          countableLines,
          checkableDigits,
          checkableSpaces,
          comparableDigits,
        } = args.args;

        this.statusBar.addActionButton(_("(Row / column) count spaces"), () => {
          this.setClientState("client_countSpaces", {
            descriptionmyturn: _(
              "${you} must pick the column or row to count the spaces from"
            ),
            client_args: {
              countableLines,
            },
          });
        });

        this.statusBar.addActionButton(_("(Number) even or odd?"), () => {
          this.setClientState("client_checkParity", {
            descriptionmyturn: _(
              "${you} must pick a number to check its parity"
            ),
            client_args: {
              checkableDigits,
            },
          });
        });

        this.statusBar.addActionButton(_("(Space) empty or filled?"), () => {
          this.setClientState("client_checkSpace", {
            descriptionmyturn: _(
              "${you} must pick a space to check if it's filled"
            ),
            client_args: {
              checkableSpaces,
            },
          });
        });

        this.statusBar.addActionButton(_("Compare numbers"), () => {
          this.setClientState("client_compareDigits", {
            descriptionmyturn: _(
              "${you} must pick two adjacent numbers to compare"
            ),
            client_args: {
              comparableDigits,
            },
          });
        });
      }

      if (stateName === "client_countSpaces") {
        const { countableLines } = args.client_args;
        this.setSelectableLabels(countableLines, (label_id) => {
          this.actCountSpaces(label_id);
        });
      }

      if (stateName === "client_checkParity") {
        const { checkableDigits } = args.client_args;
        this.setSelectableLabels(checkableDigits, (label_id) => {
          this.actCheckParity(label_id);
        });
      }

      if (stateName === "client_checkSpace") {
        const { checkableSpaces } = args.client_args;
        this.setSelectableSpaces(checkableSpaces);
      }

      if (stateName === "client_compareDigits") {
        const { comparableDigits } = args.client_args;
        this.setSelectableComparisons(comparableDigits);
      }
    },

    onLeavingState: function (stateName) {
      console.log("Leaving state: " + stateName);

      if (stateName === "client_countSpaces") {
        this.setSelectableLabels(null, null, true);
      }

      if (stateName === "client_checkParity") {
        this.setSelectableLabels(null, null, true);
      }

      if (stateName === "client_checkSpace") {
        this.setSelectableSpaces(null, true);
      }

      if (stateName === "client_compareDigits") {
        this.setSelectableComparisons(null, true);
      }
    },

    onUpdateActionButtons: function (stateName, args) {},

    ///////////////////////////////////////////////////
    //// Utility methods

    toggleConfirmationBtn: function (add = false, callback = () => {}) {
      document.getElementById("dgt_confirmationBtn")?.remove();

      if (!add) {
        return;
      }

      this.statusBar.addActionButton(
        _("Confirm selection"),
        () => {
          callback();
        },
        {
          id: "dgt_confirmationBtn",
        }
      );
    },

    setSelectableLabels: function (
      selectableLabels,
      callback,
      unselect = false
    ) {
      const labelElements = document.querySelectorAll("[data-label]");
      labelElements.forEach((labelElement) => {
        if (unselect) {
          labelElement.classList.remove("dgt_label-selectable");
          labelElement.classList.remove("dgt_label-unselectable");
          labelElement.classList.remove("dgt_label-selected");
          labelElement.onclick = undefined;
          return;
        }

        const label_id = labelElement.dataset.label;
        const isSelectable = selectableLabels.includes(label_id);
        const selectableOrUnselectable = isSelectable
          ? "selectable"
          : "unselectable";
        labelElement.classList.add(`dgt_label-${selectableOrUnselectable}`);

        if (isSelectable) {
          const selectedClass = "dgt_label-selected";
          labelElement.onclick = () => {
            const isSelected = !labelElement.classList.contains(selectedClass);

            this.toggleConfirmationBtn(isSelected, () => {
              callback(label_id);
            });

            if (isSelected) {
              labelElements.forEach((loopElement) => {
                if (loopElement.id == labelElement.id) {
                  return;
                }

                loopElement.classList.remove(selectedClass);
              });
            }

            labelElement.classList.toggle(selectedClass);
          };
        }
      });
    },

    setSelectableSpaces: function (selectableSpaces, unselect = false) {
      const spaceElements = document.querySelectorAll("[data-space]");
      spaceElements.forEach((spaceElement) => {
        if (unselect) {
          spaceElement.classList.remove("dgt_space-selectable");
          spaceElement.classList.remove("dgt_space-unselectable");
          spaceElement.classList.remove("dgt_space-selected");
          spaceElement.onclick = undefined;
          return;
        }

        const space_id = spaceElement.dataset.space;

        const isSelectable = selectableSpaces.includes(space_id);
        const selectableOrUnselectable = isSelectable
          ? "selectable"
          : "unselectable";
        spaceElement.classList.add(`dgt_space-${selectableOrUnselectable}`);

        if (isSelectable) {
          const selectedClass = "dgt_space-selected";
          spaceElement.onclick = () => {
            const isSelected = !spaceElement.classList.contains(selectedClass);

            this.toggleConfirmationBtn(isSelected, () => {
              this.actCheckSpace(space_id);
            });

            if (isSelected) {
              spaceElements.forEach((loopElement) => {
                if (loopElement.id == spaceElement.id) {
                  return;
                }

                loopElement.classList.remove(selectedClass);
              });
            }

            spaceElement.classList.toggle(selectedClass);
          };
        }
      });
    },

    setSelectableComparisons: function (
      selectableComparisons,
      unselect = false
    ) {
      const comparisonElements = document.querySelectorAll("[data-comparison]");
      comparisonElements.forEach((comparisonElement) => {
        if (unselect) {
          comparisonElement.classList.remove("dgt_comparisonMarker-selectable");
          comparisonElement.classList.remove(
            "dgt_comparisonMarker-unselectable"
          );
          comparisonElement.classList.remove("dgt_comparisonMarker-selected");
          comparisonElement.onclick = undefined;
          return;
        }

        const comparison_id = comparisonElement.dataset.comparison;

        const isSelectable = selectableComparisons.includes(comparison_id);
        const selectableOrUnselectable = isSelectable
          ? "selectable"
          : "unselectable";
        comparisonElement.classList.add(
          `dgt_comparisonMarker-${selectableOrUnselectable}`
        );

        if (isSelectable) {
          const selectedClass = "dgt_comparisonMarker-selected";
          comparisonElement.onclick = () => {
            const isSelected =
              !comparisonElement.classList.contains(selectedClass);

            this.toggleConfirmationBtn(isSelected, () => {
              this.actCompareDigits(comparison_id);
            });

            if (isSelected) {
              comparisonElements.forEach((loopElement) => {
                if (loopElement.id == comparisonElement.id) {
                  return;
                }

                loopElement.classList.remove(selectedClass);
              });
            }

            comparisonElement.classList.toggle(selectedClass);
          };
        }
      });
    },

    ///////////////////////////////////////////////////
    //// Player's actions

    performAction: function (action, args = {}, config = {}) {
      args.clientVersion = this.gamedatas.GAME_VERSION;
      this.bgaPerformAction(action, args, config);
    },

    actCountSpaces: function (line_id) {
      this.performAction("actCountSpaces", { line_id });
    },

    actCheckParity: function (digit_id) {
      this.performAction("actCheckParity", { digit_id });
    },

    actCheckSpace: function (space_id) {
      this.performAction("actCheckSpace", { space_id });
    },

    actCompareDigits: function (comparison_id) {
      const [digit1_id, digit2_id] = comparison_id.split("");
      this.performAction("actCompareDigits", { digit1_id, digit2_id });
    },

    ///////////////////////////////////////////////////
    //// Reaction to cometD notifications

    setupNotifications: function () {
      console.log("notifications subscriptions setup");
      this.bgaSetupPromiseNotifications();
    },

    notif_countSpaces: function (args) {
      const { line_id, spaceCount } = args;
      const lineMarker = document.querySelector(`[data-lineMarker=${line_id}`);
      lineMarker.textContent = spaceCount;
      lineMarker.classList.add("dgt_lineMarker-confirmed");
    },

    notif_checkParity: function (args) {
      const { parity, digit_id } = args;
      document
        .getElementById(`dgt_parityMarker-${parity}-${digit_id}`)
        .classList.add("dgt_parityMarker-confirmed");
    },

    notif_checkSpace: function (args) {
      const { space_id, spaceFilled } = args;

      const filledOrEmpty = spaceFilled ? "filled" : "empty";

      const spaceElement = document.getElementById(`dgt_space-${space_id}`);
      spaceElement.classList.add(`dgt_space-confirmed-${filledOrEmpty}`);
      this.addTooltip(spaceElement.id, _(filledOrEmpty), "");
    },

    notif_compareDigits: function (args) {
      const { digit_id, smallerDigit_id } = args;
      const comparisonIcon = document.querySelector(
        `[data-comparisonIcon="${digit_id}>${smallerDigit_id}"]`
      );

      comparisonIcon.classList.add(`dgt_comparisonIcon-confirmed`);
      this.addTooltip(
        comparisonIcon.id,
        this.format_string(_("${digit_id} is larger"), { digit_id }),
        ""
      );
    },
  });
});
