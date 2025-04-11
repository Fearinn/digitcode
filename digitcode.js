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
    },

    ///////////////////////////////////////////////////
    //// Game & client states

    onEnteringState: function (stateName, args) {
      console.log("Entering state: " + stateName, args);

      if (!this.isCurrentPlayerActive()) {
        return;
      }

      if (stateName === "playerTurn") {
        this.statusBar.addActionButton(_("Count spaces"), () => {
          this.setClientState("client_countSpaces", {
            descriptionmyturn: _(
              "${you} must pick the column or row to count the spaces from"
            ),
            client_args: {
              countableLines: args.countableLines,
            },
          });
        });
      }

      if (stateName === "client_countSpaces") {
        const countableLines = args.client_args.countableLines;
        this.setSelectableLabels();
      }
    },

    onLeavingState: function (stateName) {
      console.log("Leaving state: " + stateName);

      switch (stateName) {
        case "dummy":
          break;
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

    setSelectableLabels: function (selectableLabels, unselect = false) {
      const labelElements = document.querySelectorAll("[data-label]");
      labelElements.forEach((labelElement) => {
        const label_id = labelElement.dataset.label;
        const isSelectable = selectableLabels.includes(label_id);
        const classSufix = isSelectable ? "selectable" : "unselectable";
        labelElement.classList.add(`dgt_label-${classSufix}`);

        if (isSelectable) {
          const selectedClass = "dgt_label-selected";
          labelElement.onclick = () => {
            const isSelected = !labelElement.classList.contains(selectedClass);

            this.toggleConfirmationBtn(isSelected, () => {
              this.actCountSpaces(label_id);
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

    ///////////////////////////////////////////////////
    //// Player's actions

    performAction: function (action, args = {}, config = {}) {
      args.clientVersion = this.gamedatas.clientVersion;
      this.bgaPerformAction(action, args, config);
    },

    actCountSpaces: function (line_id) {
      this.performAction("actCountSpaces", { line_id });
    },

    ///////////////////////////////////////////////////
    //// Reaction to cometD notifications

    setupNotifications: function () {
      console.log("notifications subscriptions setup");
      this.bgaSetupPromiseNotifications();
    },

    notif_countSpaces: function (args) {
      const { line_id, lineType, spaceCount } = args;
      document.getElementById(`dgt_${lineType}Marker-${line_id}`).textContent =
        spaceCount;
    },
  });
});
