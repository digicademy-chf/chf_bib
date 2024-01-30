<?php
defined('TYPO3') or die();
declare(strict_types=1);

# This file is part of the extension CHF Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBib\Domain\Model;

use DateTime;
use Digicademy\CHFBase\Domain\Validator\StringOptionsValidator;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for entries
 */
class Entry extends AbstractEntity
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
     * Bibliography that this entry is attached to
     * 
     * @var LazyLoadingProxy|BibliographicResource
     */
    #[Lazy()]
    protected LazyLoadingProxy|BibliographicResource $parent_id;

    /**
     * Unique identifier of the entry
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
     * Approximate taxonomy of the bibliographic entry
     * 
     * @var string
     */
    #[Validate([
        'validator' => StringOptionsValidator::class,
        'options'   => [
            'allowed' => [
                'artwork',
                'audioRecording',
                'bill',
                'blogPost',
                'book',
                'bookSection',
                'case',
                'computerProgram',
                'conferencePaper',
                'dataset',
                'dictionaryEntry',
                'document',
                'email',
                'encyclopediaArticle',
                'film',
                'forumPost',
                'hearing',
                'instantMessage',
                'interview',
                'journalArticle',
                'letter',
                'magazineArticle',
                'manuscript',
                'map',
                'newspaperArticle',
                'patent',
                'podcast',
                'preprint',
                'presentation',
                'radioBroadcast',
                'report',
                'standard',
                'statute',
                'thesis',
                'tvBroadcast',
                'videoRecording',
                'webpage',
            ],
        ],
    ])]
    protected string $type = '';

    /**
     * Web address of a Zotero entry to be set and used during automated imports via a TYPO3 task
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'Url',
    ])]
    protected string $syncId = '';

    /**
     * Label to group the entry into
     * 
     * @var ObjectStorage<Tag>
     */
    #[Lazy()]
    protected ObjectStorage $label;

    /**
     * External web address to identify the bibliographic entry across the web
     * 
     * @var ObjectStorage<SameAs>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $sameAs;

    /**
     * Title of the non-independent publication, e.g., a paper
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'String',
    ])]
    protected string $itemTitle = '';

    /**
     * Title of the independent publication, e.g., a monograph
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'String',
    ])]
    protected string $publicationTitle = '';

    /**
     * City or town where the publication was produced
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $publicationPlace = '';

    /**
     * Approximate date when the publication was published, usually a year
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $publicationDateCirca = '';

    /**
     * Exact onset of the known period the publication was published in
     * 
     * @var DateTime|null
     */
    #[Validate([
        'validator' => 'DateTime',
    ])]
    protected ?DateTime $publicationDateStart = null;

    /**
     * Exact end of the known period the publication was published in
     * 
     * @var DateTime|null
     */
    #[Validate([
        'validator' => 'DateTime',
    ])]
    protected ?DateTime $publicationDateEnd = null;

    /**
     * Name of the publisher
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $publisher = '';

    /**
     * List all authors of the entry
     * 
     * @var ObjectStorage<Contributor>
     */
    #[Lazy()]
    protected ObjectStorage $author;

    /**
     * List all editors of the entry
     * 
     * @var ObjectStorage<Contributor>
     */
    #[Lazy()]
    protected ObjectStorage $editor;

    /**
     * List all translators of the entry
     * 
     * @var ObjectStorage<Contributor>
     */
    #[Lazy()]
    protected ObjectStorage $translator;

    /**
     * List all further contributors of the entry
     * 
     * @var ObjectStorage<Contributor>
     */
    #[Lazy()]
    protected ObjectStorage $genericContributor;

    /**
     * Information on the specific edition of the publication
     * 
     * @var ObjectStorage<Scope>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $scope;

    /**
     * Extent of an item in the publication
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $extent = '';

    /**
     * Clarification of the type of extent, e.g., page numbers
     * 
     * @var string
     */
    #[Validate([
        'validator' => StringOptionsValidator::class,
        'options'   => [
            'allowed' => [
                'pageNumbers',
                'paragraphNumbers',
                'columnNumbers',
                'chapterNumbers',
            ],
        ],
    ])]
    protected string $extentType = '';

    /**
     * Name of a series this publication is part of
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'String',
    ])]
    protected string $seriesTitle = '';

    /**
     * Name of the meeting the publication was presented at
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'String',
    ])]
    protected string $meetingTitle = '';

    /**
     * Brief information about the entry
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'String',
    ])]
    protected string $description = '';

    /**
     * Brief summary of the entry
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'String',
    ])]
    protected string $summary = '';

    /**
     * Images depicting the entry, such as a cover or a digitisation
     * 
     * @var ObjectStorage<FileReference>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $image;

    /**
     * Files that contains, for example, the content of the entry
     * 
     * @var ObjectStorage<FileReference>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $file;

    /**
     * Content of the file used to populate this record
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 100000,
        ],
    ])]
    protected string $import = '';

    /**
     * List of references that refer to this entry
     * 
     * @var ObjectStorage<Reference>
     */
    #[Lazy()]
    protected ObjectStorage $asEntryOfReference;

    /**
     * Construct object
     *
     * @param BibliographicResource $parent_id
     * @param string $uuid
     * @return Entry
     */
    public function __construct(BibliographicResource $parent_id, string $uuid)
    {
        $this->initializeObject();

        $this->setParentId($parent_id);
        $this->setUuid($uuid);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->label              = new ObjectStorage();
        $this->sameAs             = new ObjectStorage();
        $this->author             = new ObjectStorage();
        $this->editor             = new ObjectStorage();
        $this->translator         = new ObjectStorage();
        $this->genericContributor = new ObjectStorage();
        $this->scope              = new ObjectStorage();
        $this->image              = new ObjectStorage();
        $this->file               = new ObjectStorage();
        $this->asEntryOfReference = new ObjectStorage();
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
        $this->syncId = $syncId;
    }

    /**
     * Get label
     *
     * @return ObjectStorage<Tag>
     */
    public function getLabel(): ObjectStorage
    {
        return $this->label;
    }

    /**
     * Set label
     *
     * @param ObjectStorage<Tag> $label
     */
    public function setLabel(ObjectStorage $label): void
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
     * Remove all labels
     */
    public function removeAllLabels(): void
    {
        $label = clone $this->label;
        $this->label->removeAll($label);
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
     * Get publication date circa
     *
     * @return string
     */
    public function getPublicationDateCirca(): string
    {
        return $this->publicationDateCirca;
    }

    /**
     * Set publication date circa
     *
     * @param string $publicationDateCirca
     */
    public function setPublicationDateCirca(string $publicationDateCirca): void
    {
        $this->publicationDateCirca = $publicationDateCirca;
    }

    /**
     * Get publication date start
     *
     * @return DateTime
     */
    public function getPublicationDate(): DateTime
    {
        return $this->publicationDate;
    }

    /**
     * Set publication date start
     *
     * @param DateTime $publicationDateStart
     */
    public function setPublicationDateStart(DateTime $publicationDateStart): void
    {
        $this->publicationDateStart = $publicationDateStart;
    }

    /**
     * Get publication date end
     *
     * @return DateTime
     */
    public function getPublicationDateEnd(): DateTime
    {
        return $this->publicationDateEnd;
    }

    /**
     * Set publication date end
     *
     * @param DateTime $publicationDateEnd
     */
    public function setPublicationDateEnd(DateTime $publicationDateEnd): void
    {
        $this->publicationDateEnd = $publicationDateEnd;
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
     * @return ObjectStorage<Contributor>
     */
    public function getAuthor(): ObjectStorage
    {
        return $this->author;
    }

    /**
     * Set author
     *
     * @param ObjectStorage<Contributor> $author
     */
    public function setAuthor(ObjectStorage $author): void
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
     * Remove all authors
     */
    public function removeAllAuthors(): void
    {
        $author = clone $this->author;
        $this->author->removeAll($author);
    }

    /**
     * Get editor
     *
     * @return ObjectStorage<Contributor>
     */
    public function getEditor(): ObjectStorage
    {
        return $this->editor;
    }

    /**
     * Set editor
     *
     * @param ObjectStorage<Contributor> $editor
     */
    public function setEditor(ObjectStorage $editor): void
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
     * Remove all editors
     */
    public function removeAllEditors(): void
    {
        $editor = clone $this->editor;
        $this->editor->removeAll($editor);
    }

    /**
     * Get translator
     *
     * @return ObjectStorage<Contributor>
     */
    public function getTranslator(): ObjectStorage
    {
        return $this->translator;
    }

    /**
     * Set translator
     *
     * @param ObjectStorage<Contributor> $translator
     */
    public function setTranslator(ObjectStorage $translator): void
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
     * Remove all translators
     */
    public function removeAllTranslators(): void
    {
        $translator = clone $this->translator;
        $this->translator->removeAll($translator);
    }

    /**
     * Get generic contributor
     *
     * @return ObjectStorage<Contributor>
     */
    public function getGenericContributor(): ObjectStorage
    {
        return $this->genericContributor;
    }

    /**
     * Set generic contributor
     *
     * @param ObjectStorage<Contributor> $genericContributor
     */
    public function setGenericContributor(ObjectStorage $genericContributor): void
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
     * Remove all generic contributors
     */
    public function removeAllGenericContributors(): void
    {
        $genericContributor = clone $this->genericContributor;
        $this->genericContributor->removeAll($genericContributor);
    }

    /**
     * Get scope
     *
     * @return ObjectStorage<Scope>
     */
    public function getScope(): ObjectStorage
    {
        return $this->scope;
    }

    /**
     * Set scope
     *
     * @param ObjectStorage<Scope> $scope
     */
    public function setScope(ObjectStorage $scope): void
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
     * Remove all scopes
     */
    public function removeAllScopes(): void
    {
        $scope = clone $this->scope;
        $this->scope->removeAll($scope);
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
     * Get summary
     *
     * @return string
     */
    public function getSummary(): string
    {
        return $this->summary;
    }

    /**
     * Set summary
     *
     * @param string $summary
     */
    public function setSummary(string $summary): void
    {
        $this->summary = $summary;
    }

    /**
     * Get image
     *
     * @return ObjectStorage<FileReference>
     */
    public function getImage(): ObjectStorage
    {
        return $this->image;
    }

    /**
     * Set image
     *
     * @param ObjectStorage<FileReference> $image
     */
    public function setImage(ObjectStorage $image): void
    {
        $this->image = $image;
    }

    /**
     * Add image
     *
     * @param FileReference $image
     */
    public function addImage(FileReference $image): void
    {
        $this->image->attach($image);
    }

    /**
     * Remove image
     *
     * @param FileReference $image
     */
    public function removeImage(FileReference $image): void
    {
        $this->image->detach($image);
    }

    /**
     * Remove all images
     */
    public function removeAllImages(): void
    {
        $image = clone $this->image;
        $this->image->removeAll($image);
    }

    /**
     * Get file
     *
     * @return ObjectStorage<FileReference>
     */
    public function getFile(): ObjectStorage
    {
        return $this->file;
    }

    /**
     * Set file
     *
     * @param ObjectStorage<FileReference> $file
     */
    public function setFile(ObjectStorage $file): void
    {
        $this->file = $file;
    }

    /**
     * Add file
     *
     * @param FileReference $file
     */
    public function addFile(FileReference $file): void
    {
        $this->file->attach($file);
    }

    /**
     * Remove file
     *
     * @param FileReference $file
     */
    public function removeFile(FileReference $file): void
    {
        $this->file->detach($file);
    }

    /**
     * Remove all files
     */
    public function removeAllFiles(): void
    {
        $file = clone $this->file;
        $this->file->removeAll($file);
    }

    /**
     * Get import
     *
     * @return string
     */
    public function getImport(): string
    {
        return $this->import;
    }

    /**
     * Set import
     *
     * @param string $import
     */
    public function setImport(string $import): void
    {
        $this->import = $import;
    }

    /**
     * Get as entry of reference
     *
     * @return ObjectStorage<Reference>
     */
    public function getAsEntryOfReference(): ObjectStorage
    {
        return $this->asEntryOfReference;
    }

    /**
     * Set as entry of reference
     *
     * @param ObjectStorage<Reference> $asEntryOfReference
     */
    public function setAsEntryOfReference(ObjectStorage $asEntryOfReference): void
    {
        $this->asEntryOfReference = $asEntryOfReference;
    }

    /**
     * Add as entry of reference
     *
     * @param Reference $asEntryOfReference
     */
    public function addAsEntryOfReference(Reference $asEntryOfReference): void
    {
        $this->asEntryOfReference->attach($asEntryOfReference);
    }

    /**
     * Remove as entry of reference
     *
     * @param Reference $asEntryOfReference
     */
    public function removeAsEntryOfReference(Reference $asEntryOfReference): void
    {
        $this->asEntryOfReference->detach($asEntryOfReference);
    }

    /**
     * Remove all as entry of references
     */
    public function removeAllAsEntryOfReferences(): void
    {
        $asEntryOfReference = clone $this->asEntryOfReference;
        $this->asEntryOfReference->removeAll($asEntryOfReference);
    }
}
