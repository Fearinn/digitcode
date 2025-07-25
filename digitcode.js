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
  `${g_gamethemeurl}modules/js/bga-zoom.js`,
  `${g_gamethemeurl}modules/js/bga-help.js`,
], function (dojo, declare) {
  return declare("bgagame.digitcode", ebg.core.gamegui, {
    constructor: function () {
      console.log("digitcode constructor");
    },

    setup: function (gamedatas) {
      this.dgt = {
        managers: {},
        counters: {},
      };

      this.dgt.managers.zoom = new ZoomManager({
        element: document.getElementById("dgt_gameArea"),
        localStorageZoomKey: "dgt-zoom",
        zoomControls: {
          color: "black",
        },
        zoomLevels: [
          0.25, 0.375, 0.5, 0.625, 0.75, 0.875, 1, 1.125, 1.25, 1.375, 1.5,
        ],
        smooth: true,
      });

      this.dgt.managers.help = new HelpManager(this, {
        buttons: [
          new BgaHelpExpandableButton({
            title: _("Player aid"),
            foldedHtml: `<span class="dgt_helpFolded">?</span>`,
            unfoldedHtml: `<div class="dgt_playerAid"></div>`,
            expandedHeight: "500px",
          }),
        ],
      });

      for (const player_id in gamedatas.players) {
        const playerPanel = this.getPlayerPanelElement(player_id);
        const playerChances = gamedatas.players[player_id].chances;

        playerPanel.insertAdjacentHTML(
          "beforeend",
          `<div class="dgt_playerChancesContainer">
            <span id="dgt_playerChances-${player_id}" class="dgt_playerChances">${playerChances}</span>
            <i id="dgt_playerChances-icon-${player_id}" class="dgt_playerChances-icon fa fa-heart"></i>
          </div>`
        );

        this.addTooltip(
          `dgt_playerChances-icon-${player_id}`,
          _("Remaining chances"),
          ""
        );

        this.dgt.counters[player_id] = { chances: new ebg.counter() };
        const counter = this.dgt.counters[player_id].chances;
        counter.create(`dgt_playerChances-${player_id}`);
        counter.setValue(playerChances);
      }

      for (const element_id in gamedatas.draftValues) {
        const element = document.getElementById(element_id);

        if (element) {
          const value = gamedatas.draftValues[element_id];
          element.dataset.draftvalue = value;

          if (element.dataset.linemarker) {
            element.textContent = value;
          }
        }
      }

      gamedatas.draft?.forEach((draftElement_id) => {
        const draftElement = document.getElementById(draftElement_id);

        if (draftElement) {
          draftElement.classList.add("dgt_draft");
          draftElement.dataset.draft = "true";
        }
      });

      document.querySelectorAll("[data-space]").forEach((spaceElement) => {
        spaceElement.addEventListener("click", () => {
          if (this.getStateName().includes("client_")) {
            return;
          }

          const draftValues = ["", "filled", "empty"];

          const draftValue = spaceElement.dataset.draftvalue;
          let index = draftValue ? draftValues.indexOf(draftValue) + 1 : 1;

          const draftClass = "dgt_draft";
          spaceElement.classList.add(draftClass);

          spaceElement.dataset.draftvalue = draftValues[index];

          if (index > 2) {
            index = 0;
            spaceElement.classList.remove(draftClass);
            spaceElement.removeAttribute("data-draftvalue");
          }

          spaceElement.dataset.draft =
            spaceElement.classList.contains(draftClass);
        });
      });

      document
        .querySelectorAll("[data-comparisonIcon]")
        .forEach((comparisonIcon) => {
          comparisonIcon.addEventListener("click", () => {
            if (this.getStateName().includes("client_")) {
              return;
            }

            const draftClass = "dgt_draft";
            comparisonIcon.classList.toggle(draftClass);
            comparisonIcon.dataset.draft =
              comparisonIcon.classList.contains(draftClass);

            siblingIcon =
              comparisonIcon.nextElementSibling ||
              comparisonIcon.previousElementSibling;

            if (comparisonIcon.classList.contains(draftClass)) {
              siblingIcon.classList.remove(draftClass);
              siblingIcon.dataset.draft = "false";
            }
          });
        });
      document
        .querySelectorAll("[data-parityMarker]")
        .forEach((parityMarker) => {
          parityMarker.addEventListener("click", () => {
            if (this.getStateName().includes("client_")) {
              return;
            }

            const draftClass = "dgt_draft";
            parityMarker.classList.toggle(draftClass);
            parityMarker.dataset.draft =
              parityMarker.classList.contains(draftClass);

            const siblingMarker =
              parityMarker.nextElementSibling ||
              parityMarker.previousElementSibling;

            if (parityMarker.classList.contains(draftClass)) {
              siblingMarker.classList.remove(draftClass);
              siblingMarker.dataset.draft = "false";
            }
          });
        });

      document.querySelectorAll("[data-lineMarker]").forEach((lineMarker) => {
        lineMarker.addEventListener("click", () => {
          if (
            this.getStateName().includes("client_") ||
            lineMarker.classList.contains("dgt_lineMarker-confirmed")
          ) {
            return;
          }

          let spaceCount = lineMarker.textContent
            ? Number(lineMarker.textContent) + 1
            : 0;

          lineType = lineMarker.dataset.linetype;
          let max = lineType === "row" ? 3 : 4;

          if (
            ["B", "E", "H", "K", "M", "P", "R"].includes(
              lineMarker.dataset.linemarker
            )
          ) {
            max = 6;
          }

          const draftClass = "dgt_draft";
          lineMarker.classList.add(draftClass);
          lineMarker.dataset.draft = lineMarker.classList.contains(draftClass);
          lineMarker.dataset.draftvalue = spaceCount;
          lineMarker.textContent = spaceCount;

          if (spaceCount > max) {
            lineMarker.textContent = "";
            lineMarker.dataset.draft = false;
            lineMarker.classList.remove(draftClass);
            lineMarker.dataset.draftValue = null;
          }
        });
      });

      document
        .querySelectorAll("[data-optionMarker]")
        .forEach((optionMarker) => {
          optionMarker.addEventListener("click", () => {
            if (this.getStateName().includes("client_")) {
              return;
            }

            const draftClass = "dgt_draft";
            optionMarker.classList.toggle(draftClass);
            optionMarker.dataset.draft =
              optionMarker.classList.contains(draftClass);
          });
        });

      for (const line_id in gamedatas.countedLines) {
        const spaceCount = gamedatas.countedLines[line_id];
        const lineMarker = document.querySelector(
          `[data-lineMarker=${line_id}`
        );
        lineMarker.classList.add("dgt_lineMarker-confirmed");
        lineMarker.textContent = spaceCount;
      }

      for (const digit_id in gamedatas.checkedParities) {
        const parity = gamedatas.checkedParities[digit_id];
        const parityMarker = document.getElementById(
          `dgt_parityMarker-${parity}-${digit_id}`
        );
        parityMarker.classList.add("dgt_parityMarker-confirmed");
        this.addTooltip(parityMarker.id, _(parity), "");
      }

      for (const space_id in gamedatas.checkedSpaces) {
        const spaceFilled = gamedatas.checkedSpaces[space_id];

        const filledOrEmpty = spaceFilled ? "filled" : "empty";
        const spaceElement = document.getElementById(`dgt_space-${space_id}`);
        spaceElement.classList.add("dgt_space-confirmed");
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

      if (!this.isSpectator) {
        this.statusBar.addActionButton(
          `<i class="fa fa-solid fa-floppy-o"></i>`,
          () => {
            const draftValues = {};
            const draftElements = [];
            document
              .querySelectorAll("[data-draft]")
              .forEach((draftElement) => {
                if (draftElement.dataset.draft !== "true") {
                  return;
                }

                draftElements.push(draftElement.id);

                if (draftElement.dataset.draftvalue) {
                  draftValues[draftElement.id] =
                    draftElement.dataset.draftvalue;
                }
              });

            if (
              draftElements.length === 0 &&
              Object.keys(draftValues).length === 0
            ) {
              this.showMessage(_("You may not save an empty draft"), "error");
              return;
            }

            this.actSaveDraft(draftElements, draftValues);
          },
          {
            title: _("Save draft"),
            color: "secondary",
            classes: ["dgt_draftBtn-save", "dgt_draftBtn"],
            destination: document.getElementById("dgt_solutionSheet"),
          }
        );

        this.statusBar.addActionButton(
          `<i class="fa fa-solid fa-trash"></i>`,
          () => {
            this.confirmationDialog(
              _("Do you really want to delete your draft?"),
              () => {
                this.deleteDraft();
                this.actDeleteDraft();
              }
            );
          },
          {
            title: _("Delete draft"),
            color: "alert",
            classes: ["dgt_draftBtn-delete", "dgt_draftBtn"],
            destination: document.getElementById("dgt_solutionSheet"),
          }
        );
      }

      this.revealCode(gamedatas.codeSpaces);

      this.setupNotifications();

      console.log("Ending game setup");
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
          _("cancel"),
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
          checkableParities,
          checkableSpaces,
          comparableDigits,
        } = args.args;

        if (countableLines.length > 0) {
          this.statusBar.addActionButton(
            _("count spaces of row/column"),
            () => {
              this.setClientState("client_countSpaces", {
                descriptionmyturn: _(
                  "${you} must pick the column or row to count the spaces from"
                ),
                client_args: {
                  countableLines,
                },
              });
            }
          );
        }

        if (checkableParities.length > 0) {
          this.statusBar.addActionButton(_("(number) even or odd?"), () => {
            this.setClientState("client_checkParity", {
              descriptionmyturn: _(
                "${you} must pick a number to check its parity"
              ),
              client_args: {
                checkableParities,
              },
            });
          });
        }

        if (checkableSpaces.length > 0) {
          this.statusBar.addActionButton(_("(space) empty or filled?"), () => {
            this.setClientState("client_checkSpace", {
              descriptionmyturn: _(
                "${you} must pick a space to check if it's filled"
              ),
              client_args: {
                checkableSpaces,
              },
            });
          });
        }

        if (comparableDigits.length > 0) {
          this.statusBar.addActionButton(_("compare numbers"), () => {
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

        this.statusBar.addActionButton(
          _("submit solution"),
          () => {
            this.setClientState("client_submitSolution", {
              descriptionmyturn: _("${you} must submit a 6-digit solution"),
            });

            this.statusBar.addActionButton(
              _("confirm"),
              () => {
                let solution = "";
                document
                  .querySelectorAll("[data-input]")
                  .forEach((inputElement) => {
                    const algarism = inputElement.value;
                    solution = `${solution}${algarism}`;
                  });

                if (solution.length !== 6) {
                  this.showMessage(
                    _("You must submit a valid solution"),
                    "error"
                  );
                  return;
                }

                this.actSubmitSolution(solution);
              },
              {
                id: "dgt_confirmSolutionBtn",
                destination: document.getElementById("dgt_formElement"),
              }
            );
          },
          {
            classes: ["dgt_submitSolutionBtn"],
          }
        );
      }

      if (stateName === "client_countSpaces") {
        const { countableLines } = args.client_args;
        this.setSelectableLabels(countableLines, (label_id) => {
          this.actCountSpaces(label_id);
        });
      }

      if (stateName === "client_checkParity") {
        const { checkableParities } = args.client_args;
        this.setSelectableLabels(checkableParities, (label_id) => {
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

      if (stateName === "client_submitSolution") {
        this.buildSolutionForm();
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

      if (stateName === "client_submitSolution") {
        document.getElementById("dgt_solutionForm").innerHTML = "";
      }
    },

    onUpdateActionButtons: function (stateName, args) {},

    ///////////////////////////////////////////////////
    //// Utility methods

    getStateName: function () {
      return this.gamedatas.gamestate.name;
    },

    toggleConfirmationBtn: function (
      add = false,
      callback = () => {},
      selection = _("selection")
    ) {
      document.getElementById("dgt_confirmationBtn")?.remove();

      if (!add) {
        return;
      }

      this.statusBar.addActionButton(
        this.format_string_recursive(_("confirm ${selection}"), {
          selection,
        }),
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

            this.toggleConfirmationBtn(
              isSelected,
              () => {
                callback(label_id);
              },
              label_id
            );

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

            this.toggleConfirmationBtn(
              isSelected,
              () => {
                this.actCheckSpace(space_id);
              },
              space_id
            );

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

            this.toggleConfirmationBtn(
              isSelected,
              () => {
                this.actCompareDigits(comparison_id);
              },
              `${comparison_id.slice(0, 1)} &gt; &lt; ${comparison_id.slice(
                -1
              )}`
            );

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

    deleteDraft: function (
      target = document.getElementById("dgt_solutionSheet")
    ) {
      target.querySelectorAll("[data-draft]").forEach((draftElement) => {
        if (draftElement.dataset.draft !== "true") {
          return;
        }

        draftElement.classList.remove("dgt_draft");
        draftElement.dataset.draft = "false";

        if (draftElement.dataset.draftvalue) {
          draftElement.removeAttribute("data-draftvalue");
          draftElement.textContent = "";
        }
      });
    },

    revealCode: function (codeSpaces) {
      if (!codeSpaces) {
        return;
      }

      const solutionSheet = document.getElementById(`dgt_solutionSheet`);
      solutionSheet.querySelectorAll("button").forEach((buttonElement) => {
        buttonElement.remove();
      });

      const codeElement = solutionSheet.cloneNode(true);

      document
        .getElementById("dgt_sheetsContainer")
        .insertAdjacentElement("afterbegin", codeElement);

      solutionSheet.removeAttribute("id");
      solutionSheet.querySelectorAll("[id]").forEach((childElement) => {
        childElement.removeAttribute("id");
      });

      this.deleteDraft(codeElement);

      codeSpaces.forEach((space_id) => {
        const spaceElement = document.getElementById(`dgt_space-${space_id}`);
        spaceElement.classList.add("dgt_space-confirmed");

        spaceElement.classList.add("dgt_space-confirmed-revealed");
      });
    },

    buildSolutionForm: function () {
      const formElement = document.getElementById("dgt_solutionForm");

      formElement.onsubmit = (event) => {
        event.preventDefault();
      };

      ["T", "U", "V", "W", "X", "Y"].forEach((digit_id) => {
        formElement.insertAdjacentHTML(
          "beforeend",
          `<input aria-label="${digit_id}" id="dgt_input-${digit_id}" class="dgt_input" data-input="${digit_id}" 
          inputmode="numeric" type="number" min="0" max="9" placeholder="${digit_id}"></input>`
        );
      });

      const digits = ["T", "U", "V", "W", "X", "Y"];
      digits.forEach((digit_id, index) => {
        const inputElement = document.getElementById(`dgt_input-${digit_id}`);

        inputElement.onkeydown = (event) => {
          if (
            ["-", "+", "-", ".", "e", ","].includes(event.key) ||
            event.key.match(/a-Z/g)
          ) {
            event.preventDefault();
            return;
          }

          if (event.key === "Backspace") {
            event.preventDefault();
            inputElement.value = "";

            const previousIndex = index === digits.length ? 0 : index - 1;
            const previousDigit_id = digits[previousIndex];
            document.getElementById(`dgt_input-${previousDigit_id}`)?.focus();
            return;
          }

          if (
            ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"].includes(
              event.key
            )
          ) {
            event.preventDefault();

            const nextIndex = index === digits.length ? 0 : index + 1;
            const nextDigit_id = digits[nextIndex];

            const nextInputElement = document.getElementById(
              `dgt_input-${nextDigit_id}`
            );

            nextInputElement?.focus();

            if (inputElement.value.length === 0) {
              inputElement.value = event.key;
            } else if (nextInputElement) {
              nextInputElement.value = event.key;
            }
          }
        };
      });

      document.getElementById("dgt_input-T").focus();
    },

    ///////////////////////////////////////////////////
    //// Player's actions

    performAction: function (action, args = {}, config = {}) {
      args.CLIENT_VERSION = this.gamedatas.GAME_VERSION;
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

    actSaveDraft: function (draft, draftValues) {
      this.performAction(
        "actSaveDraft",
        {
          draft: JSON.stringify(draft),
          draftValues: JSON.stringify(draftValues),
        },
        {
          checkAction: false,
        }
      );
    },

    actDeleteDraft: function () {
      this.performAction("actDeleteDraft", {}, { checkAction: false });
    },

    actSubmitSolution: function (solution) {
      this.performAction("actSubmitSolution", { solution });
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
      lineMarker.classList.add("dgt_lineMarker-confirmed");
      lineMarker.textContent = spaceCount;
    },

    notif_checkParity: function (args) {
      const { parity, digit_id } = args;

      const parityMarker = document.getElementById(
        `dgt_parityMarker-${parity}-${digit_id}`
      );
      parityMarker.classList.add("dgt_parityMarker-confirmed");

      this.addTooltip(parityMarker.id, _(parity), "");
    },

    notif_checkSpace: function (args) {
      const { space_id, spaceFilled } = args;

      const filledOrEmpty = spaceFilled ? "filled" : "empty";

      const spaceElement = document.getElementById(`dgt_space-${space_id}`);
      spaceElement.classList.add("dgt_space-confirmed");
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

    notif_deleteDraft: function (args) {
      const messageType =
        this.bgaAnimationsActive() &&
        typeof g_replayFrom === "undefined" &&
        g_archive_mode === false
          ? "info"
          : "only_to_log";

      this.showMessage(_("Draft cleared"), messageType);
    },

    notif_saveDraft: function (args) {
      const messageType =
        this.bgaAnimationsActive() &&
        typeof g_replayFrom === "undefined" &&
        g_archive_mode === false
          ? "info"
          : "only_to_log";

      this.showMessage(_("Draft saved"), messageType);
    },

    notif_incorrectSolution: function (args) {
      const player_id = args.player_id;
      this.dgt.counters[player_id].chances.incValue(-1);
    },

    notif_revealCode: function (args) {
      const { codeSpaces } = args;
      this.revealCode(codeSpaces);
    },

    // FORMAT LOGS

    format_string_recursive(log, args) {
      try {
        if (log && args && !args.processed) {
          args.processed = true;

          for (arg_key in args) {
            if (arg_key.includes("_label")) {
              const arg = args["i18n"]?.includes(arg_key)
                ? _(args[arg_key])
                : args[arg_key];

              args[arg_key] = `<span class="dgt_logHighlight">${arg}</span>`;
            }
          }
        }
      } catch (e) {
        console.error(log, args, "Exception thrown", e.stack);
      }

      return this.inherited(arguments);
    },
  });
});
