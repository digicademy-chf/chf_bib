<?php

declare(strict_types=1);

# This file is part of the extension CHF Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBib\Domain\Model;

use Digicademy\CHFBib\Domain\Validator\StringOptionsValidator;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for tags
 */
class Tag extends AbstractEntity
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
     * Bibliography that this tag is attached to
     * 
     * @var LazyLoadingProxy|BibliographicResource
     */
    #[Lazy()]
    protected LazyLoadingProxy|BibliographicResource $parent_id;

    /**
     * Unique identifier of the tag
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'RegularExpression',
        'options'   => [
            'regularExpression' => '^[0-9a-fA-F]{8}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{12}$',
            'errorMessage'      => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:validator.regularExpression.noUuid',
        ],
    ])]
    protected string $uuid = '';

    /**
     * Name of the tag
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'minimum' => 1,
            'maximum' => 255,
        ],
    ])]
    protected string $text = '';

    /**
     * Type of tag
     * 
     * @var string
     */
    #[Validate([
        'validator' => StringOptionsValidator::class,
        'options'   => [
            'allowed' => [
                'label',
            ],
        ],
    ])]
    protected string $type = '';

    /**
     * Brief information about the tag
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
     * External web address to identify the tag across the web
     * 
     * @var ObjectStorage<SameAs>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $sameAs;

    /**
     * List of entries that use this tag as a label
     * 
     * @var ObjectStorage<Entry>
     */
    #[Lazy()]
    protected ObjectStorage $asLabelOfEntry;

    /**
     * List of contributors that use this tag as a label
     * 
     * @var ObjectStorage<Contributor>
     */
    #[Lazy()]
    protected ObjectStorage $asLabelOfContributor;

    /**
     * List of References that use this tag as a label
     * 
     * @var ObjectStorage<Reference>
     */
    #[Lazy()]
    protected ObjectStorage $asLabelOfReference;

    /**
     * Construct object
     *
     * @param BibliographicResource $parent_id
     * @param string $uuid
     * @param string $text
     * @param string $type
     * @return Tag
     */
    public function __construct(BibliographicResource $parent_id, string $uuid, string $text, string $type)
    {
        $this->initializeObject();

        $this->setParentId($parent_id);
        $this->setUuid($uuid);
        $this->setText($text);
        $this->setType($type);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->sameAs               = new ObjectStorage();
        $this->asLabelOfEntry       = new ObjectStorage();
        $this->asLabelOfContributor = new ObjectStorage();
        $this->asLabelOfReference   = new ObjectStorage();
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
     * Get parent ID
     * 
     * @return BibliographicResource
     */
    public function getParentId(): BibliographicResource
    {
        if ($this->parent_id instanceof LazyLoadingProxy) {
            $this->parent_id->_loadRealInstance();
        }
        return $this->parent_id;
    }

    /**
     * Set parent ID
     * 
     * @param BibliographicResource $parent_id
     */
    public function setParentId(BibliographicResource $parent_id): void
    {
        $this->parent_id = $parent_id;
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
     * Get text
     *
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Set text
     *
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set type
     *
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
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
     * Get as label of entry
     *
     * @return ObjectStorage<Entry>
     */
    public function getAsLabelOfEntry(): ObjectStorage
    {
        return $this->asLabelOfEntry;
    }

    /**
     * Set as label of entry
     *
     * @param ObjectStorage<Entry> $asLabelOfEntry
     */
    public function setAsLabelOfEntry(ObjectStorage $asLabelOfEntry): void
    {
        $this->asLabelOfEntry = $asLabelOfEntry;
    }

    /**
     * Add as label of entry
     *
     * @param Entry $asLabelOfEntry
     */
    public function addAsLabelOfEntry(Entry $asLabelOfEntry): void
    {
        $this->asLabelOfEntry->attach($asLabelOfEntry);
    }

    /**
     * Remove as label of entry
     *
     * @param Entry $asLabelOfEntry
     */
    public function removeAsLabelOfEntry(Entry $asLabelOfEntry): void
    {
        $this->asLabelOfEntry->detach($asLabelOfEntry);
    }

    /**
     * Remove all as label of entries
     */
    public function removeAllAsLabelOfEntries(): void
    {
        $asLabelOfEntry = clone $this->asLabelOfEntry;
        $this->asLabelOfEntry->removeAll($asLabelOfEntry);
    }

    /**
     * Get as label of contributor
     *
     * @return ObjectStorage<Contributor>
     */
    public function getAsLabelOfContributor(): ObjectStorage
    {
        return $this->asLabelOfContributor;
    }

    /**
     * Set as label of contributor
     *
     * @param ObjectStorage<Contributor> $asLabelOfContributor
     */
    public function setAsLabelOfContributor(ObjectStorage $asLabelOfContributor): void
    {
        $this->asLabelOfContributor = $asLabelOfContributor;
    }

    /**
     * Add as label of contributor
     *
     * @param Contributor $asLabelOfContributor
     */
    public function addAsLabelOfContributor(Contributor $asLabelOfContributor): void
    {
        $this->asLabelOfContributor->attach($asLabelOfContributor);
    }

    /**
     * Remove as label of contributor
     *
     * @param Contributor $asLabelOfContributor
     */
    public function removeAsLabelOfContributor(Contributor $asLabelOfContributor): void
    {
        $this->asLabelOfContributor->detach($asLabelOfContributor);
    }

    /**
     * Remove all as label of contributors
     */
    public function removeAllAsLabelOfContributors(): void
    {
        $asLabelOfContributor = clone $this->asLabelOfContributor;
        $this->asLabelOfContributor->removeAll($asLabelOfContributor);
    }

    /**
     * Get as label of reference
     *
     * @return ObjectStorage<Reference>
     */
    public function getAsLabelOfReference(): ObjectStorage
    {
        return $this->asLabelOfReference;
    }

    /**
     * Set as label of reference
     *
     * @param ObjectStorage<Reference> $asLabelOfReference
     */
    public function setAsLabelOfReference(ObjectStorage $asLabelOfReference): void
    {
        $this->asLabelOfReference = $asLabelOfReference;
    }

    /**
     * Add as label of reference
     *
     * @param Reference $asLabelOfReference
     */
    public function addAsLabelOfReference(Reference $asLabelOfReference): void
    {
        $this->asLabelOfReference->attach($asLabelOfReference);
    }

    /**
     * Remove as label of reference
     *
     * @param Reference $asLabelOfReference
     */
    public function removeAsLabelOfReference(Reference $asLabelOfReference): void
    {
        $this->asLabelOfReference->detach($asLabelOfReference);
    }

    /**
     * Remove all as label of references
     */
    public function removeAllAsLabelOfReferences(): void
    {
        $asLabelOfReference = clone $this->asLabelOfReference;
        $this->asLabelOfReference->removeAll($asLabelOfReference);
    }
}

?>