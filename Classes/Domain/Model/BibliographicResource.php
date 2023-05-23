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
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model to provide generic tags that can group entities together
 */
class BibliographicResource extends AbstractEntity
{
    /**
     * Title of the bibliographic resource
     * 
     * @var string
     */
    protected string $title = '';

    /**
     * Description of the bibliographic resource
     * 
     * @var string
     */
    protected string $description = '';

    /**
     * URI of the bibliograhic resource
     * 
     * @var string
     */
    protected string $uri = '';

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
     * @return BibliographicResource
     */
    public function __construct()
    {
        $this->sameAs = new ObjectStorage();
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
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
     * Get URI
     *
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * Set URI
     *
     * @param string $uri
     */
    public function setUri(string $uri): void
    {
        $this->uri = $uri;
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