<?php

declare(strict_types=1);

# This file is part of the extension DA Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DABib\Domain\Repository;

use Digicademy\DABib\Domain\Model\Scope;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository to provide scope (e.g. volume or issue) for bibliographic entries
 * 
 * @extends Repository<Scope>
 */
class ScopeRepository extends Repository
{
    protected $defaultOrderings = [
        'scope'     => QueryInterface::ORDER_ASCENDING,
        'scopeType' => QueryInterface::ORDER_ASCENDING,
    ];
}

?>
