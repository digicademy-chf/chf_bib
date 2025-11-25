<?php
declare(strict_types=1);

# This file is part of the extension CHF Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


defined('TYPO3') or die();

/**
 * Extent and its properties
 * 
 * Extension of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */

// Add select item group 'chfBib'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItemGroup('tx_chfbase_domain_model_extent', 'type',
    'chfBib',
    'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.chfBib'
);

// Add select item 'sourceUrl'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem('tx_chfbase_domain_model_extent', 'type',
    [
        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.extent.type.sourceUrl',
        'value' => 'sourceUrl',
        'group' => 'chfBib',
    ]
);

// Add select item 'sourceDoi'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem('tx_chfbase_domain_model_extent', 'type',
    [
        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.extent.type.sourceDoi',
        'value' => 'sourceDoi',
        'group' => 'chfBib',
    ]
);

// Add select item 'sourceUrn'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem('tx_chfbase_domain_model_extent', 'type',
    [
        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.extent.type.sourceUrn',
        'value' => 'sourceUrn',
        'group' => 'chfBib',
    ]
);

// Add select item 'sourceIssn'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem('tx_chfbase_domain_model_extent', 'type',
    [
        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.extent.type.sourceIssn',
        'value' => 'sourceIssn',
        'group' => 'chfBib',
    ]
);

// Add select item 'sourceIsbn'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem('tx_chfbase_domain_model_extent', 'type',
    [
        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.extent.type.sourceIsbn',
        'value' => 'sourceIsbn',
        'group' => 'chfBib',
    ]
);

// Add select item 'sourceEdition'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem('tx_chfbase_domain_model_extent', 'type',
    [
        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.extent.type.sourceEdition',
        'value' => 'sourceEdition',
        'group' => 'chfBib',
    ]
);

// Add select item 'sourceVersion'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem('tx_chfbase_domain_model_extent', 'type',
    [
        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.extent.type.sourceVersion',
        'value' => 'sourceVersion',
        'group' => 'chfBib',
    ]
);

// Add select item 'sourceVolume'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem('tx_chfbase_domain_model_extent', 'type',
    [
        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.extent.type.sourceVolume',
        'value' => 'sourceVolume',
        'group' => 'chfBib',
    ]
);

// Add select item 'sourceIssue'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem('tx_chfbase_domain_model_extent', 'type',
    [
        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.extent.type.sourceIssue',
        'value' => 'sourceIssue',
        'group' => 'chfBib',
    ]
);

// Add select item 'sourcePageNumbers'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem('tx_chfbase_domain_model_extent', 'type',
    [
        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.extent.type.sourcePageNumbers',
        'value' => 'sourcePageNumbers',
        'group' => 'chfBib',
    ]
);

// Add select item 'sourceParagraphNumbers'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem('tx_chfbase_domain_model_extent', 'type',
    [
        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.extent.type.sourceParagraphNumbers',
        'value' => 'sourceParagraphNumbers',
        'group' => 'chfBib',
    ]
);

// Add select item 'sourceColumnNumbers'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem('tx_chfbase_domain_model_extent', 'type',
    [
        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.extent.type.sourceColumnNumbers',
        'value' => 'sourceColumnNumbers',
        'group' => 'chfBib',
    ]
);

// Add select item 'sourceChapterNumbers'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem('tx_chfbase_domain_model_extent', 'type',
    [
        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.extent.type.sourceChapterNumbers',
        'value' => 'sourceChapterNumbers',
        'group' => 'chfBib',
    ]
);
