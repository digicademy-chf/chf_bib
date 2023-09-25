<?php

# This file is part of the extension CHF Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


/**
 * Scope and its properties
 * 
 * Configuration of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */
return [
    'ctrl' => [
        'title'                    => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.scope',
        'label'                    => 'text',
        'label_alt'                => 'type',
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'delete'                   => 'deleted',
        'sortby'                   => 'sorting',
        'default_sortby'           => 'text ASC,type ASC',
        'versioningWS'             => true,
        'iconfile'                 => 'EXT:chf_bib/Resources/Public/Icons/Scope.svg',
        'origUid'                  => 't3_origuid',
        'hideAtCopy'               => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource',
        'translationSource'        => 'l10n_source',
        'searchFields'             => 'text,type',
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
                'type'       => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'size'       => 5,
                'maxitems'   => 20,
                'items'      => [
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
                'foreign_table'       => 'tx_chfbib_domain_model_scope',
                'foreign_table_where' => 'AND {#tx_chfbib_domain_model_scope}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbib_domain_model_scope}.{#sys_language_uid} IN (-1,0)',
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
        'text' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.scope.text',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.scope.text.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
                'required' => true,
            ],
        ],
        'type' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.scope.type',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.scope.type.description',
            'config'      => [
                'type'       => 'select',
                'renderType' => 'selectSingle',
                'items'      => [
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.scope.type.urn',
                        'value' => 'urn',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.scope.type.url',
                        'value' => 'url',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.scope.type.issn',
                        'value' => 'issn',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.scope.type.isbn',
                        'value' => 'isbn',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.scope.type.callNumber',
                        'value' => 'callNumber',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.scope.type.volume',
                        'value' => 'volume',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.scope.type.issue',
                        'value' => 'issue',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.scope.type.edition',
                        'value' => 'edition',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.scope.type.version',
                        'value' => 'version',
                    ],
                ],
            ],
        ],
    ],
    'palettes' => [
        'textType' => [
            'showitem' => 'text,type,',
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => 'hidden,textType,',
        ],
    ],
];

?>
