<?php
declare(strict_types=1);

# This file is part of the extension CHF Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


defined('TYPO3') or die();

/**
 * SourceRelation and its properties
 * 
 * Extension of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */

// Add select item group 'chfBib'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItemGroup('tx_chfbase_domain_model_relation', 'type',
    'chfBib',
    'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.chfBib'
);

// Add select item 'sourceRelation'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem('tx_chfbase_domain_model_relation', 'type',
    [
        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.sourceRelation.type.sourceRelation',
        'value' => 'sourceRelation',
        'group' => 'chfBib',
    ]
);

// Add columns 'bibliographicEntry', 'elaborationType', and 'elaboration'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_chfbase_domain_model_relation',
    [
        'bibliographicEntry' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.sourceRelation.bibliographicEntry',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.sourceRelation.bibliographicEntry.description',
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
                'foreign_table_where' => 'AND {#tx_chfbib_domain_model_bibliographic_entry}.{#pid}=###CURRENT_PID###',
                'MM' => 'tx_chfbase_domain_model_relation_bibliographic_entry_bibentry_mm',
                'multiple' => 1,
                'sortItems' => [
                    'label' => 'asc',
                ],
                'required' => true,
            ],
        ],
        'elaboration' => [
            'exclude' => true,
            'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.sourceRelation.elaboration',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.sourceRelation.elaboration.description',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
                'required' => true,
            ],
        ],
        'elaborationType' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.sourceRelation.elaborationType',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.sourceRelation.elaborationType.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.sourceRelation.elaborationType.pageNumbers',
                        'value' => 'pageNumbers',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.sourceRelation.elaborationType.paragraphNumbers',
                        'value' => 'paragraphNumbers',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.sourceRelation.elaborationType.columnNumbers',
                        'value' => 'columnNumbers',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.sourceRelation.elaborationType.chapterNumbers',
                        'value' => 'chapterNumbers',
                    ],
                ],
                'default' => 'pageNumbers',
                'required' => true,
            ],
        ],
    ]
);

// Create palette 'elaborationElaborationType'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'tx_chfbase_domain_model_relation',
    'bibliographicEntryElaborationElaborationType',
    'bibliographicEntry,--linebreak--,elaboration,elaborationType,'
);

// Add type 'sourceRelation' and its 'showitem' list
$GLOBALS['TCA']['tx_chfbase_domain_model_relation']['types'] += ['sourceRelation' => [
    'showitem' => 'type,record,--palette--;;bibliographicEntryElaborationElaborationType,description,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.placement,parentResource,--palette--;;iriUuid,',
]];
