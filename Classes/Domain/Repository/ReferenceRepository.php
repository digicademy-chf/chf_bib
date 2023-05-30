<?php

declare(strict_types=1);

# This file is part of the extension DA Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DABib\Domain\Repository;

use Digicademy\DABib\Domain\Model\Reference;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository to provide a reference to a bibliographic entry
 * 
 * @extends Repository<Reference>
 */
class ReferenceRepository extends Repository
{
    protected $defaultOrderings = [
        'elaboration' => QueryInterface::ORDER_ASCENDING,
        'entry'       => QueryInterface::ORDER_ASCENDING,
    ];
}

?>
