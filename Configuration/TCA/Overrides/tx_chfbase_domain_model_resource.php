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

// Add column 'allBibliographicEntries'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_chfbase_domain_model_resource',
    [
        'allBibliographicEntries' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicResource.allBibliographicEntries',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.bibliographicResource.allBibliographicEntries.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbib_domain_model_bibliographic_entry',
                'foreign_field' => 'parentResource',
                'foreign_sortby' => 'sorting',
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'bottom',
                    'useSortable' => false,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
            ],
        ],
    ]
);

// Add type 'bibliographicResource' and its 'showitem' list
$GLOBALS['TCA']['tx_chfbase_domain_model_resource']['types'] += ['bibliographicResource' => [
    'showitem' => '--palette--;;typeUuid,--palette--;;titleLangCodeDescriptionGlossary,sameAs,
   --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.structured,allBibliographicEntries,allAgents,allLocations,allPeriods,allTags,allKeywords,allRelations,allFileGroups,
   --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.editorial,--palette--;;authorshipRelationLicenceRelation,--palette--;;publicationDateRevisionDateRevisionNumberEditorialNote,
   --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.import,--palette--;;importOriginImportState,',
]];
