<?php

declare(strict_types=1);

# This file is part of the extension CHF Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBib\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for bibliographic resources
 */
class BibliographicResource extends AbstractEntity
{
    /**
     * Whether the record should be visisible or not
     * 
     * @var bool
     */
    #[Validate([
        'validator' => 'Boolean',
    ])]
    protected bool $hidden = false;

    /**
     * Name of the bibliography
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $title = '';

    /**
     * Language of the bibliography
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength', # Generic validator because there is no canonical list of allowed options to check against
        'options'   => [
            'minimum' => 1,
        ],
    ])]
    protected string $language = '';

    /**
     * Web address of a Zotero library, group, or collection that can be used to import data using a TYPO3 task
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'Url',
    ])]
    protected string $syncId = '';

    /**
     * Version number of the Zotero database during the last successful import (should not be changed manually)
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $syncState = '';

    /**
     * Brief information about the bibliography
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 2000,
        ],
    ])]
    protected string $description = '';

    /**
     * Web address of the bibliography
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'Url',
    ])]
    protected string $uri = '';

    /**
     * External web address to identify the bibliography across the web
     * 
     * @var ObjectStorage<SameAs>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $sameAs;

    /**
     * List of all entries in this bibliography
     * 
     * @var ObjectStorage<Entry>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $entry;

    /**
     * List of all contributors in this bibliography
     * 
     * @var ObjectStorage<Contributor>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $contributor;

    /**
     * List of all tags in this bibliography
     * 
     * @var ObjectStorage<Tag>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $tag;

    /**
     * Construct object
     *
     * @param string $language
     * @return BibliographicResource
     */
    public function __construct(string $language)
    {
        $this->initializeObject();

        $this->setLanguage($language);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->sameAs      = new ObjectStorage();
        $this->entry       = new ObjectStorage();
        $this->contributor = new ObjectStorage();
        $this->tag         = new ObjectStorage();
    }

    /**
     * Get hidden
     *
     * @return bool
     */
    public function getHidden(): bool
    {
        return $this->hidden;
    }

    /**
     * Set hidden
     *
     * @param bool $hidden
     */
    public function setHidden(bool $hidden): void
    {
        $this->hidden = $hidden;
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
     * Get language
     *
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * Set language
     *
     * @param string $language
     */
    public function setLanguage(string $language): void
    {
        $this->language = $language;
    }

    /**
     * Get sync ID
     *
     * @return string
     */
    public function getSyncId(): string
    {
        return $this->syncId;
    }

    /**
     * Set sync ID
     *
     * @param string $syncId
     */
    public function setSyncId(string $syncId): void
    {
        $this->language = $syncId;
    }

    /**
     * Get sync state
     *
     * @return string
     */
    public function getSyncState(): string
    {
        return $this->syncState;
    }

    /**
     * Set sync state
     *
     * @param string $syncState
     */
    public function setSyncState(string $syncState): void
    {
        $this->syncState = $syncState;
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
     * Get same as
     *
     * @return ObjectStorage<SameAs>
     */
    public function getSameAs(): ObjectStorage
    {
        return $this->sameAs;
    }

    /**
     * Set same as
     *
     * @param ObjectStorage<SameAs> $sameAs
     */
    public function setSameAs(ObjectStorage $sameAs): void
    {
        $this->sameAs = $sameAs;
    }

    /**
     * Add same as
     *
     * @param SameAs $sameAs
     */
    public function addSameAs(SameAs $sameAs): void
    {
        $this->sameAs->attach($sameAs);
    }

    /**
     * Remove same as
     *
     * @param SameAs $sameAs
     */
    public function removeSameAs(SameAs $sameAs): void
    {
        $this->sameAs->detach($sameAs);
    }

    /**
     * Remove all same as
     */
    public function removeAllSameAs(): void
    {
        $sameAs = clone $this->sameAs;
        $this->sameAs->removeAll($sameAs);
    }

    /**
     * Get entry
     *
     * @return ObjectStorage<Entry>
     */
    public function getEntry(): ObjectStorage
    {
        return $this->entry;
    }

    /**
     * Set entry
     *
     * @param ObjectStorage<Entry> $entry
     */
    public function setEntry(ObjectStorage $entry): void
    {
        $this->entry = $entry;
    }

    /**
     * Add entry
     *
     * @param Entry $entry
     */
    public function addEntry(Entry $entry): void
    {
        $this->entry->attach($entry);
    }

    /**
     * Remove entry
     *
     * @param Entry $entry
     */
    public function removeEntry(Entry $entry): void
    {
        $this->entry->detach($entry);
    }

    /**
     * Remove all entries
     */
    public function removeAllEntries(): void
    {
        $entry = clone $this->entry;
        $this->entry->removeAll($entry);
    }

    /**
     * Get contributor
     *
     * @return ObjectStorage<Contributor>
     */
    public function getContributor(): ObjectStorage
    {
        return $this->contributor;
    }

    /**
     * Set contributor
     *
     * @param ObjectStorage<Contributor> $contributor
     */
    public function setContributor(ObjectStorage $contributor): void
    {
        $this->contributor = $contributor;
    }

    /**
     * Add contributor
     *
     * @param Contributor $contributor
     */
    public function addContributor(Contributor $contributor): void
    {
        $this->contributor->attach($contributor);
    }

    /**
     * Remove contributor
     *
     * @param Contributor $contributor
     */
    public function removeContributor(Contributor $contributor): void
    {
        $this->contributor->detach($contributor);
    }

    /**
     * Remove all contributors
     */
    public function removeAllContributors(): void
    {
        $contributor = clone $this->contributor;
        $this->contributor->removeAll($contributor);
    }

    /**
     * Get tag
     *
     * @return ObjectStorage<Tag>
     */
    public function getTag(): ObjectStorage
    {
        return $this->tag;
    }

    /**
     * Set tag
     *
     * @param ObjectStorage<Tag> $tag
     */
    public function setTag(ObjectStorage $tag): void
    {
        $this->tag = $tag;
    }

    /**
     * Add tag
     *
     * @param Tag $tag
     */
    public function addTag(Tag $tag): void
    {
        $this->tag->attach($tag);
    }

    /**
     * Remove tag
     *
     * @param Tag $tag
     */
    public function removeTag(Tag $tag): void
    {
        $this->tag->detach($tag);
    }

    /**
     * Remove all tags
     */
    public function removeAllTags(): void
    {
        $tag = clone $this->tag;
        $this->tag->removeAll($tag);
    }
}

?>