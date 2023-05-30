<?php

declare(strict_types=1);

# This file is part of the extension DA Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DABib\Domain\Repository;

use Digicademy\DABib\Domain\Model\Contributor;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository to provide contributor data for bibliographic entries
 * 
 * @extends Repository<Contributor>
 */
class ContributorRepository extends Repository
{
    protected $defaultOrderings = [
        'surname'       => QueryInterface::ORDER_ASCENDING,
        'forename'      => QueryInterface::ORDER_ASCENDING,
        'corporateName' => QueryInterface::ORDER_ASCENDING,
    ];
}

?>
