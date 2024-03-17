<?php
defined('TYPO3') or die();
declare(strict_types=1);

# This file is part of the extension CHF Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBib\Domain\Repository;

use Digicademy\CHFBib\Domain\Model\BibliographicEntry;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository for BibliographicEntry
 * 
 * @extends Repository<BibliographicEntry>
 */
class BibliographicEntryRepository extends Repository
{
    protected $defaultOrderings = [
        'sorting'         => QueryInterface::ORDER_ASCENDING,
        'isHighlight'     => QueryInterface::ORDER_ASCENDING,
        'itemTitle'       => QueryInterface::ORDER_ASCENDING,
        'standaloneTitle' => QueryInterface::ORDER_ASCENDING,
        'meetingTitle'    => QueryInterface::ORDER_ASCENDING,
        'seriesTitle'     => QueryInterface::ORDER_ASCENDING,
    ];
}
