<?php
declare(strict_types=1);

# This file is part of the extension CHF Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBib\Domain\Model;

use Digicademy\CHFBase\Domain\Model\AbstractBase;
use Digicademy\CHFBase\Domain\Model\AbstractRelation;
use Digicademy\CHFBase\Domain\Model\Traits\RecordTrait;
use Digicademy\CHFBase\Domain\Validator\StringOptionsValidator;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for SourceRelation
 */
class SourceRelation extends AbstractRelation
{
    use RecordTrait;

    /**
     * Bibliographic entry to relate to the record
     * 
     * @var ObjectStorage<BibliographicEntry>
     */
    #[Lazy()]
    protected ObjectStorage $bibliographicEntry;

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
    protected ?string $elaborationType = null;

    /**
     * Construct object
     *
     * @param AbstractBase $record
     * @param BibliographicEntry $bibliographicEntry
     * @return SourceRelation
     */
    public function __construct(AbstractBase $record, BibliographicEntry $bibliographicEntry)
    {
        parent::__construct();
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
        $this->bibliographicEntry = new ObjectStorage();
    }

    /**
     * Get bibliographic entry
     *
     * @return ObjectStorage<BibliographicEntry>
     */
    public function getBibliographicEntry(): ObjectStorage
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
        $this->bibliographicEntry->attach($bibliographicEntry);
    }

    /**
     * Remove bibliographic entry
     *
     * @param BibliographicEntry $bibliographicEntry
     */
    public function removeBibliographicEntry(BibliographicEntry $bibliographicEntry): void
    {
        $this->bibliographicEntry->detach($bibliographicEntry);
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
