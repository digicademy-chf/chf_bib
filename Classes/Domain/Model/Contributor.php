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

defined('TYPO3') or die();

/**
 * Model to provide contributor data for bibliographic entries
 */
class Contributor extends AbstractEntity
{
    /**
     * Forename of the contributor
     * 
     * @var string
     */
    protected string $forename = '';

    /**
     * Surname of the contributor
     * 
     * @var string
     */
    protected string $surname = '';

    /**
     * Name of a corporate contributor
     * 
     * @var string
     */
    protected string $corporateName = '';

    #[Lazy()]
    /**
     * Tags that can be used to group contributors together
     * 
     * @var ObjectStorage<Tag>
     */
    protected $label;

    #[Lazy()]
    #[Cascade('remove')]
    /**
     * List of URIs describing the same entity
     * 
     * @var ObjectStorage<SameAs>
     */
    protected $sameAs;

    /**
     * Initialize labels and sameAs
     *
     * @return Contributor
     */
    public function __construct()
    {
        $this->label  = new ObjectStorage();
        $this->sameAs = new ObjectStorage();
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
    /*public function addLabel(Tag $label): void
    {
        $this->label->attach($label);
    }*/

    /**
     * Remove label
     *
     * @param Tag $label
     */
    /*public function removeLabel(Tag $label): void
    {
        $this->label->detach($label);
    }*/

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
    /*public function addSameAs(SameAs $sameAs): void
    {
        $this->sameAs->attach($sameAs);
    }*/

    /**
     * Remove sameAs URI
     *
     * @param SameAs $sameAs
     */
    /*public function removeSameAs(SameAs $sameAs): void
    {
        $this->sameAs->detach($sameAs);
    }*/
}

?>