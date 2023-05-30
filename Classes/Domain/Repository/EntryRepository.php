<?php

declare(strict_types=1);

# This file is part of the extension DA Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DABib\Domain\Repository;

use Digicademy\DABib\Domain\Model\Entry;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository for bibliographic entries
 * 
 * @extends Repository<Entry>
 */
class EntryRepository extends Repository
{
    protected $defaultOrderings = [
        'itemTitle'       => QueryInterface::ORDER_ASCENDING,
        'pubicationTitle' => QueryInterface::ORDER_ASCENDING,
        'seriesTitle'     => QueryInterface::ORDER_ASCENDING,
        'meetingTitle'    => QueryInterface::ORDER_ASCENDING,
    ];
}

?>
