<?php
declare(strict_types=1);

# This file is part of the extension CHF Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


defined('TYPO3') or die();

/**
 * BibliographicEntry and its properties
 * 
 * Configuration of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */
return [
    'ctrl' => [
        'title'                    => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry',
        'label'                    => 'itemTitle',
        'label_alt'                => 'standaloneTitle,meetingTitle,seriesTitle',
        'label_alt_force'          => true,
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'delete'                   => 'deleted',
        'sortby'                   => 'sorting',
        'default_sortby'           => 'isHighlight ASC,itemTitle ASC,standaloneTitle ASC,meetingTitle ASC,seriesTitle ASC',
        'versioningWS'             => true,
        'iconfile'                 => 'EXT:chf_bib/Resources/Public/Icons/BibliographicEntry.svg',
        'origUid'                  => 't3_origuid',
        'hideAtCopy'               => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'translationSource'        => 'l10n_source',
        'searchFields'             => 'uuid,type,itemTitle,standaloneTitle,meetingTitle,seriesTitle,publicationDate,revisionNumber,revisionDate,editorialNote,date,lastChecked,importOrigin,import',
        'enablecolumns'            => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
            'fe_group' => 'fe_group',
        ],
    ],
    'columns' => [
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
                'foreign_table_where' => 'ORDER BY fe_groups.title',
            ],
        ],
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'language',
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l10n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => '',
                        'value' => 0,
                    ],
                ],
                'foreign_table' => 'tx_chfbib_domain_model_bibliographic_entry',
                'foreign_table_where' => 'AND {#tx_chfbib_domain_model_bibliographic_entry}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbib_domain_model_bibliographic_entry}.{#sys_language_uid} IN (-1,0)',
                'default' => 0,
            ],
        ],
        'l10n_source' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
                'default' => '',
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.enabled',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.hidden.description',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        'label' => '',
                        'invertStateDisplay' => true,
                    ]
                ],
            ]
        ],
        'starttime' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.starttime.description',
            'config' => [
                'type' => 'datetime',
                'format' => 'datetime',
                'eval' => 'int',
                'default' => 0,
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.endtime.description',
            'config' => [
                'type' => 'datetime',
                'format' => 'datetime',
                'eval' => 'int',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2106),
                ],
            ],
        ],
        'parentResource' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.parentResource',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.parentResource.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingleBox',
                'foreign_table' => 'tx_chfbase_domain_model_resource',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_resource}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_resource}.{#type}=\'bibliographicResource\'',
                'sortItems' => [
                    'label' => 'asc',
                ],
                'required' => true,
            ],
        ],
        'uuid' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.uuid',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.uuid.description',
            'config' => [
                'type' => 'uuid',
                'size' => 40,
                'required' => true,
            ],
        ],
        'type' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.type',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.type.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.type.artwork',
                        'value' => 'artwork',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.type.audioRecording',
                        'value' => 'audioRecording',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.type.bill',
                        'value' => 'bill',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.type.blogPost',
                        'value' => 'blogPost',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.type.book',
                        'value' => 'book',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.type.bookSection',
                        'value' => 'bookSection',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.type.case',
                        'value' => 'case',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.type.computerProgram',
                        'value' => 'computerProgram',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.type.conferencePaper',
                        'value' => 'conferencePaper',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.type.dataset',
                        'value' => 'dataset',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.type.dictionaryEntry',
                        'value' => 'dictionaryEntry',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.type.document',
                        'value' => 'document',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.type.email',
                        'value' => 'email',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.type.encyclopediaArticle',
                        'value' => 'encyclopediaArticle',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.type.film',
                        'value' => 'film',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.type.forumPost',
                        'value' => 'forumPost',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.type.hearing',
                        'value' => 'hearing',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.type.instantMessage',
                        'value' => 'instantMessage',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.type.interview',
                        'value' => 'interview',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.type.journalArticle',
                        'value' => 'journalArticle',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.type.letter',
                        'value' => 'letter',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.type.magazineArticle',
                        'value' => 'magazineArticle',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.type.manuscript',
                        'value' => 'manuscript',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.type.map',
                        'value' => 'map',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.type.newspaperArticle',
                        'value' => 'newspaperArticle',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.type.patent',
                        'value' => 'patent',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.type.podcast',
                        'value' => 'podcast',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.type.preprint',
                        'value' => 'preprint',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.type.presentation',
                        'value' => 'presentation',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.type.radioBroadcast',
                        'value' => 'radioBroadcast',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.type.report',
                        'value' => 'report',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.type.standard',
                        'value' => 'standard',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.type.statute',
                        'value' => 'statute',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.type.thesis',
                        'value' => 'thesis',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.type.tvBroadcast',
                        'value' => 'tvBroadcast',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.type.videoRecording',
                        'value' => 'videoRecording',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.type.webpage',
                        'value' => 'webpage',
                    ],
                ],
                'sortItems' => [
                    'label' => 'asc',
                ],
                'required' => true,
            ],
        ],
        'itemTitle' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.itemTitle',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.itemTitle.description',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
                'richtextConfiguration' => 'chf_bib_title',
            ],
        ],
        'standaloneTitle' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.standaloneTitle',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.standaloneTitle.description',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
                'richtextConfiguration' => 'chf_bib_title',
            ],
        ],
        'meetingTitle' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.meetingTitle',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.meetingTitle.description',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
                'richtextConfiguration' => 'chf_bib_title',
            ],
        ],
        'seriesTitle' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.seriesTitle',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.seriesTitle.description',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
                'richtextConfiguration' => 'chf_bib_title',
            ],
        ],
        'extent' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.extent',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.extent.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_extent',
                'foreign_field' => 'parent',
                'foreign_table_field' => 'parent_table',
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'bottom',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
                'overrideChildTca' => [
                    'columns' => [
                        'type' => [
                            'config' => [
                                'items' => [
                                    [
                                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.extent.type.url',
                                        'value' => 'url',
                                    ],
                                    [
                                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.extent.type.doi',
                                        'value' => 'doi',
                                    ],
                                    [
                                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.extent.type.urn',
                                        'value' => 'urn',
                                    ],
                                    [
                                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.extent.type.edition',
                                        'value' => 'edition',
                                    ],
                                    [
                                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.extent.type.version',
                                        'value' => 'version',
                                    ],
                                    [
                                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.extent.type.volume',
                                        'value' => 'volume',
                                    ],
                                    [
                                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.extent.type.issue',
                                        'value' => 'issue',
                                    ],
                                    [
                                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.extent.type.issn',
                                        'value' => 'issn',
                                    ],
                                    [
                                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.extent.type.isbn',
                                        'value' => 'isbn',
                                    ],
                                    [
                                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.extent.type.callNumber',
                                        'value' => 'callNumber',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'isHighlight' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.isHighlight',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.isHighlight.description',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        'label' => ''
                    ]
                ],
            ]
        ],
        'label' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.label',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.label.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectTree',
                'foreign_table' => 'tx_chfbase_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_tag}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_tag}.{#type}=\'labelTag\'',
                'MM' => 'tx_chfbib_domain_model_bibliographic_entry_tag_label_mm',
                'multiple' => 1,
                'treeConfig' => [
                    'parentField' => 'parentLabelTag',
                    'appearance' => [
                        'showHeader' => true,
                        'expandAll' => true,
                    ],
                ],
                'size' => 8,
            ],
        ],
        'sameAs' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.sameAs',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.sameAs.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_same_as',
                'foreign_field' => 'parent',
                'foreign_table_field' => 'parent_table',
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'bottom',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
            ],
        ],
        'authorshipRelation' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.authorshipRelation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.authorshipRelation.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_relation',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_relation}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_relation}.{#type}=\'authorshipRelation\'',
                'MM' => 'tx_chfbase_domain_model_relation_any_record_mm',
                'MM_opposite_field' => 'record',
                'multiple' => 1,
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'bottom',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
                'overrideChildTca' => [
                    'columns' => [
                        'type' => [
                            'config' => [
                                'default' => 'authorshipRelation',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'licenceRelation' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.licenceRelation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.licenceRelation.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_relation',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_relation}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_relation}.{#type}=\'licenceRelation\'',
                'MM' => 'tx_chfbase_domain_model_relation_any_record_mm',
                'MM_opposite_field' => 'record',
                'multiple' => 1,
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'bottom',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
                'overrideChildTca' => [
                    'columns' => [
                        'type' => [
                            'config' => [
                                'default' => 'licenceRelation',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'publicationDate' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.publicationDate',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.publicationDate.description',
            'config' => [
                'type' => 'datetime',
                'format' => 'date',
                'eval' => 'int',
                'default' => 0,
            ],
        ],
        'revisionNumber' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.revisionNumber',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.revisionNumber.description',
            'config' => [
                'type' => 'number',
                'size' => 13,
                'range' => [
                    'lower' => 1,
                ],
            ],
        ],
        'revisionDate' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.revisionDate',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.revisionDate.description',
            'config' => [
                'type' => 'datetime',
                'format' => 'date',
                'eval' => 'int',
                'default' => 0,
            ],
        ],
        'editorialNote' => [
            'exclude' => true,
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.editorialNote',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.editorialNote.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 5,
                'max' => 2000,
                'eval' => 'trim',
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'date' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.date',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.date.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_period',
                'foreign_field' => 'parent',
                'foreign_table_field' => 'parent_table',
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'bottom',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
                'maxitems' => 1,
            ],
        ],
        'lastChecked' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.lastChecked',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.lastChecked.description',
            'config' => [
                'type' => 'datetime',
                'format' => 'date',
                'eval' => 'int',
                'default' => 0,
            ],
        ],
        'locationRelation' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.locationRelation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.locationRelation.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_relation',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_relation}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_relation}.{#type}=\'locationRelation\'',
                'MM' => 'tx_chfbase_domain_model_relation_any_record_mm',
                'MM_opposite_field' => 'record',
                'multiple' => 1,
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'bottom',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
                'overrideChildTca' => [
                    'columns' => [
                        'type' => [
                            'config' => [
                                'default' => 'locationRelation',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'contentElement' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.contentElement',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.contentElement.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tt_content',
                'foreign_field' => 'parent',
                'foreign_table_field' => 'parent_table',
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'bottom',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
            ],
        ],
        'footnote' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.footnote',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.footnote.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_footnote',
                'foreign_field' => 'parent',
                'foreign_table_field' => 'parent_table',
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'bottom',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
            ],
        ],
        'media' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.media',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.media.description',
            'config' => [
                'type' => 'file',
                'allowed' => 'common-media-types',
            ],
        ],
        'file' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.file',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.file.description',
            'config' => [
                'type' => 'file',
                'allowed' => 'common-text-types',
            ],
        ],
        'linkRelation' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.linkRelation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.linkRelation.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_relation',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_relation}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_relation}.{#type}=\'linkRelation\'',
                'MM' => 'tx_chfbase_domain_model_relation_any_record_mm',
                'MM_opposite_field' => 'record',
                'multiple' => 1,
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'bottom',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
                'overrideChildTca' => [
                    'columns' => [
                        'type' => [
                            'config' => [
                                'default' => 'linkRelation',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'sourceRelation' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.abstractHeritage.sourceRelation',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.abstractHeritage.sourceRelation.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_relation',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_relation}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_relation}.{#type}=\'sourceRelation\'',
                'MM' => 'tx_chfbase_domain_model_relation_any_record_mm',
                'MM_opposite_field' => 'record',
                'multiple' => 1,
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'bottom',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
                'overrideChildTca' => [
                    'columns' => [
                        'type' => [
                            'config' => [
                                'default' => 'sourceRelation',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'importOrigin' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.importOrigin',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.importOrigin.description',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
            ],
        ],
        'import' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.import',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.import.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'max' => 100000,
                'eval' => 'trim',
            ],
        ],
        'asBibliographicEntryOfSourceRelation' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.asBibliographicEntryOfSourceRelation',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicEntry.asBibliographicEntryOfSourceRelation.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_chfbase_domain_model_relation',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_relation}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_relation}.{#type}=\'sourceRelation\'',
                'MM' => 'tx_chfbase_domain_model_relation_bibliographic_entry_bibentry_mm',
                'MM_opposite_field' => 'bibliographicEntry',
                'multiple' => 1,
                'size' => 5,
                'autoSizeMax' => 10,
            ],
        ],
    ],
    'palettes' => [
        'typeUuidIsHighlightLastChecked' => [
            'showitem' => 'type,uuid,--linebreak--,isHighlight,lastChecked,',
        ],
        'itemTitleStandaloneTitleMeetingTitleSeriesTitleExtent' => [
            'showitem' => 'itemTitle,standaloneTitle,--linebreak--,meetingTitle,seriesTitle,--linebreak--,extent,',
        ],
        'parentResourceLabel' => [
            'showitem' => 'parentResource,label,',
        ],
        'dateLocationRelation' => [
            'showitem' => 'date,--linebreak--,locationRelation,',
        ],
        'authorshipRelationLicenceRelation' => [
            'showitem' => 'authorshipRelation,--linebreak--,licenceRelation,',
        ],
        'publicationDateRevisionDateRevisionNumberEditorialNote' => [
            'showitem' => 'publicationDate,revisionDate,revisionNumber,--linebreak--,editorialNote,',
        ],
        'contentElementFootnote' => [
            'showitem' => 'contentElement,--linebreak--,footnote,',
        ],
        'mediaFile' => [
            'showitem' => 'media,--linebreak--,file,',
        ],
        'importOriginImport' => [
            'showitem' => 'importOrigin,--linebreak--,import,',
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => '--palette--;;typeUuidIsHighlightLastChecked,--palette--;;itemTitleStandaloneTitleMeetingTitleSeriesTitleExtent,--palette--;;parentResourceLabel,sameAs,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.editorial,--palette--;;authorshipRelationLicenceRelation,--palette--;;publicationDateRevisionDateRevisionNumberEditorialNote,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.content,--palette--;;dateLocationRelation,--palette--;;contentElementFootnote,--palette--;;mediaFile,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.relations,linkRelation,publicationRelation,sourceRelation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.import,--palette--;;importOriginImport,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.usage,asBibliographicEntryOfSourceRelation,',
        ],
    ],
];
