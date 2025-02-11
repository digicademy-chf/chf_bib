<?php
declare(strict_types=1);

# This file is part of the extension CHF Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBib\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Digicademy\CHFBase\Domain\Model\AbstractRelation;
use Digicademy\CHFBase\Domain\Validator\StringOptionsValidator;

use Digicademy\CHFBase\Domain\Model\Agent;
use Digicademy\CHFBase\Domain\Model\Location;
use Digicademy\CHFBase\Domain\Model\Period;
use Digicademy\CHFGloss\Domain\Model\GlossaryResource;
use Digicademy\CHFLex\Domain\Model\DictionaryEntry;
use Digicademy\CHFLex\Domain\Model\EncyclopediaEntry;
use Digicademy\CHFLex\Domain\Model\Example;
use Digicademy\CHFLex\Domain\Model\Frequency;
use Digicademy\CHFLex\Domain\Model\LexicographicResource;
use Digicademy\CHFMap\Domain\Model\Feature;
use Digicademy\CHFMap\Domain\Model\MapResource;
use Digicademy\CHFMedia\Domain\Model\FileGroup;
use Digicademy\CHFObject\Domain\Model\ObjectGroup;
use Digicademy\CHFObject\Domain\Model\ObjectResource;
use Digicademy\CHFObject\Domain\Model\SingleObject;
use Digicademy\CHFPub\Domain\Model\Essay;
use Digicademy\CHFPub\Domain\Model\PublicationResource;
use Digicademy\CHFPub\Domain\Model\Volume;

defined('TYPO3') or die();

/**
 * Model for SourceRelation
 */
class SourceRelation extends AbstractRelation
{
    /**
     * Record to connect a relation to
     * 
     * @var Agent|Location|Period|BibliographicEntry|DictionaryEntry|EncyclopediaEntry|Example|Frequency|Feature|FileGroup|SingleObject|ObjectGroup|Essay|Volume|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected Agent|Location|Period|BibliographicEntry|DictionaryEntry|EncyclopediaEntry|Example|Frequency|Feature|FileGroup|SingleObject|ObjectGroup|Essay|Volume|null $record = null;

    /**
     * Bibliographic entry to relate to the record
     * 
     * @var ?ObjectStorage<BibliographicEntry>
     */
    #[Lazy()]
    protected ?ObjectStorage $bibliographicEntry;

    /**
     * Detailed reference, e.g., a page number without "p." or "pp."
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options' => [
            'maximum' => 255,
        ],
    ])]
    protected string $elaboration = '';

    /**
     * Type of detailed reference
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
    protected string|null $elaborationType = null;

    /**
     * Construct object
     *
     * @param Agent|Location|Period|BibliographicEntry|DictionaryEntry|EncyclopediaEntry|Example|Frequency|Feature|FileGroup|SingleObject|ObjectGroup|Essay|Volume $record
     * @param BibliographicEntry $bibliographicEntry
     * @param BibliographicResource|GlossaryResource|LexicographicResource|MapResource|ObjectResource|PublicationResource $parentResource
     * @return SourceRelation
     */
    public function __construct(Agent|Location|Period|BibliographicEntry|DictionaryEntry|EncyclopediaEntry|Example|Frequency|Feature|FileGroup|SingleObject|ObjectGroup|Essay|Volume $record, BibliographicEntry $bibliographicEntry, BibliographicResource|GlossaryResource|LexicographicResource|MapResource|ObjectResource|PublicationResource $parentResource)
    {
        parent::__construct($parentResource);
        $this->initializeObject();

        $this->setType('sourceRelation');
        $this->setRecord($record);
        $this->addBibliographicEntry($bibliographicEntry);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->bibliographicEntry ??= new ObjectStorage();
    }

    /**
     * Get record
     * 
     * @return Agent|Location|Period|BibliographicEntry|DictionaryEntry|EncyclopediaEntry|Example|Frequency|Feature|FileGroup|SingleObject|ObjectGroup|Essay|Volume
     */
    public function getRecord(): Agent|Location|Period|BibliographicEntry|DictionaryEntry|EncyclopediaEntry|Example|Frequency|Feature|FileGroup|SingleObject|ObjectGroup|Essay|Volume
    {
        if ($this->record instanceof LazyLoadingProxy) {
            $this->record->_loadRealInstance();
        }
        return $this->record;
    }

    /**
     * Set record
     * 
     * @param Agent|Location|Period|BibliographicEntry|DictionaryEntry|EncyclopediaEntry|Example|Frequency|Feature|FileGroup|SingleObject|ObjectGroup|Essay|Volume
     */
    public function setRecord(Agent|Location|Period|BibliographicEntry|DictionaryEntry|EncyclopediaEntry|Example|Frequency|Feature|FileGroup|SingleObject|ObjectGroup|Essay|Volume $record): void
    {
        $this->record = $record;
    }

    /**
     * Get bibliographic entry
     *
     * @return ObjectStorage<BibliographicEntry>
     */
    public function getBibliographicEntry(): ?ObjectStorage
    {
        return $this->bibliographicEntry;
    }

    /**
     * Set bibliographic entry
     *
     * @param ObjectStorage<BibliographicEntry> $bibliographicEntry
     */
    public function setBibliographicEntry(ObjectStorage $bibliographicEntry): void
    {
        $this->bibliographicEntry = $bibliographicEntry;
    }

    /**
     * Add bibliographic entry
     *
     * @param BibliographicEntry $bibliographicEntry
     */
    public function addBibliographicEntry(BibliographicEntry $bibliographicEntry): void
    {
        $this->bibliographicEntry?->attach($bibliographicEntry);
    }

    /**
     * Remove bibliographic entry
     *
     * @param BibliographicEntry $bibliographicEntry
     */
    public function removeBibliographicEntry(BibliographicEntry $bibliographicEntry): void
    {
        $this->bibliographicEntry?->detach($bibliographicEntry);
    }

    /**
     * Remove all bibliographic entriess
     */
    public function removeAllBibliographicEntry(): void
    {
        $bibliographicEntry = clone $this->bibliographicEntry;
        $this->bibliographicEntry->removeAll($bibliographicEntry);
    }

    /**
     * Get elaboration
     *
     * @return string
     */
    public function getElaboration(): string
    {
        return $this->elaboration;
    }

    /**
     * Set elaboration
     *
     * @param string $elaboration
     */
    public function setElaboration(string $elaboration): void
    {
        $this->elaboration = $elaboration;
    }

    /**
     * Get elaboration type
     *
     * @return string
     */
    public function getElaborationType(): string
    {
        return $this->elaborationType;
    }

    /**
     * Set elaboration type
     *
     * @param string $elaborationType
     */
    public function setElaborationType(string $elaborationType): void
    {
        $this->elaborationType = $elaborationType;
    }
}
