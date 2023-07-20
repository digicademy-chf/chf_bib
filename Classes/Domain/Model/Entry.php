<?php

declare(strict_types=1);

# This file is part of the extension DA Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DABib\Domain\Model;

use DateTime;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for entries
 */
class Entry extends AbstractEntity
{
    /**
     * Unique entry identifier
     * 
     * @var string
     */
    protected $uuid;

    /**
     * Approximate taxonomy of the bibliographic entry
     * 
     * @var string
     */
    protected string $type = '';

    #[Lazy()]
    /**
     * Label to group the entry into
     * 
     * @var ObjectStorage<Tag>
     */
    protected $label;

    /**
     * Identifier of the entry as you would use it in a bibliography
     * 
     * @var string
     */
    protected string $identifier = '';

    /**
     * Classification of the identifier, e.g., a DOI
     * 
     * @var string
     */
    protected string $identifierType = '';

    /**
     * External web address to identify an entry in Zotero
     * 
     * @var string
     */
    protected string $zoteroUri = '';

    #[Lazy()]
    #[Cascade('remove')]
    /**
     * External web address to identify the bibliographic entry across the web
     * 
     * @var ObjectStorage<SameAs>
     */
    protected $sameAs;

    /**
     * Title of the non-independent publication, e.g., a paper
     * 
     * @var string
     */
    protected string $itemTitle = '';

    /**
     * Title of the independent publication, e.g., a monograph
     * 
     * @var string
     */
    protected string $publicationTitle = '';

    /**
     * City or town where the publication was produced
     * 
     * @var string
     */
    protected string $publicationPlace = '';

    /**
     * Date when the publication was published
     * 
     * @var DateTime
     */
    protected $publicationDate;

    /**
     * Name of the publisher
     * 
     * @var string
     */
    protected string $publisher = '';

    #[Lazy()]
    /**
     * List all authors of the entry
     * 
     * @var ObjectStorage<Contributor>
     */
    protected $author;

    #[Lazy()]
    /**
     * List all editors of the entry
     * 
     * @var ObjectStorage<Contributor>
     */
    protected $editor;

    #[Lazy()]
    /**
     * List all translators of the entry
     * 
     * @var ObjectStorage<Contributor>
     */
    protected $translator;

    #[Lazy()]
    /**
     * List all further contributors of the entry
     * 
     * @var ObjectStorage<Contributor>
     */
    protected $genericContributor;

    #[Lazy()]
    #[Cascade('remove')]
    /**
     * Information on the specific edition of the publication
     * 
     * @var ObjectStorage<Scope>
     */
    protected $scope;

    /**
     * Extent of an item in the publication
     * 
     * @var string
     */
    protected string $extent = '';

    /**
     * Clarification of the type of extent, e.g., page numbers
     * 
     * @var string
     */
    protected string $extentType = '';

    /**
     * Name of a series this publication is part of
     * 
     * @var string
     */
    protected string $seriesTitle = '';

    /**
     * Name of the meeting the publication was presented at
     * 
     * @var string
     */
    protected string $meetingTitle = '';

    /**
     * Initialize object
     *
     * @return Entry
     */
    public function __construct()
    {
        $this->label              = new ObjectStorage();
        $this->sameAs             = new ObjectStorage();
        $this->author             = new ObjectStorage();
        $this->editor             = new ObjectStorage();
        $this->translator         = new ObjectStorage();
        $this->genericContributor = new ObjectStorage();
        $this->scope              = new ObjectStorage();
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
     * Get identifier
     *
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * Set identifier
     *
     * @param string $identifier
     */
    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }

    /**
     * Get identifier type
     *
     * @return string
     */
    public function getIdentifierType(): string
    {
        return $this->identifierType;
    }

    /**
     * Set identifier type
     *
     * @param string $identifierType
     */
    public function setIdentifierType(string $identifierType): void
    {
        $this->identifierType = $identifierType;
    }

    /**
     * Get Zotero URI
     *
     * @return string
     */
    public function getZoteroUri(): string
    {
        return $this->zoteroUri;
    }

    /**
     * Set Zotero URI
     *
     * @param string $zoteroUri
     */
    public function setZoteroUri(string $zoteroUri): void
    {
        $this->zoteroUri = $zoteroUri;
    }

    /**
     * Get same as
     *
     * @return ObjectStorage|null
     */
    public function getSameAs(): ?ObjectStorage
    {
        return $this->sameAs;
    }

    /**
     * Set same as
     *
     * @param ObjectStorage $sameAs
     */
    public function setSameAs($sameAs): void
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
     * Get item title
     *
     * @return string
     */
    public function getItemTitle(): string
    {
        return $this->itemTitle;
    }

    /**
     * Set item title
     *
     * @param string $itemTitle
     */
    public function setItemTitle(string $itemTitle): void
    {
        $this->itemTitle = $itemTitle;
    }

    /**
     * Get publication title
     *
     * @return string
     */
    public function getPublicationTitle(): string
    {
        return $this->publicationTitle;
    }

    /**
     * Set publication title
     *
     * @param string $publicationTitle
     */
    public function setPublicationTitle(string $publicationTitle): void
    {
        $this->publicationTitle = $publicationTitle;
    }

    /**
     * Get publication place
     *
     * @return string
     */
    public function getPublicationPlace(): string
    {
        return $this->publicationPlace;
    }

    /**
     * Set publication place
     *
     * @param string $publicationPlace
     */
    public function setPublicationPlace(string $publicationPlace): void
    {
        $this->publicationPlace = $publicationPlace;
    }

    /**
     * Get publication date
     *
     * @return DateTime
     */
    public function getPublicationDate(): DateTime
    {
        return $this->publicationDate;
    }

    /**
     * Set publication date
     *
     * @param DateTime $publicationDate
     */
    public function setPublicationDate(DateTime $publicationDate): void
    {
        $this->publicationDate = $publicationDate;
    }

    /**
     * Get publisher
     *
     * @return string
     */
    public function getPublisher(): string
    {
        return $this->publisher;
    }

    /**
     * Set publisher
     *
     * @param string $publisher
     */
    public function setPublisher(string $publisher): void
    {
        $this->publisher = $publisher;
    }

    /**
     * Get author
     *
     * @return ObjectStorage|null
     */
    public function getAuthor(): ?ObjectStorage
    {
        return $this->author;
    }

    /**
     * Set author
     *
     * @param ObjectStorage $author
     */
    public function setAuthor($author): void
    {
        $this->author = $author;
    }

    /**
     * Add author
     *
     * @param Contributor $author
     */
    public function addAuthor(Contributor $author): void
    {
        $this->author->attach($author);
    }

    /**
     * Remove author
     *
     * @param Contributor $author
     */
    public function removeAuthor(Contributor $author): void
    {
        $this->author->detach($author);
    }

    /**
     * Get editor
     *
     * @return ObjectStorage|null
     */
    public function getEditor(): ?ObjectStorage
    {
        return $this->editor;
    }

    /**
     * Set editor
     *
     * @param ObjectStorage $editor
     */
    public function setEditor($editor): void
    {
        $this->editor = $editor;
    }

    /**
     * Add editor
     *
     * @param Contributor $editor
     */
    public function addEditor(Contributor $editor): void
    {
        $this->editor->attach($editor);
    }

    /**
     * Remove editor
     *
     * @param Contributor $editor
     */
    public function removeEditor(Contributor $editor): void
    {
        $this->editor->detach($editor);
    }

    /**
     * Get translator
     *
     * @return ObjectStorage|null
     */
    public function getTranslator(): ?ObjectStorage
    {
        return $this->translator;
    }

    /**
     * Set translator
     *
     * @param ObjectStorage $translator
     */
    public function setTranslator($translator): void
    {
        $this->translator = $translator;
    }

    /**
     * Add translator
     *
     * @param Contributor $translator
     */
    public function addTranslator(Contributor $translator): void
    {
        $this->translator->attach($translator);
    }

    /**
     * Remove translator
     *
     * @param Contributor $translator
     */
    public function removeTranslator(Contributor $translator): void
    {
        $this->translator->detach($translator);
    }

    /**
     * Get generic contributor
     *
     * @return ObjectStorage|null
     */
    public function getGenericContributor(): ?ObjectStorage
    {
        return $this->genericContributor;
    }

    /**
     * Set generic contributor
     *
     * @param ObjectStorage $genericContributor
     */
    public function setGenericContributor($genericContributor): void
    {
        $this->genericContributor = $genericContributor;
    }

    /**
     * Add generic contributor
     *
     * @param Contributor $genericContributor
     */
    public function addGenericContributor(Contributor $genericContributor): void
    {
        $this->genericContributor->attach($genericContributor);
    }

    /**
     * Remove generic contributor
     *
     * @param Contributor $genericContributor
     */
    public function removeGenericContributor(Contributor $genericContributor): void
    {
        $this->genericContributor->detach($genericContributor);
    }

    /**
     * Get scope
     *
     * @return ObjectStorage|null
     */
    public function getScope(): ?ObjectStorage
    {
        return $this->scope;
    }

    /**
     * Set scope
     *
     * @param ObjectStorage $scope
     */
    public function setScope($scope): void
    {
        $this->scope = $scope;
    }

    /**
     * Add scope
     *
     * @param Scope $scope
     */
    public function addScope(Scope $scope): void
    {
        $this->scope->attach($scope);
    }

    /**
     * Remove scope
     *
     * @param Scope $scope
     */
    public function removeScope(Scope $scope): void
    {
        $this->scope->detach($scope);
    }

    /**
     * Get extent
     *
     * @return string
     */
    public function getExtent(): string
    {
        return $this->extent;
    }

    /**
     * Set extent
     *
     * @param string $extent
     */
    public function setExtent(string $extent): void
    {
        $this->extent = $extent;
    }

    /**
     * Get extent type
     *
     * @return string
     */
    public function getExtentType(): string
    {
        return $this->extentType;
    }

    /**
     * Set extent type
     *
     * @param string $extentType
     */
    public function setExtentType(string $extentType): void
    {
        $this->extentType = $extentType;
    }

    /**
     * Get series title
     *
     * @return string
     */
    public function getSeriesTitle(): string
    {
        return $this->seriesTitle;
    }

    /**
     * Set series title
     *
     * @param string $seriesTitle
     */
    public function setSeriesTitle(string $seriesTitle): void
    {
        $this->seriesTitle = $seriesTitle;
    }

    /**
     * Get meeting title
     *
     * @return string
     */
    public function getMeetingTitle(): string
    {
        return $this->meetingTitle;
    }

    /**
     * Set meeting title
     *
     * @param string $meetingTitle
     */
    public function setMeetingTitle(string $meetingTitle): void
    {
        $this->meetingTitle = $meetingTitle;
    }
}

?>