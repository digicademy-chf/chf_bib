<?php

declare(strict_types=1);

/*
 * This file is part of the extension DA Bib for TYPO3.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace Digicademy\DABib\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model to relate a contributor to a bibliographic entry
 */
class ContributorRelation extends AbstractEntity
{
    #[Lazy()]
    /**
     * Link to the contributor record
     * 
     * @var ObjectStorage<Contributor>
     */
    protected $contributor;

    /**
     * Type of contribution for the current entry
     * 
     * @var string
     */
    protected string $contributorRole = '';

    /**
     * Initialize contributor
     *
     * @return ContributorRelation
     */
    public function __construct()
    {
        $this->contributor = new ObjectStorage();
    }

    /**
     * Get contributor
     *
     * @return ObjectStorage|null
     */
    public function getContributor(): ?ObjectStorage
    {
        return $this->contributor;
    }

    /**
     * Set contributor
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $contributor
     */
    public function setContributor($contributor): void
    {
        $this->contributor = $contributor;
    }

    /**
     * Add contributor
     *
     * @param Contributor $contributor
     */
    /*public function addContributor(Contributor $contributor): void
    {
        $this->contributor->attach($contributor);
    }*/

    /**
     * Remove contributor
     *
     * @param Contributor $contributor
     */
    /*public function removeContributor(Contributor $contributor): void
    {
        $this->contributor->detach($contributor);
    }*/

    /**
     * Get contributor role
     *
     * @return string
     */
    public function getContributorRole(): string
    {
        return $this->contributorRole;
    }

    /**
     * Set contributor role
     *
     * @param string $contributorRole
     */
    public function setContributorRole(string $contributorRole): void
    {
        $this->contributorRole = $contributorRole;
    }
}

?>