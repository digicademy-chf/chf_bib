<?php

declare(strict_types=1);

# This file is part of the extension DA Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DABib\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for contributors
 */
class Contributor extends AbstractEntity
{
    /**
     * Unique contributor identifier
     * 
     * @var string
     */
    protected $uuid;

    /**
     * Surname of the contributor
     * 
     * @var string
     */
    protected string $surname = '';

    /**
     * Forename of the contributor
     * 
     * @var string
     */
    protected string $forename = '';

    /**
     * Name of a corporate body (e.g., an organisation) used instead of forename and surname
     * 
     * @var string
     */
    protected string $corporateName = '';

    #[Lazy()]
    /**
     * Label to group the contributor into
     * 
     * @var ObjectStorage<Tag>
     */
    protected $label;

    #[Lazy()]
    #[Cascade('remove')]
    /**
     * External web address to identify the contributor across the web
     * 
     * @var ObjectStorage<SameAs>
     */
    protected $sameAs;

    /**
     * Initialize object
     *
     * @return Contributor
     */
    public function __construct()
    {
        $this->label  = new ObjectStorage();
        $this->sameAs = new ObjectStorage();
    }

    /**
     * Get UUID
     *
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * Set UUID
     *
     * @param string $uuid
     */
    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    /**
     * Get forename
     *
     * @return string
     */
    public function getForename(): string
    {
        return $this->forename;
    }

    /**
     * Set forename
     *
     * @param string $forename
     */
    public function setForename(string $forename): void
    {
        $this->forename = $forename;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * Set surname
     *
     * @param string $surname
     */
    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * Get corporate name
     *
     * @return string
     */
    public function getCorporateName(): string
    {
        return $this->corporateName;
    }

    /**
     * Set corporate name
     *
     * @param string $corporateName
     */
    public function setCorporateName(string $corporateName): void
    {
        $this->corporateName = $corporateName;
    }

    /**
     * Get label
     *
     * @return ObjectStorage|null
     */
    public function getLabel(): ?ObjectStorage
    {
        return $this->label;
    }

    /**
     * Set label
     *
     * @param ObjectStorage $label
     */
    public function setLabel($label): void
    {
        $this->label = $label;
    }

    /**
     * Add label
     *
     * @param Tag $label
     */
    public function addLabel(Tag $label): void
    {
        $this->label->attach($label);
    }

    /**
     * Remove label
     *
     * @param Tag $label
     */
    public function removeLabel(Tag $label): void
    {
        $this->label->detach($label);
    }

    /**
     * Get sameAs URI
     *
     * @return ObjectStorage|null
     */
    public function getSameAs(): ?ObjectStorage
    {
        return $this->sameAs;
    }

    /**
     * Set sameAs URI
     *
     * @param ObjectStorage $sameAs
     */
    public function setSameAs($sameAs): void
    {
        $this->sameAs = $sameAs;
    }

    /**
     * Add sameAs URI
     *
     * @param SameAs $sameAs
     */
    public function addSameAs(SameAs $sameAs): void
    {
        $this->sameAs->attach($sameAs);
    }

    /**
     * Remove sameAs URI
     *
     * @param SameAs $sameAs
     */
    public function removeSameAs(SameAs $sameAs): void
    {
        $this->sameAs->detach($sameAs);
    }
}

?>