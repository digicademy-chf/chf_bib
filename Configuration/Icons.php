<?php
declare(strict_types=1);

# This file is part of the extension CHF Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


use TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider;
use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;

defined('TYPO3') or die();

// Extension-provided icons
return [
    'tx-chfbib' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_bib/Resources/Public/Icons/Extension.svg',
    ],
    'tx-chfbib-table-bibliographic-entry' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_bib/Resources/Public/Icons/TableBibliographicEntry.svg',
    ],
    'tx-chfbib-plugin-bibliography' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_bib/Resources/Public/Icons/PluginBibliography.svg',
    ],
];
