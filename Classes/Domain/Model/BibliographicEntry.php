<?php
declare(strict_types=1);

# This file is part of the extension CHF Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBib\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Digicademy\CHFBase\Domain\Model\AbstractHeritage;
use Digicademy\CHFBase\Domain\Model\Extent;
use Digicademy\CHFBase\Domain\Validator\StringOptionsValidator;

defined('TYPO3') or die();

/**
 * Model for BibliographicEntry
 */
class BibliographicEntry extends AbstractHeritage
{
    /**
     * Approximate taxonomy of the entry
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
    protected string $type = 'book';

    /**
     * Date when the source was last checked
     * 
     * @var ?\DateTime
     */
    protected ?\DateTime $lastChecked = null;

    /**
     * Title of a non-independent publication, e.g., a paper
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options' => [
            'maximum' => 255,
        ],
    ])]
    protected string $itemTitle = '';

    /**
     * Title of the independent publication, e.g., a monograph
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options' => [
            'maximum' => 255,
        ],
    ])]
    protected string $standaloneTitle = '';

    /**
     * Name of the meeting the publication was presented at
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options' => [
            'maximum' => 255,
        ],
    ])]
    protected string $meetingTitle = '';

    /**
     * Name of a series this publication is part of
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options' => [
            'maximum' => 255,
        ],
    ])]
    protected string $seriesTitle = '';

    /**
     * Date when the publication was published
     * 
     * @var ?\DateTime
     */
    protected ?\DateTime $date = null;

    /**
     * Non-standard publication date
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options' => [
            'maximum' => 255,
        ],
    ])]
    protected string $dateText = '';

    /**
     * Publication location
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options' => [
            'maximum' => 255,
        ],
    ])]
    protected string $place = '';

    /**
     * List of extents relevant to this entry<
     * 
     * @var ?ObjectStorage<Extent>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $extent = null;

    /**
     * List of source relations that use this bibliographic entry
     * 
     * @var ?ObjectStorage<SourceRelation>
     */
    #[Lazy()]
    protected ?ObjectStorage $asBibliographicEntryOfSourceRelation = null;

    /**
     * Construct object
     *
     * @param BibliographicResource $parentResource
     * @param string $iri
     * @param string $uuid
     * @return BibliographicEntry
     */
    public function __construct(BibliographicResource $parentResource, string $iri, string $uuid)
    {
        parent::__construct($parentResource, $iri, $uuid);
        $this->initializeObject();
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->extent ??= new ObjectStorage();
        $this->asBibliographicEntryOfSourceRelation ??= new ObjectStorage();
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
     * Get last checked
     *
     * @return ?\DateTime
     */
    public function getLastChecked(): ?\DateTime
    {
        return $this->lastChecked;
    }

    /**
     * Set last checked
     *
     * @param \DateTime $lastChecked
     */
    public function setLastChecked(\DateTime $lastChecked): void
    {
        $this->lastChecked = $lastChecked;
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
     * Get standalone title
     *
     * @return string
     */
    public function getStandaloneTitle(): string
    {
        return $this->standaloneTitle;
    }

    /**
     * Set standalone title
     *
     * @param string $standaloneTitle
     */
    public function setStandaloneTitle(string $standaloneTitle): void
    {
        $this->standaloneTitle = $standaloneTitle;
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
     * Get date
     *
     * @return ?\DateTime
     */
    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * Get date text
     *
     * @return string
     */
    public function getDateText(): string
    {
        return $this->dateText;
    }

    /**
     * Set date text
     *
     * @param string $dateText
     */
    public function setDateText(string $dateText): void
    {
        $this->dateText = $dateText;
    }

    /**
     * Get place
     *
     * @return string
     */
    public function getPlace(): string
    {
        return $this->place;
    }

    /**
     * Set place
     *
     * @param string $place
     */
    public function setPlace(string $place): void
    {
        $this->place = $place;
    }

    /**
     * Get extent
     *
     * @return ObjectStorage<Extent>
     */
    public function getExtent(): ?ObjectStorage
    {
        return $this->extent;
    }

    /**
     * Set extent
     *
     * @param ObjectStorage<Extent> $extent
     */
    public function setExtent(ObjectStorage $extent): void
    {
        $this->extent = $extent;
    }

    /**
     * Add extent
     *
     * @param Extent $extent
     */
    public function addExtent(Extent $extent): void
    {
        $this->extent?->attach($extent);
    }

    /**
     * Remove extent
     *
     * @param Extent $extent
     */
    public function removeExtent(Extent $extent): void
    {
        $this->extent?->detach($extent);
    }

    /**
     * Remove all extents
     */
    public function removeAllExtent(): void
    {
        $extent = clone $this->extent;
        $this->extent->removeAll($extent);
    }

    /**
     * Get as bibliographic entry of source relation
     *
     * @return ObjectStorage<SourceRelation>
     */
    public function getAsBibliographicEntryOfSourceRelation(): ?ObjectStorage
    {
        return $this->asBibliographicEntryOfSourceRelation;
    }

    /**
     * Set as bibliographic entry of source relation
     *
     * @param ObjectStorage<SourceRelation> $asBibliographicEntryOfSourceRelation
     */
    public function setAsBibliographicEntryOfSourceRelation(ObjectStorage $asBibliographicEntryOfSourceRelation): void
    {
        $this->asBibliographicEntryOfSourceRelation = $asBibliographicEntryOfSourceRelation;
    }

    /**
     * Add as bibliographic entry of source relation
     *
     * @param SourceRelation $asBibliographicEntryOfSourceRelation
     */
    public function addAsBibliographicEntryOfSourceRelation(SourceRelation $asBibliographicEntryOfSourceRelation): void
    {
        $this->asBibliographicEntryOfSourceRelation?->attach($asBibliographicEntryOfSourceRelation);
    }

    /**
     * Remove as bibliographic entry of source relation
     *
     * @param SourceRelation $asBibliographicEntryOfSourceRelation
     */
    public function removeAsBibliographicEntryOfSourceRelation(SourceRelation $asBibliographicEntryOfSourceRelation): void
    {
        $this->asBibliographicEntryOfSourceRelation?->detach($asBibliographicEntryOfSourceRelation);
    }

    /**
     * Remove all as bibliographic entry of source relations
     */
    public function removeAllAsBibliographicEntryOfSourceRelation(): void
    {
        $asBibliographicEntryOfSourceRelation = clone $this->asBibliographicEntryOfSourceRelation;
        $this->asBibliographicEntryOfSourceRelation->removeAll($asBibliographicEntryOfSourceRelation);
    }
}
