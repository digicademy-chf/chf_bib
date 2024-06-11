<?php
declare(strict_types=1);

# This file is part of the extension CHF Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBib\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Digicademy\CHFBase\Domain\Model\AbstractRelation;
use Digicademy\CHFBase\Domain\Validator\StringOptionsValidator;

defined('TYPO3') or die();

/**
 * Model for SourceRelation
 */
class SourceRelation extends AbstractRelation
{
    /**
     * Record to connect a relation to
     * 
     * @var ?ObjectStorage<object>
     */
    #[Lazy()]
    protected ?ObjectStorage $record;

    /**
     * Bibliographic entry to relate to the record
     * 
     * @var ?ObjectStorage<BibliographicEntry>
     */
    #[Lazy()]
    protected ?ObjectStorage $bibliographicEntry;

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
    protected string $elaborationType = 'pageNumbers';

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
     * Construct object
     *
     * @param object $parentResource
     * @param string $uuid
     * @param object $record
     * @param BibliographicEntry $bibliographicEntry
     * @return SourceRelation
     */
    public function __construct(object $parentResource, string $uuid, object $record, BibliographicEntry $bibliographicEntry)
    {
        parent::__construct($parentResource, $uuid);
        $this->initializeObject();

        $this->setType('sourceRelation');
        $this->addRecord($record);
        $this->addBibliographicEntry($bibliographicEntry);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->record ??= new ObjectStorage();
        $this->bibliographicEntry ??= new ObjectStorage();
    }

    /**
     * Get record
     *
     * @return ObjectStorage<object>
     */
    public function getRecord(): ?ObjectStorage
    {
        return $this->record;
    }

    /**
     * Set record
     *
     * @param ObjectStorage<object> $record
     */
    public function setRecord(ObjectStorage $record): void
    {
        $this->record = $record;
    }

    /**
     * Add record
     *
     * @param object $record
     */
    public function addRecord(object $record): void
    {
        $this->record?->attach($record);
    }

    /**
     * Remove record
     *
     * @param object $record
     */
    public function removeRecord(object $record): void
    {
        $this->record?->detach($record);
    }

    /**
     * Remove all records
     */
    public function removeAllRecord(): void
    {
        $record = clone $this->record;
        $this->record->removeAll($record);
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
}
