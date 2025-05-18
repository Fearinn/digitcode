{OVERALL_GAME_HEADER}

<!-- 
--------
-- BGA framework: Gregory Isabelli & Emmanuel Colin & BoardGameArena
-- Propuh implementation : © Matheus Gomes matheusgomesforwork@gmail.com
-- 
-- This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
-- See http://en.boardgamearena.com/#!doc/Studio for more information.
-------
-->

<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
  href="https://fonts.googleapis.com/css2?family=Alata&display=swap"
  rel="stylesheet"
/>
<div id="dgt_gameArea" class="dgt_gameArea">
  <form id="dgt_solutionForm" class="dgt_solutionForm"></form>
  <div id="dgt_solutionSheet" class="dgt_solutionSheet whiteblock">
    <div class="dgt_comparisonMarkers-top dgt_comparisonMarkers">
      <div
        id="dgt_comparisonMarker-TU"
        class="dgt_comparisonMarker"
        data-comparison="TU"
      >
        <i
          id="dgt_comparisonIcon-T_U"
          class="dgt_comparisonIcon fa6 fa6-solid fa6-greater-than"
          data-comparisonIcon="T>U"
          ,
        ></i>
        <i
          id="dgt_comparisonIcon-U_T"
          class="dgt_comparisonIcon fa6 fa6-solid fa6-less-than"
          data-comparisonIcon="U>T"
        ></i>
      </div>
      <div
        id="dgt_comparisonMarker-UV"
        class="dgt_comparisonMarker"
        data-comparison="UV"
      >
        <i
          id="dgt_comparisonIcon-U_V"
          class="dgt_comparisonIcon fa6 fa6-solid fa6-greater-than"
          data-comparisonIcon="U>V"
        ></i>
        <i
          id="dgt_comparisonIcon-V_U"
          class="dgt_comparisonIcon fa6 fa6-solid fa6-less-than"
          data-comparisonIcon="V>U"
        ></i>
      </div>
    </div>
    <div class="dgt_comparisonMarkers-middle dgt_comparisonMarkers">
      <div
        id="dgt_comparisonMarker-TW"
        class="dgt_comparisonMarker"
        data-comparison="TW"
      >
        <i
          id="dgt_comparisonIcon-T_W"
          class="dgt_comparisonIcon fa6 fa6-solid fa6-greater-than"
          data-comparisonIcon="T>W"
        ></i>
        <i
          id="dgt_comparisonIcon-W_T"
          class="dgt_comparisonIcon fa6 fa6-solid fa6-less-than"
          data-comparisonIcon="W>T"
        ></i>
      </div>
      <div
        id="dgt_comparisonMarker-UX"
        class="dgt_comparisonMarker"
        data-comparison="UX"
      >
        <i
          id="dgt_comparisonIcon-U_X"
          class="dgt_comparisonIcon fa6 fa6-solid fa6-greater-than"
          data-comparisonIcon="U>X"
        ></i>
        <i
          id="dgt_comparisonIcon-X_U"
          class="dgt_comparisonIcon fa6 fa6-solid fa6-less-than"
          data-comparisonIcon="X>U"
        ></i>
      </div>
      <div
        id="dgt_comparisonMarker-VY"
        class="dgt_comparisonMarker"
        data-comparison="VY"
      >
        <i
          id="dgt_comparisonIcon-V_Y"
          class="dgt_comparisonIcon fa6 fa6-solid fa6-greater-than"
          data-comparisonIcon="V>Y"
        ></i>
        <i
          id="dgt_comparisonIcon-Y_V"
          class="dgt_comparisonIcon fa6 fa6-solid fa6-less-than"
          data-comparisonIcon="Y>V"
        ></i>
      </div>
    </div>
    <div class="dgt_comparisonMarkers-bottom dgt_comparisonMarkers">
      <div
        id="dgt_comparisonMarker-WX"
        class="dgt_comparisonMarker"
        data-comparison="WX"
      >
        <i
          id="dgt_comparisonIcon-W_X"
          class="dgt_comparisonIcon fa6 fa6-solid fa6-greater-than"
          data-comparisonIcon="W>X"
        ></i>
        <i
          id="dgt_comparisonIcon-X_W"
          class="dgt_comparisonIcon fa6 fa6-solid fa6-less-than"
          data-comparisonIcon="X>W"
        ></i>
      </div>
      <div
        id="dgt_comparisonMarker-XY"
        class="dgt_comparisonMarker"
        data-comparison="XY"
      >
        <i
          id="dgt_comparisonIcon-X_Y"
          class="dgt_comparisonIcon fa6 fa6-solid fa6-greater-than"
          data-comparisonIcon="X>Y"
        ></i>
        <i
          id="dgt_comparisonIcon-Y_X"
          class="dgt_comparisonIcon fa6 fa6-solid fa6-less-than"
          data-comparisonIcon="Y>X"
        ></i>
      </div>
    </div>
    <div class="dgt_columnLabels">
      <div class="dgt_columnGroup">
        <div id="dgt_label-A" class="dgt_columnLabel dgt_label" data-label="A">
          A
        </div>
        <div id="dgt_label-B" class="dgt_columnLabel dgt_label" data-label="B">
          B
        </div>
        <div id="dgt_label-C" class="dgt_columnLabel dgt_label" data-label="C">
          C
        </div>
      </div>
      <div class="dgt_columnGroup">
        <div id="dgt_label-D" class="dgt_columnLabel dgt_label" data-label="D">
          D
        </div>
        <div id="dgt_label-E" class="dgt_columnLabel dgt_label" data-label="E">
          E
        </div>
        <div id="dgt_label-F" class="dgt_columnLabel dgt_label" data-label="F">
          F
        </div>
      </div>
      <div class="dgt_columnGroup">
        <div id="dgt_label-G" class="dgt_columnLabel dgt_label" data-label="G">
          G
        </div>
        <div id="dgt_label-H" class="dgt_columnLabel dgt_label" data-label="H">
          H
        </div>
        <div id="dgt_label-I" class="dgt_columnLabel dgt_label" data-label="I">
          I
        </div>
      </div>
    </div>
    <div class="dgt_sequences">
      <div id="dgt_sequence-1" class="dgt_sequence">
        <div id="dgt_sequence-1-rowLabels" class="dgt_rowLabels">
          <div id="dgt_label-J" class="dgt_rowLabel dgt_label" data-label="J">
            J
          </div>
          <div id="dgt_label-K" class="dgt_rowLabel dgt_label" data-label="K">
            K
          </div>
          <div id="dgt_label-L" class="dgt_rowLabel dgt_label" data-label="L">
            L
          </div>
          <div id="dgt_label-M" class="dgt_rowLabel dgt_label" data-label="M">
            M
          </div>
          <div id="dgt_label-N" class="dgt_rowLabel dgt_label" data-label="N">
            N
          </div>
        </div>
        <div class="dgt_digits">
          <div id="dgt_digit-T" class="dgt_digit">
            <div
              id="dgt_digitLabel-T"
              class="dgt_digitLabel dgt_label"
              data-label="T"
            >
              T
            </div>
            <div class="dgt_parityMarkers">
              <div
                id="dgt_parityMarker-even-T"
                class="dgt_parityMarker-even dgt_parityMarker"
                data-parityMarker="T"
                data-parity="even"
              >
                <i class="fa fa-circle" aria-hidden="true"></i>
                <i class="fa fa-circle" aria-hidden="true"></i>
              </div>
              <div
                id="dgt_parityMarker-odd-T"
                class="dgt_parityMarker-odd dgt_parityMarker"
                data-parity="odd"
                data-parityMarker="T"
              >
                <i class="fa fa-circle" aria-hidden="true"></i>
              </div>
            </div>
            <div class="dgt_spaces">
              <div id="dgt_column-TA" class="dgt_column-left dgt_column">
                <div class="dgt_spaceContainer">
                  <div
                    id="dgt_space-TAK"
                    class="dgt_space"
                    data-space="TAK"
                  ></div>
                </div>
                <div class="dgt_spaceContainer">
                  <div
                    id="dgt_space-TAM"
                    class="dgt_space"
                    data-space="TAM"
                  ></div>
                </div>
              </div>
              <div id="dgt_column-TB" class="dgt_column-middle dgt_column">
                <div class="dgt_spaceContainer-middle dgt_spaceContainer">
                  <div
                    id="dgt_space-TBJ"
                    class="dgt_space-middle dgt_space"
                    data-space="TBJ"
                  ></div>
                </div>
                <div class="dgt_spaceContainer-middle dgt_spaceContainer">
                  <div
                    id="dgt_space-TBL"
                    class="dgt_space-middle dgt_space"
                    data-space="TBL"
                  ></div>
                </div>
                <div class="dgt_spaceContainer-middle dgt_spaceContainer">
                  <div
                    id="dgt_space-TBN"
                    class="dgt_space-middle dgt_space"
                    data-space="TBN"
                  ></div>
                </div>
              </div>
              <div id="dgt_column-TC" class="dgt_column-right dgt_column">
                <div class="dgt_spaceContainer">
                  <div
                    id="dgt_space-TCK"
                    class="dgt_space"
                    data-space="TCK"
                  ></div>
                </div>
                <div class="dgt_spaceContainer">
                  <div
                    id="dgt_space-TCM"
                    class="dgt_space"
                    data-space="TCM"
                  ></div>
                </div>
              </div>
            </div>
            <div class="dgt_optionMarkers">
              <div
                id="dgt_optionMarker-T0"
                class="dgt_optionMarker"
                data-optionMarker="0"
              >
                0
              </div>
              <div
                id="dgt_optionMarker-T1"
                class="dgt_optionMarker"
                data-optionMarker="1"
              >
                1
              </div>
              <div
                id="dgt_optionMarker-T2"
                class="dgt_optionMarker"
                data-optionMarker="2"
              >
                2
              </div>
              <div
                id="dgt_optionMarker-T3"
                class="dgt_optionMarker"
                data-optionMarker="3"
              >
                3
              </div>
              <div
                id="dgt_optionMarker-T4"
                class="dgt_optionMarker"
                data-optionMarker="4"
              >
                4
              </div>
              <div
                id="dgt_optionMarker-T5"
                class="dgt_optionMarker"
                data-optionMarker="5"
              >
                5
              </div>
              <div
                id="dgt_optionMarker-T6"
                class="dgt_optionMarker"
                data-optionMarker="6"
              >
                6
              </div>
              <div
                id="dgt_optionMarker-T7"
                class="dgt_optionMarker"
                data-optionMarker="7"
              >
                7
              </div>
              <div
                id="dgt_optionMarker-T8"
                class="dgt_optionMarker"
                data-optionMarker="8"
              >
                8
              </div>
              <div
                id="dgt_optionMarker-T9"
                class="dgt_optionMarker"
                data-optionMarker="9"
              >
                9
              </div>
            </div>
          </div>
          <div id="dgt_digit-U" class="dgt_digit">
            <div
              id="dgt_digitLabel-U"
              class="dgt_digitLabel dgt_label"
              data-label="U"
            >
              U
            </div>
            <div class="dgt_parityMarkers">
              <div
                id="dgt_parityMarker-even-U"
                class="dgt_parityMarker-even dgt_parityMarker"
                data-parityMarker="U"
                data-parity="even"
              >
                <i class="fa fa-circle" aria-hidden="true"></i>
                <i class="fa fa-circle" aria-hidden="true"></i>
              </div>
              <div
                id="dgt_parityMarker-odd-U"
                class="dgt_parityMarker-odd dgt_parityMarker"
                data-parity="odd"
                data-parityMarker="U"
              >
                <i
                  class="fa fa-circle"
                  aria-hidden="true"
                  aria-hidden="true"
                ></i>
              </div>
            </div>
            <div class="dgt_spaces">
              <div id="dgt_column-UD" class="dgt_column-left dgt_column">
                <div class="dgt_spaceContainer">
                  <div
                    id="dgt_space-UDK"
                    class="dgt_space"
                    data-space="UDK"
                  ></div>
                </div>
                <div class="dgt_spaceContainer">
                  <div
                    id="dgt_space-UDM"
                    class="dgt_space"
                    data-space="UDM"
                  ></div>
                </div>
              </div>
              <div id="dgt_column-UE" class="dgt_column-middle dgt_column">
                <div class="dgt_spaceContainer-middle dgt_spaceContainer">
                  <div
                    id="dgt_space-UEJ"
                    class="dgt_space-middle dgt_space"
                    data-space="UEJ"
                  ></div>
                </div>
                <div class="dgt_spaceContainer-middle dgt_spaceContainer">
                  <div
                    id="dgt_space-UEL"
                    class="dgt_space-middle dgt_space"
                    data-space="UEL"
                  ></div>
                </div>
                <div class="dgt_spaceContainer-middle dgt_spaceContainer">
                  <div
                    id="dgt_space-UEN"
                    class="dgt_space-middle dgt_space"
                    data-space="UEN"
                  ></div>
                </div>
              </div>
              <div id="dgt_column-UF" class="dgt_column-right dgt_column">
                <div class="dgt_spaceContainer">
                  <div
                    id="dgt_space-UFK"
                    class="dgt_space"
                    data-space="UFK"
                  ></div>
                </div>
                <div class="dgt_spaceContainer">
                  <div
                    id="dgt_space-UFM"
                    class="dgt_space"
                    data-space="UFM"
                  ></div>
                </div>
              </div>
            </div>
            <div class="dgt_optionMarkers">
              <div
                id="dgt_optionMarker-U0"
                class="dgt_optionMarker"
                data-optionMarker="0"
              >
                0
              </div>
              <div
                id="dgt_optionMarker-U1"
                class="dgt_optionMarker"
                data-optionMarker="1"
              >
                1
              </div>
              <div
                id="dgt_optionMarker-U2"
                class="dgt_optionMarker"
                data-optionMarker="2"
              >
                2
              </div>
              <div
                id="dgt_optionMarker-U3"
                class="dgt_optionMarker"
                data-optionMarker="3"
              >
                3
              </div>
              <div
                id="dgt_optionMarker-U4"
                class="dgt_optionMarker"
                data-optionMarker="4"
              >
                4
              </div>
              <div
                id="dgt_optionMarker-U5"
                class="dgt_optionMarker"
                data-optionMarker="5"
              >
                5
              </div>
              <div
                id="dgt_optionMarker-U6"
                class="dgt_optionMarker"
                data-optionMarker="6"
              >
                6
              </div>
              <div
                id="dgt_optionMarker-U7"
                class="dgt_optionMarker"
                data-optionMarker="7"
              >
                7
              </div>
              <div
                id="dgt_optionMarker-U8"
                class="dgt_optionMarker"
                data-optionMarker="8"
              >
                8
              </div>
              <div
                id="dgt_optionMarker-U9"
                class="dgt_optionMarker"
                data-optionMarker="9"
              >
                9
              </div>
            </div>
          </div>
          <div id="dgt_digit-V" class="dgt_digit">
            <div
              id="dgt_digitLabel-V"
              class="dgt_digitLabel dgt_label"
              data-label="V"
            >
              V
            </div>
            <div class="dgt_parityMarkers">
              <div
                id="dgt_parityMarker-even-V"
                class="dgt_parityMarker-even dgt_parityMarker"
                data-parityMarker="V"
                data-parity="even"
              >
                <i class="fa fa-circle" aria-hidden="true"></i>
                <i class="fa fa-circle" aria-hidden="true"></i>
              </div>
              <div
                id="dgt_parityMarker-odd-V"
                class="dgt_parityMarker-odd dgt_parityMarker"
                data-parity="odd"
                data-parityMarker="V"
              >
                <i
                  class="fa fa-circle"
                  aria-hidden="true"
                  aria-hidden="true"
                ></i>
              </div>
            </div>
            <div class="dgt_spaces">
              <div id="dgt_column-VG" class="dgt_column-left dgt_column">
                <div class="dgt_spaceContainer">
                  <div
                    id="dgt_space-VGK"
                    class="dgt_space"
                    data-space="VGK"
                  ></div>
                </div>
                <div class="dgt_spaceContainer">
                  <div
                    id="dgt_space-VGM"
                    class="dgt_space"
                    data-space="VGM"
                  ></div>
                </div>
              </div>
              <div id="dgt_column-VH" class="dgt_column-middle dgt_column">
                <div class="dgt_spaceContainer-middle dgt_spaceContainer">
                  <div
                    id="dgt_space-VHJ"
                    class="dgt_space-middle dgt_space"
                    data-space="VHJ"
                  ></div>
                </div>
                <div class="dgt_spaceContainer-middle dgt_spaceContainer">
                  <div
                    id="dgt_space-VHL"
                    class="dgt_space-middle dgt_space"
                    data-space="VHL"
                  ></div>
                </div>
                <div class="dgt_spaceContainer-middle dgt_spaceContainer">
                  <div
                    id="dgt_space-VHN"
                    class="dgt_space-middle dgt_space"
                    data-space="VHN"
                  ></div>
                </div>
              </div>
              <div id="dgt_column-VI" class="dgt_column-right dgt_column">
                <div class="dgt_spaceContainer">
                  <div
                    id="dgt_space-VIK"
                    class="dgt_space"
                    data-space="VIK"
                  ></div>
                </div>
                <div class="dgt_spaceContainer">
                  <div
                    id="dgt_space-VIM"
                    class="dgt_space"
                    data-space="VIM"
                  ></div>
                </div>
              </div>
            </div>
            <div class="dgt_optionMarkers">
              <div
                id="dgt_optionMarker-V0"
                class="dgt_optionMarker"
                data-optionMarker="0"
              >
                0
              </div>
              <div
                id="dgt_optionMarker-V1"
                class="dgt_optionMarker"
                data-optionMarker="1"
              >
                1
              </div>
              <div
                id="dgt_optionMarker-V2"
                class="dgt_optionMarker"
                data-optionMarker="2"
              >
                2
              </div>
              <div
                id="dgt_optionMarker-V3"
                class="dgt_optionMarker"
                data-optionMarker="3"
              >
                3
              </div>
              <div
                id="dgt_optionMarker-V4"
                class="dgt_optionMarker"
                data-optionMarker="4"
              >
                4
              </div>
              <div
                id="dgt_optionMarker-V5"
                class="dgt_optionMarker"
                data-optionMarker="5"
              >
                5
              </div>
              <div
                id="dgt_optionMarker-V6"
                class="dgt_optionMarker"
                data-optionMarker="6"
              >
                6
              </div>
              <div
                id="dgt_optionMarker-V7"
                class="dgt_optionMarker"
                data-optionMarker="7"
              >
                7
              </div>
              <div
                id="dgt_optionMarker-V8"
                class="dgt_optionMarker"
                data-optionMarker="8"
              >
                8
              </div>
              <div
                id="dgt_optionMarker-V9"
                class="dgt_optionMarker"
                data-optionMarker="9"
              >
                9
              </div>
            </div>
          </div>
        </div>
        <div class="dgt_rowMarkers dgt_rowLabels">
          <div
            id="dgt_rowMarker-J"
            class="dgt_rowMarker dgt_rowLabel dgt_lineMarker dgt_label"
            data-lineMarker="J"
            data-lineType="row"
          ></div>
          <div
            id="dgt_rowMarker-K"
            class="dgt_rowMarker dgt_rowLabel dgt_lineMarker dgt_label"
            data-lineMarker="K"
            data-lineType="row"
          ></div>
          <div
            id="dgt_rowMarker-L"
            class="dgt_rowMarker dgt_rowLabel dgt_lineMarker dgt_label"
            data-lineMarker="L"
            data-lineType="row"
          ></div>
          <div
            id="dgt_rowMarker-M"
            class="dgt_rowMarker dgt_rowLabel dgt_lineMarker dgt_label"
            data-lineMarker="M"
            data-lineType="row"
          ></div>
          <div
            id="dgt_rowMarker-N"
            class="dgt_rowMarker dgt_rowLabel dgt_lineMarker dgt_label"
            data-lineMarker="N"
            data-lineType="row"
          ></div>
        </div>
      </div>
      <div id="dgt_sequence-2" class="dgt_sequence">
        <div class="dgt_rowLabels">
          <div
            id="dgt_rowLabel-O"
            class="dgt_rowLabel dgt_label"
            data-label="O"
          >
            O
          </div>
          <div
            id="dgt_rowLabel-P"
            class="dgt_rowLabel dgt_label"
            data-label="P"
          >
            P
          </div>
          <div
            id="dgt_rowLabel-Q"
            class="dgt_rowLabel dgt_label"
            data-label="Q"
          >
            Q
          </div>
          <div
            id="dgt_rowLabel-R"
            class="dgt_rowLabel dgt_label"
            data-label="R"
          >
            R
          </div>
          <div
            id="dgt_rowLabel-S"
            class="dgt_rowLabel dgt_label"
            data-label="S"
          >
            S
          </div>
        </div>
        <div class="dgt_digits">
          <div id="dgt_digit-W" class="dgt_digit">
            <div
              id="dgt_digitLabel-W"
              class="dgt_digitLabel dgt_label"
              data-label="W"
            >
              W
            </div>
            <div class="dgt_parityMarkers">
              <div
                id="dgt_parityMarker-even-W"
                class="dgt_parityMarker-even dgt_parityMarker"
                data-parityMarker="W"
                data-parity="even"
              >
                <i class="fa fa-circle" aria-hidden="true"></i>
                <i class="fa fa-circle" aria-hidden="true"></i>
              </div>
              <div
                id="dgt_parityMarker-odd-W"
                class="dgt_parityMarker-odd dgt_parityMarker"
                data-parity="odd"
                data-parityMarker="W"
              >
                <i
                  class="fa fa-circle"
                  aria-hidden="true"
                  aria-hidden="true"
                ></i>
              </div>
            </div>
            <div class="dgt_spaces">
              <div id="dgt_column-WA" class="dgt_column-left dgt_column">
                <div class="dgt_spaceContainer">
                  <div
                    id="dgt_space-WAP"
                    class="dgt_space"
                    data-space="WAP"
                  ></div>
                </div>
                <div class="dgt_spaceContainer">
                  <div
                    id="dgt_space-WAR"
                    class="dgt_space"
                    data-space="WAR"
                  ></div>
                </div>
              </div>
              <div id="dgt_column-WB" class="dgt_column-middle dgt_column">
                <div class="dgt_spaceContainer-middle dgt_spaceContainer">
                  <div
                    id="dgt_space-WBO"
                    class="dgt_space-middle dgt_space"
                    data-space="WBO"
                  ></div>
                </div>
                <div class="dgt_spaceContainer-middle dgt_spaceContainer">
                  <div
                    id="dgt_space-WBQ"
                    class="dgt_space-middle dgt_space"
                    data-space="WBQ"
                  ></div>
                </div>
                <div class="dgt_spaceContainer-middle dgt_spaceContainer">
                  <div
                    id="dgt_space-WBS"
                    class="dgt_space-middle dgt_space"
                    data-space="WBS"
                  ></div>
                </div>
              </div>
              <div id="dgt_column-WC" class="dgt_column-right dgt_column">
                <div class="dgt_spaceContainer">
                  <div
                    id="dgt_space-WCP"
                    class="dgt_space"
                    data-space="WCP"
                  ></div>
                </div>
                <div class="dgt_spaceContainer">
                  <div
                    id="dgt_space-WCR"
                    class="dgt_space"
                    data-space="WCR"
                  ></div>
                </div>
              </div>
            </div>
            <div class="dgt_optionMarkers">
              <div
                id="dgt_optionMarker-W0"
                class="dgt_optionMarker"
                data-optionMarker="0"
              >
                0
              </div>
              <div
                id="dgt_optionMarker-W1"
                class="dgt_optionMarker"
                data-optionMarker="1"
              >
                1
              </div>
              <div
                id="dgt_optionMarker-W2"
                class="dgt_optionMarker"
                data-optionMarker="2"
              >
                2
              </div>
              <div
                id="dgt_optionMarker-W3"
                class="dgt_optionMarker"
                data-optionMarker="3"
              >
                3
              </div>
              <div
                id="dgt_optionMarker-W4"
                class="dgt_optionMarker"
                data-optionMarker="4"
              >
                4
              </div>
              <div
                id="dgt_optionMarker-W5"
                class="dgt_optionMarker"
                data-optionMarker="5"
              >
                5
              </div>
              <div
                id="dgt_optionMarker-W6"
                class="dgt_optionMarker"
                data-optionMarker="6"
              >
                6
              </div>
              <div
                id="dgt_optionMarker-W7"
                class="dgt_optionMarker"
                data-optionMarker="7"
              >
                7
              </div>
              <div
                id="dgt_optionMarker-W8"
                class="dgt_optionMarker"
                data-optionMarker="8"
              >
                8
              </div>
              <div
                id="dgt_optionMarker-W9"
                class="dgt_optionMarker"
                data-optionMarker="9"
              >
                9
              </div>
            </div>
          </div>
          <div id="dgt_digit-X" class="dgt_digit">
            <div
              id="dgt_digitLabel-X"
              class="dgt_digitLabel dgt_label"
              data-label="X"
            >
              X
            </div>
            <div class="dgt_parityMarkers">
              <div
                id="dgt_parityMarker-even-X"
                class="dgt_parityMarker-even dgt_parityMarker"
                data-parityMarker="X"
                data-parity="even"
              >
                <i class="fa fa-circle" aria-hidden="true"></i>
                <i class="fa fa-circle" aria-hidden="true"></i>
              </div>
              <div
                id="dgt_parityMarker-odd-X"
                class="dgt_parityMarker-odd dgt_parityMarker"
                data-parity="odd"
                data-parityMarker="X"
              >
                <i
                  class="fa fa-circle"
                  aria-hidden="true"
                  aria-hidden="true"
                ></i>
              </div>
            </div>
            <div class="dgt_spaces">
              <div id="dgt_column-XD" class="dgt_column-left dgt_column">
                <div class="dgt_spaceContainer">
                  <div
                    id="dgt_space-XDP"
                    class="dgt_space"
                    data-space="XDP"
                  ></div>
                </div>
                <div class="dgt_spaceContainer">
                  <div
                    id="dgt_space-XDR"
                    class="dgt_space"
                    data-space="XDR"
                  ></div>
                </div>
              </div>
              <div id="dgt_column-XE" class="dgt_column-middle dgt_column">
                <div class="dgt_spaceContainer-middle dgt_spaceContainer">
                  <div
                    id="dgt_space-XEO"
                    class="dgt_space-middle dgt_space"
                    data-space="XEO"
                  ></div>
                </div>
                <div class="dgt_spaceContainer-middle dgt_spaceContainer">
                  <div
                    id="dgt_space-XEQ"
                    class="dgt_space-middle dgt_space"
                    data-space="XEQ"
                  ></div>
                </div>
                <div class="dgt_spaceContainer-middle dgt_spaceContainer">
                  <div
                    id="dgt_space-XES"
                    class="dgt_space-middle dgt_space"
                    data-space="XES"
                  ></div>
                </div>
              </div>
              <div id="dgt_column-XF" class="dgt_column-right dgt_column">
                <div class="dgt_spaceContainer">
                  <div
                    id="dgt_space-XFP"
                    class="dgt_space"
                    data-space="XFP"
                  ></div>
                </div>
                <div class="dgt_spaceContainer">
                  <div
                    id="dgt_space-XFR"
                    class="dgt_space"
                    data-space="XFR"
                  ></div>
                </div>
              </div>
            </div>
            <div class="dgt_optionMarkers">
              <div
                id="dgt_optionMarker-X0"
                class="dgt_optionMarker"
                data-optionMarker="0"
              >
                0
              </div>
              <div
                id="dgt_optionMarker-X1"
                class="dgt_optionMarker"
                data-optionMarker="1"
              >
                1
              </div>
              <div
                id="dgt_optionMarker-X2"
                class="dgt_optionMarker"
                data-optionMarker="2"
              >
                2
              </div>
              <div
                id="dgt_optionMarker-X3"
                class="dgt_optionMarker"
                data-optionMarker="3"
              >
                3
              </div>
              <div
                id="dgt_optionMarker-X4"
                class="dgt_optionMarker"
                data-optionMarker="4"
              >
                4
              </div>
              <div
                id="dgt_optionMarker-X5"
                class="dgt_optionMarker"
                data-optionMarker="5"
              >
                5
              </div>
              <div
                id="dgt_optionMarker-X6"
                class="dgt_optionMarker"
                data-optionMarker="6"
              >
                6
              </div>
              <div
                id="dgt_optionMarker-X7"
                class="dgt_optionMarker"
                data-optionMarker="7"
              >
                7
              </div>
              <div
                id="dgt_optionMarker-X8"
                class="dgt_optionMarker"
                data-optionMarker="8"
              >
                8
              </div>
              <div
                id="dgt_optionMarker-X9"
                class="dgt_optionMarker"
                data-optionMarker="9"
              >
                9
              </div>
            </div>
          </div>
          <div id="dgt_digit-Y" class="dgt_digit">
            <div
              id="dgt_digitLabel-Y"
              class="dgt_digitLabel dgt_label"
              data-label="Y"
            >
              Y
            </div>
            <div class="dgt_parityMarkers">
              <div
                id="dgt_parityMarker-even-Y"
                class="dgt_parityMarker-even dgt_parityMarker"
                data-parityMarker="Y"
                data-parity="even"
              >
                <i class="fa fa-circle" aria-hidden="true"></i>
                <i class="fa fa-circle" aria-hidden="true"></i>
              </div>
              <div
                id="dgt_parityMarker-odd-Y"
                class="dgt_parityMarker-odd dgt_parityMarker"
                data-parity="odd"
                data-parityMarker="Y"
              >
                <i
                  class="fa fa-circle"
                  aria-hidden="true"
                  aria-hidden="true"
                ></i>
              </div>
            </div>
            <div class="dgt_spaces">
              <div id="dgt_column-YG" class="dgt_column-left dgt_column">
                <div class="dgt_spaceContainer">
                  <div
                    id="dgt_space-YGP"
                    class="dgt_space"
                    data-space="YGP"
                  ></div>
                </div>
                <div class="dgt_spaceContainer">
                  <div
                    id="dgt_space-YGR"
                    class="dgt_space"
                    data-space="YGR"
                  ></div>
                </div>
              </div>
              <div id="dgt_column-YH" class="dgt_column-middle dgt_column">
                <div class="dgt_spaceContainer-middle dgt_spaceContainer">
                  <div
                    id="dgt_space-YHO"
                    class="dgt_space-middle dgt_space"
                    data-space="YHO"
                  ></div>
                </div>
                <div class="dgt_spaceContainer-middle dgt_spaceContainer">
                  <div
                    id="dgt_space-YHQ"
                    class="dgt_space-middle dgt_space"
                    data-space="YHQ"
                  ></div>
                </div>
                <div class="dgt_spaceContainer-middle dgt_spaceContainer">
                  <div
                    id="dgt_space-YHS"
                    class="dgt_space-middle dgt_space"
                    data-space="YHS"
                  ></div>
                </div>
              </div>
              <div id="dgt_column-YI" class="dgt_column-right dgt_column">
                <div class="dgt_spaceContainer">
                  <div
                    id="dgt_space-YIP"
                    class="dgt_space"
                    data-space="YIP"
                  ></div>
                </div>
                <div class="dgt_spaceContainer">
                  <div
                    id="dgt_space-YIR"
                    class="dgt_space"
                    data-space="YIR"
                  ></div>
                </div>
              </div>
            </div>
            <div class="dgt_optionMarkers">
              <div
                id="dgt_optionMarker-Y0"
                class="dgt_optionMarker"
                data-optionMarker="0"
              >
                0
              </div>
              <div
                id="dgt_optionMarker-Y1"
                class="dgt_optionMarker"
                data-optionMarker="1"
              >
                1
              </div>
              <div
                id="dgt_optionMarker-Y2"
                class="dgt_optionMarker"
                data-optionMarker="2"
              >
                2
              </div>
              <div
                id="dgt_optionMarker-Y3"
                class="dgt_optionMarker"
                data-optionMarker="3"
              >
                3
              </div>
              <div
                id="dgt_optionMarker-Y4"
                class="dgt_optionMarker"
                data-optionMarker="4"
              >
                4
              </div>
              <div
                id="dgt_optionMarker-Y5"
                class="dgt_optionMarker"
                data-optionMarker="5"
              >
                5
              </div>
              <div
                id="dgt_optionMarker-Y6"
                class="dgt_optionMarker"
                data-optionMarker="6"
              >
                6
              </div>
              <div
                id="dgt_optionMarker-Y7"
                class="dgt_optionMarker"
                data-optionMarker="7"
              >
                7
              </div>
              <div
                id="dgt_optionMarker-Y8"
                class="dgt_optionMarker"
                data-optionMarker="8"
              >
                8
              </div>
              <div
                id="dgt_optionMarker-Y9"
                class="dgt_optionMarker"
                data-optionMarker="9"
              >
                9
              </div>
            </div>
          </div>
        </div>
        <div class="dgt_rowMarkers dgt_rowLabels">
          <div
            id="dgt_rowMarker-O"
            class="dgt_rowMarker dgt_rowLabel dgt_lineMarker dgt_label"
            data-lineMarker="O"
            data-lineType="row"
          ></div>
          <div
            id="dgt_rowMarker-P"
            class="dgt_rowMarker dgt_rowLabel dgt_lineMarker dgt_label"
            data-lineMarker="P"
            data-lineType="row"
          ></div>
          <div
            id="dgt_rowMarker-Q"
            class="dgt_rowMarker dgt_rowLabel dgt_lineMarker dgt_label"
            data-lineMarker="Q"
            data-lineType="row"
          ></div>
          <div
            id="dgt_rowMarker-R"
            class="dgt_rowMarker dgt_rowLabel dgt_lineMarker dgt_label"
            data-lineMarker="R"
            data-lineType="row"
          ></div>
          <div
            id="dgt_rowMarker-S"
            class="dgt_rowMarker dgt_rowLabel dgt_lineMarker dgt_label"
            data-lineMarker="S"
            data-lineType="row"
          ></div>
        </div>
      </div>
    </div>
    <div class="dgt_columnMarkers dgt_columnLabels">
      <div class="dgt_columnGroup">
        <div
          id="dgt_columnMarker-A"
          class="dgt_columnMarker dgt_columnLabel dgt_lineMarker dgt_label"
          data-lineMarker="A"
          data-lineType="column"
        ></div>
        <div
          id="dgt_columnMarker-B"
          class="dgt_columnMarker dgt_columnLabel dgt_lineMarker dgt_label"
          data-lineMarker="B"
          data-lineType="column"
        ></div>
        <div
          id="dgt_columnMarker-C"
          class="dgt_columnMarker dgt_columnLabel dgt_lineMarker dgt_label"
          data-lineMarker="C"
          data-lineType="column"
        ></div>
      </div>
      <div class="dgt_columnGroup">
        <div
          id="dgt_columnMarker-D"
          class="dgt_columnMarker dgt_columnLabel dgt_lineMarker dgt_label"
          data-lineMarker="D"
          data-lineType="column"
        ></div>
        <div
          id="dgt_columnMarker-E"
          class="dgt_columnMarker dgt_columnLabel dgt_lineMarker dgt_label"
          data-lineMarker="E"
          data-lineType="column"
        ></div>
        <div
          id="dgt_columnMarker-F"
          class="dgt_columnMarker dgt_columnLabel dgt_lineMarker dgt_label"
          data-lineMarker="F"
          data-lineType="column"
        ></div>
      </div>
      <div class="dgt_columnGroup">
        <div
          id="dgt_columnMarker-G"
          class="dgt_columnMarker dgt_columnLabel dgt_lineMarker dgt_label"
          data-lineMarker="G"
          data-lineType="column"
        ></div>
        <div
          id="dgt_columnMarker-H"
          class="dgt_columnMarker dgt_columnLabel dgt_lineMarker dgt_label"
          data-lineMarker="H"
          data-lineType="column"
        ></div>
        <div
          id="dgt_columnMarker-I"
          class="dgt_columnMarker dgt_columnLabel dgt_lineMarker dgt_label"
          data-lineMarker="I"
          data-lineType="column"
        ></div>
      </div>
    </div>
  </div>
</div>

{OVERALL_GAME_FOOTER}
