<?php

# This file is part of the extension DA Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


/**
 * Reference and its properties
 * 
 * Configuration of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */
return [
    'ctrl' => [
        'title'                    => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.reference',
        'label'                    => 'lastChecked',
        'label_alt'                => 'elaboration,elaborationType',
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'delete'                   => 'deleted',
        'sortby'                   => 'sorting',
        'default_sortby'           => 'lastChecked ASC,elaboration ASC,elaborationType ASC',
        'versioningWS'             => true,
        'iconfile'                 => 'EXT:da_bib/Resources/Public/Icons/Reference.svg',
        'origUid'                  => 't3_origuid',
        'hideAtCopy'               => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource',
        'translationSource'        => 'l10n_source',
        'searchFields'             => 'elaboration,elaborationType,lastChecked',
        'enablecolumns'            => [
            'disabled' => 'hidden',
            'fe_group' => 'fe_group',
        ],
    ],
    'columns' => [
        'hidden' => [
            'exclude' => true,
            'label'   => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.enabled',
            'config'  => [
                'type'       => 'check',
                'renderType' => 'checkboxToggle',
                'items'      => [
                    [
                        'label' => '',
                        'invertStateDisplay' => true,
                    ]
                ],
            ]
        ],
        'fe_group' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.fe_group',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'size' => 5,
                'maxitems' => 20,
                'items' => [
                    [
                        'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hide_at_login',
                        'value' => -1,
                    ],
                    [
                        'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.any_login',
                        'value' => -2,
                    ],
                    [
                        'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.usergroups',
                        'value' => '--div--',
                    ],
                ],
                'exclusiveKeys' => '-1,-2',
                'foreign_table' => 'fe_groups',
            ],
        ],
        'sys_language_uid' => [
            'exclude' => true,
            'label'   => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config'  => [
                'type' => 'language',
            ],
        ],
        'l18n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label'       => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config'      => [
                'type'       => 'select',
                'renderType' => 'selectSingle',
                'items'      => [
                    [
                        'label' => '',
                        'value' => 0,
                    ],
                ],
                'foreign_table'       => 'tx_dabib_domain_model_reference',
                'foreign_table_where' => 'AND {#tx_dabib_domain_model_reference}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_dabib_domain_model_reference}.{#sys_language_uid} IN (-1,0)',
                'default'             => 0,
            ],
        ],
        'l10n_source' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'l18n_diffsource' => [
            'config' => [
                'type'    => 'passthrough',
                'default' => '',
            ],
        ],
        'entry' => [
            'label'       => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.reference.entry',
            'description' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.reference.entry.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_dabib_domain_model_entry',
                'MM'                  => 'tx_dabib_domain_model_reference_entry_entry_mm',
                'size'                => 5,
                'autoSizeMax'         => 10,
                'minitems'            => 1,
                'maxitems'            => 1,
                'fieldControl'        => [
                    'editPopup'  => [
                        'disabled' => false,
                    ],
                    'addRecord'  => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => false,
                    ],
                ],
                'required' => true,
            ],
        ],
        'elaboration' => [
            'label'       => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.reference.elaboration',
            'description' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.reference.elaboration.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
            ],
        ],
        'elaborationType' => [
            'label'       => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.reference.elaborationType',
            'description' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.reference.elaborationType.description',
            'config'      => [
                'type'       => 'select',
                'renderType' => 'selectSingle',
                'items'      => [
                    [
                        'label' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.reference.elaborationType.pageNumbers',
                        'value' => 'pageNumbers',
                    ],
                    [
                        'label' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.reference.elaborationType.paragraphNumbers',
                        'value' => 'paragraphNumbers',
                    ],
                    [
                        'label' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.reference.elaborationType.columnNumbers',
                        'value' => 'columnNumbers',
                    ],
                    [
                        'label' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.reference.elaborationType.chapterNumbers',
                        'value' => 'chapterNumbers',
                    ],
                ],
            ],
        ],
        'label' => [
            'label'       => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.reference.label',
            'description' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.reference.label.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_dabib_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_dabib_domain_model_tag}.{#type}=\'label\'',
                // Do not require the same PID here because references may be included in other data models living on other pages
                'MM'                  => 'tx_dabib_domain_model_reference_tag_label_mm',
                'size'                => 5,
                'autoSizeMax'         => 10,
                'fieldControl'        => [
                    'editPopup'  => [
                        'disabled' => false,
                    ],
                    'addRecord'  => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => false,
                    ],
                ],
            ],
        ],
        'lastChecked' => [
            'label'       => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.reference.lastChecked',
            'description' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.reference.lastChecked.description',
            'config'      => [
                'type'     => 'datetime',
                'format'   => 'date',
                'nullable' => true,
            ],
        ],
    ],
    'palettes' => [
        'elaborationElaborationType' => [
            'showitem' => 'elaboration,elaborationType,',
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => 'hidden,entry,elaborationElaborationType,label,lastChecked,',
        ],
    ],
];

?>
