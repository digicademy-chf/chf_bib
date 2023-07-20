<?php

declare(strict_types=1);

# This file is part of the extension DA Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DABib\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Model for scopes
 */
class Scope extends AbstractEntity
{
    /**
     * Specific denotation of an edition, e.g., volume, issue, or another number
     * 
     * @var string
     */
    protected string $scope = '';

    /**
     * Type of edition denotation
     * 
     * @var string
     */
    protected string $scopeType = '';

    /**
     * Get scope
     *
     * @return string
     */
    public function getScope(): string
    {
        return $this->scope;
    }

    /**
     * Set scope
     *
     * @param string $scope
     */
    public function setScope(string $scope): void
    {
        $this->scope = $scope;
    }

    /**
     * Get scope type
     *
     * @return string
     */
    public function getScopeType(): string
    {
        return $this->scopeType;
    }

    /**
     * Set scope type
     *
     * @param string $scopeType
     */
    public function setScopeType(string $scopeType): void
    {
        $this->scopeType = $scopeType;
    }
}

?>