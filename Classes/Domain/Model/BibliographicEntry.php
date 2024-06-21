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
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Digicademy\CHFBase\Domain\Model\AbstractHeritage;
use Digicademy\CHFBase\Domain\Model\Extent;
use Digicademy\CHFBase\Domain\Model\LocationRelation;
use Digicademy\CHFBase\Domain\Model\Period;
use Digicademy\CHFBase\Domain\Validator\StringOptionsValidator;

defined('TYPO3') or die();

/**
 * Model for BibliographicEntry
 */
class BibliographicEntry extends AbstractHeritage
{
    /**
     * Approximate taxonomy of the bibliographic entry (may be relevant in some citation styles)
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
     * Title of a non-independent publication, e.g., a paper
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
    protected string $standaloneTitle = '';

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
     * Name of a series this publication is part of
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'String',
    ])]
    protected string $seriesTitle = '';

    /**
     * List of extents and identifiers relevant to this entry
     * 
     * @var ?ObjectStorage<Extent>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $extent = null;

    /**
     * Date when the publication was published, usually a year or a day
     * 
     * @var Period|LazyLoadingProxy|null
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected Period|LazyLoadingProxy|null $date = null;

    /**
     * Date when the source was last checked (relevant for web publications in some citation styles)
     * 
     * @var ?\DateTime
     */
    protected ?\DateTime $lastChecked = null;

    /**
     * Location of this database record described by a relation
     * 
     * @var ?ObjectStorage<LocationRelation>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $locationRelation = null;

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
     * @param object $parentResource
     * @param string $uuid
     * @param string $type
     * @return BibliographicEntry
     */
    public function __construct(object $parentResource, string $uuid, string $type)
    {
        parent::__construct($parentResource, $uuid);
        $this->initializeObject();

        $this->setType($type);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->extent ??= new ObjectStorage();
        $this->locationRelation ??= new ObjectStorage();
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
     * Get date
     * 
     * @return Period
     */
    public function getDate(): Period
    {
        if ($this->date instanceof LazyLoadingProxy) {
            $this->date->_loadRealInstance();
        }
        return $this->date;
    }

    /**
     * Set date
     * 
     * @param Period
     */
    public function setDate(Period $date): void
    {
        $this->date = $date;
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
     * Get location relation
     *
     * @return ObjectStorage<LocationRelation>
     */
    public function getLocationRelation(): ?ObjectStorage
    {
        return $this->locationRelation;
    }

    /**
     * Set location relation
     *
     * @param ObjectStorage<LocationRelation> $locationRelation
     */
    public function setLocationRelation(ObjectStorage $locationRelation): void
    {
        $this->locationRelation = $locationRelation;
    }

    /**
     * Add location relation
     *
     * @param LocationRelation $locationRelation
     */
    public function addLocationRelation(LocationRelation $locationRelation): void
    {
        $this->locationRelation?->attach($locationRelation);
    }

    /**
     * Remove location relation
     *
     * @param LocationRelation $locationRelation
     */
    public function removeLocationRelation(LocationRelation $locationRelation): void
    {
        $this->locationRelation?->detach($locationRelation);
    }

    /**
     * Remove all location relations
     */
    public function removeAllLocationRelation(): void
    {
        $locationRelation = clone $this->locationRelation;
        $this->locationRelation->removeAll($locationRelation);
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
