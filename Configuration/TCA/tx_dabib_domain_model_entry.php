<?php

# This file is part of the extension DA Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


/**
 * Entry and its properties
 * 
 * Configuration of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */
return [
    'ctrl' => [
        'title'                    => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry',
        'label'                    => 'itemTitle',
        'label_alt'                => 'publicationTitle,seriesTitle,meetingTitle',
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'delete'                   => 'deleted',
        'sortby'                   => 'sorting',
        'default_sortby'           => 'itemTitle',
        'versioningWS'             => true,
        'iconfile'                 => 'EXT:da_bib/Resources/Public/Icons/Entry.svg',
        'origUid'                  => 't3_origuid',
        'hideAtCopy'               => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource',
        'translationSource'        => 'l10n_source',
        'searchFields'             => 'zoteroUri,label,identifier,identifierType,itemTitle,publicationTitle,publicationPlace,publicationPublisher,publicationDate,contributorAuthor,contributorEditor,contributorTranslator,contributorGeneric,scope,extent,extentType,seriesTitle,meetingTitle',
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
                'foreign_table'       => 'tx_dabib_domain_model_entry',
                'foreign_table_where' =>
                    'AND {#tx_dabib_domain_model_entry}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_dabib_domain_model_entry}.{#sys_language_uid} IN (-1,0)',
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
        'type' => [
            'label'       => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.type',
            'description' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.type.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'foreign_table'       => 'tx_dabib_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_dabib_domain_model_tag}.{#pid}=###CURRENT_PID###'
                . ' AND {#tx_dabib_domain_model_tag}.{#type}=\'entryType\''
                . ' ORDER BY name',
            ],
        ],
        'label' => [
            'label'       => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.label',
            'description' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.label.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_dabib_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_dabib_domain_model_tag}.{#pid}=###CURRENT_PID###'
                . ' AND {#tx_dabib_domain_model_tag}.{#type}=\'label\''
                . ' ORDER BY name',
                'MM'                  => 'tx_dabib_domain_model_entry_label_mm',
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
        'identifier' => [
            'label'       => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.identifier',
            'description' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.identifier.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
            ],
        ],
        'identifierType' => [
            'label'       => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.identifierType',
            'description' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.identifierType.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'foreign_table'       => 'tx_dabib_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_dabib_domain_model_tag}.{#pid}=###CURRENT_PID###'
                . ' AND {#tx_dabib_domain_model_tag}.{#type}=\'identifierType\''
                . ' ORDER BY name',
            ],
        ],
        'zoteroUri' => [
            'label'       => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.zoteroUri',
            'description' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.zoteroUri.description',
            'config' => [
                'type'           => 'link',
                'allowedTypes'   => ['url'],
                'allowedOptions' => [],
                'mode'           => 'prepend',
                'valuePicker'    => [
                   'items' => [
                      ['HTTPS', 'https://'],
                      ['HTTP', 'http://'],
                   ],
                ],
            ],
        ],
        'same_as' => [
            'label'       => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.sameAs',
            'description' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.sameAs.description',
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
        'itemTitle' => [
            'label'       => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.itemTitle',
            'description' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.itemTitle.description',
            'config'      => [
                'type'                  => 'text',
                'enableRichtext'        => true,
                'richtextConfiguration' => 'da_bib',
            ],
        ],
        'publicationTitle' => [
            'label'       => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.publicationTitle',
            'description' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.publicationTitle.description',
            'config'      => [
                'type'                  => 'text',
                'enableRichtext'        => true,
                'richtextConfiguration' => 'da_bib',
            ],
        ],
        'publicationPlace' => [
            'label'       => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.publicationPlace',
            'description' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.publicationPlace.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
            ],
        ],
        'publicationPublisher' => [
            'label'       => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.publicationPublisher',
            'description' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.publicationPublisher.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
            ],
        ],
        'publicationDate' => [
            'label'       => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.reference.publicationDate',
            'description' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.reference.publicationDate.description',
            'config'      => [
                'type'     => 'datetime',
                'format'   => 'date',
                'nullable' => true,
            ],
        ],
        'contributorAuthor' => [
            'label'       => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.contributorAuthor',
            'description' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.contributorAuthor.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_dabib_domain_model_contributor',
                'foreign_table_where' => 'AND {#tx_dabib_domain_model_contributor}.{#pid}=###CURRENT_PID###'
                . ' ORDER BY surname, forename, corporateName',
                'MM'                  => 'tx_dabib_domain_model_entry_contributor_author_mm',
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
        'contributorEditor' => [
            'label'       => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.contributorEditor',
            'description' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.contributorEditor.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_dabib_domain_model_contributor',
                'foreign_table_where' => 'AND {#tx_dabib_domain_model_contributor}.{#pid}=###CURRENT_PID###'
                . ' ORDER BY surname, forename, corporateName',
                'MM'                  => 'tx_dabib_domain_model_entry_contributor_editor_mm',
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
        'contributorTranslator' => [
            'label'       => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.contributorTranslator',
            'description' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.contributorTranslator.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_dabib_domain_model_contributor',
                'foreign_table_where' => 'AND {#tx_dabib_domain_model_contributor}.{#pid}=###CURRENT_PID###'
                . ' ORDER BY surname, forename, corporateName',
                'MM'                  => 'tx_dabib_domain_model_entry_contributor_translator_mm',
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
        'contributorGeneric' => [
            'label'       => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.contributorGeneric',
            'description' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.contributorGeneric.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_dabib_domain_model_contributor',
                'foreign_table_where' => 'AND {#tx_dabib_domain_model_contributor}.{#pid}=###CURRENT_PID###'
                . ' ORDER BY surname, forename, corporateName',
                'MM'                  => 'tx_dabib_domain_model_entry_contributor_generic_mm',
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
        'scope' => [
            'label'       => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.scope',
            'description' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.scope.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_dabib_domain_model_scope',
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
        'extent' => [
            'label'       => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.extent',
            'description' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.extent.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
            ],
        ],
        'extentType' => [
            'label'       => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.extentType',
            'description' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.extentType.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'foreign_table'       => 'tx_dabib_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_dabib_domain_model_tag}.{#pid}=###CURRENT_PID###'
                . ' AND {#tx_dabib_domain_model_tag}.{#type}=\'extentType\''
                . ' ORDER BY name',
            ],
        ],
        'seriesTitle' => [
            'label'       => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.seriesTitle',
            'description' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.seriesTitle.description',
            'config'      => [
                'type'                  => 'text',
                'enableRichtext'        => true,
                'richtextConfiguration' => 'da_bib',
            ],
        ],
        'meetingTitle' => [
            'label'       => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.meetingTitle',
            'description' => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.meetingTitle.description',
            'config'      => [
                'type'                  => 'text',
                'enableRichtext'        => true,
                'richtextConfiguration' => 'da_bib',
            ],
        ],
    ],
    'palettes' => [
        'identifierIdentifierType' => [
            'showitem' => 'identifier,identifierType,',
        ],
        'itemTitlePublicationTitle' => [
            'showitem' => 'itemTitle,publicationTitle,',
        ],
        'publicationPlacePublicationPublisher' => [
            'showitem' => 'publicationPlace,publicationPublisher,',
        ],
        'extentExtentType' => [
            'showitem' => 'extent,extentType,',
        ],
        'seriesTitleMeetingTitle' => [
            'showitem' => 'seriesTitle,meetingTitle,',
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => 'hidden,type,label,identifierIdentifierType,zoteroUri,sameAs,
            --div--;LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.publication,itemTitlePublicationTitle,publicationPlacePublicationPublisher,publicationDate,
            --div--;LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.contributors,contributorAuthor,contributorEditor,contributorTranslator,contributorGeneric,
            --div--;LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.entry.scopesAndExtent,scope,extentExtentType,seriesTitleMeetingTitle,',
        ],
    ],
];

?>
