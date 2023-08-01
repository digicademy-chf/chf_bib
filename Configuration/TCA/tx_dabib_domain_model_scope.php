<?php

# This file is part of the extension DA Bib for TYPO3.
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
        'title'                    => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.scope',
        'label'                    => 'scope',
        'label_alt'                => 'scopeType',
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'delete'                   => 'deleted',
        'sortby'                   => 'sorting',
        'default_sortby'           => 'scope ASC,scopeType ASC',
        'versioningWS'             => true,
        'iconfile'                 => 'EXT:da_bib/Resources/Public/Icons/Scope.svg',
        'origUid'                  => 't3_origuid',
        'hideAtCopy'               => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource',
        'translationSource'        => 'l10n_source',
        'searchFields'             => 'scope,scopeType',
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
                'foreign_table'       => 'tx_dabib_domain_model_scope',
                'foreign_table_where' => 'AND {#tx_dabib_domain_model_scope}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_dabib_domain_model_scope}.{#sys_language_uid} IN (-1,0)',
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
        'scope' => [
            'label'       => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.scope.scope',
            'description' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.scope.scope.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
                'required' => true,
            ],
        ],
        'scopeType' => [
            'label'       => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.scope.scopeType',
            'description' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.scope.scopeType.description',
            'config'      => [
                'type'       => 'select',
                'renderType' => 'selectSingle',
                'items'      => [
                    [
                        'label' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.scope.scopeType.urn',
                        'value' => 'urn',
                        'group' => 'identifier',
                    ],
                    [
                        'label' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.scope.scopeType.url',
                        'value' => 'url',
                        'group' => 'identifier',
                    ],
                    [
                        'label' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.scope.scopeType.issn',
                        'value' => 'issn',
                        'group' => 'identifier',
                    ],
                    [
                        'label' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.scope.scopeType.isbn',
                        'value' => 'isbn',
                        'group' => 'identifier',
                    ],
                    [
                        'label' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.scope.scopeType.callNumber',
                        'value' => 'callNumber',
                        'group' => 'identifier',
                    ],
                    [
                        'label' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.scope.scopeType.volume',
                        'value' => 'volume',
                        'group' => 'scope',
                    ],
                    [
                        'label' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.scope.scopeType.issue',
                        'value' => 'issue',
                        'group' => 'scope',
                    ],
                    [
                        'label' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.scope.scopeType.edition',
                        'value' => 'edition',
                        'group' => 'scope',
                    ],
                    [
                        'label' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.scope.scopeType.version',
                        'value' => 'version',
                        'group' => 'scope',
                    ],
                ],
                'itemGroups' => [
                    'identifier' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.scope.scopeType.identifier',
                    'scope'      => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.scope.scopeType.scope',
                ],
            ],
        ],
    ],
    'palettes' => [
        'scopeScopeType' => [
            'showitem' => 'scope,scopeType,',
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => 'hidden,scopeScopeType,',
        ],
    ],
];

?>
