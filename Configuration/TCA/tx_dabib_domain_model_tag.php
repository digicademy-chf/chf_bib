<?php

# This file is part of the extension DA Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


/**
 * Tag and its properties
 * 
 * Configuration of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */
return [
    'ctrl' => [
        'title'                    => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.tag',
        'label'                    => 'tag',
        'label_alt'                => 'type',
        'descriptionColumn'        => 'description',
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'delete'                   => 'deleted',
        'sortby'                   => 'sorting',
        'default_sortby'           => 'tag ASC,type ASC',
        'versioningWS'             => true,
        'iconfile'                 => 'EXT:da_bib/Resources/Public/Icons/Tag.svg',
        'origUid'                  => 't3_origuid',
        'hideAtCopy'               => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource',
        'translationSource'        => 'l10n_source',
        'searchFields'             => 'tag,type,description',
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
                'foreign_table'       => 'tx_dabib_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_dabib_domain_model_tag}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_dabib_domain_model_tag}.{#sys_language_uid} IN (-1,0)',
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
        'parent_id' => [
            'label'       => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.tag.parent_id',
            'description' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.tag.parent_id.description',
            'config'      => [
                'type'          => 'select',
                'renderType'    => 'selectSingle',
                'foreign_table' => 'tx_dabib_domain_model_bibliographic_resource',
                'maxitems'      => 1,
            ],
        ],
        'tag' => [
            'label'       => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.tag.tag',
            'description' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.tag.tag.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
                'required' => true,
            ],
        ],
        'type' => [
            'label'       => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.tag.type',
            'description' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.tag.type.description',
            'config'      => [
                'type'       => 'select',
                'renderType' => 'selectSingle',
                'items'      => [
                    [
                        'label' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.tag.type.label',
                        'value' => 'label',
                    ],
                ],
                'required'   => true,
            ],
        ],
        'description' => [
            'label'       => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.tag.description',
            'description' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.tag.description.description',
            'config'      => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 5,
                'max'  => 2000,
                'eval' => 'trim',
            ],
        ],
        'sameAs' => [
            'label'       => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.tag.sameAs',
            'description' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.tag.sameAs.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_dabib_domain_model_same_as',
                'foreign_field'       => 'parent_id',
                'foreign_table_field' => 'parent_table',
                'appearance'          => [
                    'collapseAll'                     => true,
                    'expandSingle'                    => true,
                    'newRecordLinkAddTitle'           => true,
                    'levelLinksPosition'              => 'top',
                    'useSortable'                     => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink'         => true,
                    'showSynchronizationLink'         => true,
                ],
            ],
        ],
        'asLabelOfEntry' => [
            'label'       => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.tag.asLabelOfEntry',
            'description' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.tag.asLabelOfEntry.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_dabib_domain_model_entry',
                'MM'                  => 'tx_dabib_domain_model_entry_tag_label_mm',
                'MM_opposite_field'   => 'label',
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
        'asLabelOfContributor' => [
            'label'       => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.tag.asLabelOfContributor',
            'description' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.tag.asLabelOfContributor.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_dabib_domain_model_contributor',
                'MM'                  => 'tx_dabib_domain_model_contributor_tag_label_mm',
                'MM_opposite_field'   => 'label',
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
        'asLabelOfReference' => [
            'label'       => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.tag.asLabelOfReference',
            'description' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.tag.asLabelOfReference.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_dabib_domain_model_reference',
                'MM'                  => 'tx_dabib_domain_model_reference_tag_label_mm',
                'MM_opposite_field'   => 'label',
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
    ],
    'palettes' => [
        'hiddenParentId' => [
            'showitem' => 'hidden,parent_id,',
        ],
        'tagType' => [
            'showitem' => 'tag,type,',
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => 'hiddenParentId,tagType,description,sameAs,
            --div--;LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.tag.labelled,asLabelOfEntry,asLabelOfContributor,asLabelOfReference',
        ],
    ],
];

?>
