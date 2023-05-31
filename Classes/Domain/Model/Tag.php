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
 * Model to provide generic tags that can group entities together
 */
class Tag extends AbstractEntity
{
    /**
     * Name of the tag
     * 
     * @var string
     */
    protected string $name = '';

    /**
     * Description of the tag
     * 
     * @var string
     */
    protected string $description = '';

    #[Lazy()]
    #[Cascade('remove')]
    /**
     * List of URIs describing the same entity
     * 
     * @var ObjectStorage<SameAs>
     */
    protected $sameAs;

    /**
     * Initialize sameAs
     *
     * @return Tag
     */
    public function __construct()
    {
        $this->sameAs = new ObjectStorage();
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
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