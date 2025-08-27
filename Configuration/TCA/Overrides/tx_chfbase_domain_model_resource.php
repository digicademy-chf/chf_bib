<?php
declare(strict_types=1);

# This file is part of the extension CHF Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


defined('TYPO3') or die();

/**
 * BibliographicResource and its properties
 * 
 * Extension of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */

// Add select item 'bibliographicResource'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem('tx_chfbase_domain_model_resource', 'type',
    [
        'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicResource.type.bibliographicResource',
        'value' => 'bibliographicResource',
    ]
);

// Add type 'bibliographicResource' and its 'showitem' list
$GLOBALS['TCA']['tx_chfbase_domain_model_resource']['types'] += ['bibliographicResource' => [
    'showitem' => 'type,--palette--;;titleLangCode,description,glossary,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.structured,items,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.management,--palette--;;iriUuid,same_as,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.editorial,--palette--;;publicationDateRevisionDateRevisionNumber,editorial_note,authorship_relation,licence_relation,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.import,import_origin,import_state,',
]];

// Add opposite usage info to 'items' column
$GLOBALS['TCA']['tx_chfbase_domain_model_resource']['columns']['items']['config']['MM_oppositeUsage']['tx_chfbib_domain_model_bibliographicentry'] = ['parent_resource'];
