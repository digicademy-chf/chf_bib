<?php

# This file is part of the extension CHF Bib for TYPO3.
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
        'title'                    => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry',
        'label'                    => 'itemTitle',
        'label_alt'                => 'publicationTitle,seriesTitle,meetingTitle',
        'descriptionColumn'        => 'description',
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'delete'                   => 'deleted',
        'sortby'                   => 'sorting',
        'default_sortby'           => 'itemTitle ASC,publicationTitle ASC,seriesTitle ASC,meetingTitle ASC',
        'versioningWS'             => true,
        'iconfile'                 => 'EXT:chf_bib/Resources/Public/Icons/Entry.svg',
        'origUid'                  => 't3_origuid',
        'hideAtCopy'               => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource',
        'translationSource'        => 'l10n_source',
        'searchFields'             => 'uuid,type,syncId,itemTitle,publicationTitle,publicationPlace,publicationDateCirca,publicationDateStart,publicationDateEnd,publisher,extent,extentType,seriesTitle,meetingTitle,description,summary,import',
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
                'foreign_table'       => 'tx_chfbib_domain_model_entry',
                'foreign_table_where' => 'AND {#tx_chfbib_domain_model_entry}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbib_domain_model_entry}.{#sys_language_uid} IN (-1,0)',
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
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.parent_id',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.parent_id.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'foreign_table'       => 'tx_chfbib_domain_model_bibliographic_resource',
                'foreign_table_where' => 'AND {#tx_chfbib_domain_model_bibliographic_resource}.{#pid}=###CURRENT_PID###',
                'maxitems'            => 1,
                'required'            => true,
            ],
        ],
        'uuid' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.uuid',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.uuid.description',
            'config'      => [
                'type'     => 'uuid',
                'size'     => 40,
                'required' => true,
            ],
        ],
        'type' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.type',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.type.description',
            'config'      => [
                'type'       => 'select',
                'renderType' => 'selectSingle',
                'items'      => [
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.type.artwork',
                        'value' => 'artwork',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.type.audioRecording',
                        'value' => 'audioRecording',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.type.bill',
                        'value' => 'bill',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.type.blogPost',
                        'value' => 'blogPost',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.type.book',
                        'value' => 'book',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.type.bookSection',
                        'value' => 'bookSection',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.type.case',
                        'value' => 'case',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.type.computerProgram',
                        'value' => 'computerProgram',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.type.conferencePaper',
                        'value' => 'conferencePaper',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.type.dataset',
                        'value' => 'dataset',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.type.dictionaryEntry',
                        'value' => 'dictionaryEntry',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.type.document',
                        'value' => 'document',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.type.email',
                        'value' => 'email',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.type.encyclopediaArticle',
                        'value' => 'encyclopediaArticle',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.type.film',
                        'value' => 'film',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.type.forumPost',
                        'value' => 'forumPost',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.type.hearing',
                        'value' => 'hearing',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.type.instantMessage',
                        'value' => 'instantMessage',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.type.interview',
                        'value' => 'interview',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.type.journalArticle',
                        'value' => 'journalArticle',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.type.letter',
                        'value' => 'letter',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.type.magazineArticle',
                        'value' => 'magazineArticle',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.type.manuscript',
                        'value' => 'manuscript',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.type.map',
                        'value' => 'map',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.type.newspaperArticle',
                        'value' => 'newspaperArticle',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.type.patent',
                        'value' => 'patent',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.type.podcast',
                        'value' => 'podcast',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.type.preprint',
                        'value' => 'preprint',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.type.presentation',
                        'value' => 'presentation',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.type.radioBroadcast',
                        'value' => 'radioBroadcast',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.type.report',
                        'value' => 'report',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.type.standard',
                        'value' => 'standard',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.type.statute',
                        'value' => 'statute',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.type.thesis',
                        'value' => 'thesis',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.type.tvBroadcast',
                        'value' => 'tvBroadcast',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.type.videoRecording',
                        'value' => 'videoRecording',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.type.webpage',
                        'value' => 'webpage',
                    ],
                ],
            ],
        ],
        'syncId' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.syncId',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.syncId.description',
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
        'label' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.label',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.label.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbib_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chfbib_domain_model_tag}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbib_domain_model_tag}.{#type}=\'label\'',
                'MM'                  => 'tx_chfbib_domain_model_entry_tag_label_mm',
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
        'same_as' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.sameAs',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.sameAs.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_chfbib_domain_model_same_as',
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
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.itemTitle',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.itemTitle.description',
            'config'      => [
                'type'                  => 'text',
                'enableRichtext'        => true,
                'richtextConfiguration' => 'chf_bib',
            ],
        ],
        'publicationTitle' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.publicationTitle',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.publicationTitle.description',
            'config'      => [
                'type'                  => 'text',
                'enableRichtext'        => true,
                'richtextConfiguration' => 'chf_bib',
            ],
        ],
        'publicationPlace' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.publicationPlace',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.publicationPlace.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
            ],
        ],
        'publicationDateCirca' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.publicationDateCirca',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.publicationDateCirca.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
            ],
        ],
        'publicationDateStart' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.publicationDateStart',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.publicationDateStart.description',
            'config'      => [
                'type'     => 'datetime',
                'format'   => 'date',
                'nullable' => true,
            ],
        ],
        'publicationDateEnd' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.publicationDateEnd',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.publicationDateEnd.description',
            'config'      => [
                'type'     => 'datetime',
                'format'   => 'date',
                'nullable' => true,
            ],
        ],
        'publisher' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.publisher',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.publisher.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
            ],
        ],
        'author' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.author',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.author.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbib_domain_model_contributor',
                'foreign_table_where' => 'AND {#tx_chfbib_domain_model_contributor}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbib_domain_model_entry_contributor_author_mm',
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
        'editor' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.editor',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.editor.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbib_domain_model_contributor',
                'foreign_table_where' => 'AND {#tx_chfbib_domain_model_contributor}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbib_domain_model_entry_contributor_editor_mm',
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
        'translator' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.translator',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.translator.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbib_domain_model_contributor',
                'foreign_table_where' => 'AND {#tx_chfbib_domain_model_contributor}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbib_domain_model_entry_contributor_translator_mm',
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
        'genericContributor' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.genericContributor',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.genericContributor.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbib_domain_model_contributor',
                'foreign_table_where' => 'AND {#tx_chfbib_domain_model_contributor}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbib_domain_model_entry_contributor_generic_mm',
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
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.scope',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.scope.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_chfbib_domain_model_scope',
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
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.extent',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.extent.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
            ],
        ],
        'extentType' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.extentType',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.extentType.description',
            'config'      => [
                'type'       => 'select',
                'renderType' => 'selectSingle',
                'items'      => [
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.extentType.pageNumbers',
                        'value' => 'pageNumbers',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.extentType.paragraphNumbers',
                        'value' => 'paragraphNumbers',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.extentType.columnNumbers',
                        'value' => 'columnNumbers',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.extentType.chapterNumbers',
                        'value' => 'chapterNumbers',
                    ],
                ],
            ],
        ],
        'seriesTitle' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.seriesTitle',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.seriesTitle.description',
            'config'      => [
                'type'                  => 'text',
                'enableRichtext'        => true,
                'richtextConfiguration' => 'chf_bib',
            ],
        ],
        'meetingTitle' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.meetingTitle',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.meetingTitle.description',
            'config'      => [
                'type'                  => 'text',
                'enableRichtext'        => true,
                'richtextConfiguration' => 'chf_bib',
            ],
        ],
        'description' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.description',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.description.description',
            'config'      => [
                'type'                  => 'text',
                'enableRichtext'        => true,
            ],
        ],
        'summary' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.summary',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.summary.description',
            'config'      => [
                'type'                  => 'text',
                'enableRichtext'        => true,
            ],
        ],
        'image' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.image',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.image.description',
            'config' => [
                'type'     => 'file',
                'allowed'  => 'common-image-types'
            ],
        ],
        'file' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.file',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.file.description',
            'config' => [
                'type'     => 'file',
                'allowed'  => 'common-text-types'
            ],
        ],
        'import' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.import',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.import.description',
            'config'      => [
                'type'     => 'text',
                'cols'     => 40,
                'rows'     => 15,
                'max'      => 100000,
                'eval'     => 'trim',
                'required' => true,
            ],
        ],
        'asEntryOfReference' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.tag.asEntryOfReference',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.tag.asEntryOfReference.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbib_domain_model_reference',
                // Do not require the same PID here because references may be included in other data models living on other pages
                'MM'                  => 'tx_chfbib_domain_model_reference_entry_entry_mm',
                'MM_opposite_field'   => 'entry',
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
        'uuidType' => [
            'showitem' => 'uuid,type,',
        ],
        'itemTitlePublicationTitle' => [
            'showitem' => 'itemTitle,publicationTitle,',
        ],
        'publicationPlacePublicationDateCirca' => [
            'showitem' => 'publicationPlace,publicationDateCirca,',
        ],
        'publicationDateStartPublicationDateEnd' => [
            'showitem' => 'publicationDateStart,publicationDateEnd,',
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
            'showitem' => 'hiddenParentId,uuidType,syncId,identifier,label,sameAs,
            --div--;LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.publication,itemTitlePublicationTitle,publicationPlacePublicationDateCirca,publicationDateStartPublicationDateEnd,publisher,
            --div--;LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.contributors,author,editor,translator,genericContributor,
            --div--;LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.scopesAndExtent,scope,extentExtentType,seriesTitleMeetingTitle,
            --div--;LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.content,description,summary,image,file,
            --div--;LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.original,import,
            --div--;LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.entry.referenced,asEntryOfReference,',
        ],
    ],
];

?>
