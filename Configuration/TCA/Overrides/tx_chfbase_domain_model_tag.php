<?php
declare(strict_types=1);

# This file is part of the extension CHF Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


defined('TYPO3') or die();

/**
 * LabelTag and its properties
 * 
 * Extension of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */

// Add column 'as_label_of_bibliographic_entry'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_chfbase_domain_model_tag',
    [
        'as_label_of_bibliographic_entry' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.labelTag.asLabelOfBibliographicEntry',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:object.labelTag.asLabelOfBibliographicEntry.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_chfbib_domain_model_bibliographic_entry',
                'foreign_table_where' => 'AND {#tx_chfbib_domain_model_bibliographic_entry}.{#pid}=###CURRENT_PID###',
                'MM' => 'tx_chfbib_domain_model_bibliographic_entry_tag_label_mm',
                'MM_opposite_field' => 'label',
                'multiple' => 1,
                'size' => 5,
                'autoSizeMax' => 10,
            ],
        ],
    ]
);
