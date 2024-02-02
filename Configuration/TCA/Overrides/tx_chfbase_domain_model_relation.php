<?php
defined('TYPO3') or die();

# This file is part of the extension CHF Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


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
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_chfbib_domain_model_bibliographic_entry',
                'foreign_table_where' => 'AND {#tx_chfbib_domain_model_bibliographic_entry}.{#pid}=###CURRENT_PID###',
                'MM' => 'tx_chfbib_domain_model_relation_bibliographicentry_bibliographicentry_mm',
                'MM_opposite_field' => 'asBibliographicEntryOfSourceRelation',
                'size' => 5,
                'autoSizeMax' => 10,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => false,
                    ],
                ],
                'required' => true,
            ],
        ],
        'elaborationType' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.sourceRelation.elaborationType',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.sourceRelation.elaborationType.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.sourceRelation.elaborationType.pageNumber',
                        'value' => 'pageNumbers',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.sourceRelation.elaborationType.paragraphNumber',
                        'value' => 'paragraphNumbers',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.sourceRelation.elaborationType.columnNumber',
                        'value' => 'columnNumbers',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.sourceRelation.elaborationType.chapterNumbers',
                        'value' => 'chapterNumbers',
                    ],
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
    ]
);

// Create palette 'elaborationTypeElaboration'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'tx_chfbase_domain_model_relation',
    'elaborationTypeElaboration',
    'elaborationType,elaboration,'
);

// Add type 'sourceRelation' and its 'showitem' list
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
   'tx_chfbase_domain_model_relation',
   'hiddenParentResource,uuidType,record,bibliographicEntry,elaborationTypeElaboration,description,'
   'sourceRelation'
);
