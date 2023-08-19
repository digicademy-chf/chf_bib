<?php

declare(strict_types=1);

# This file is part of the extension DA Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DABib\Domain\Model;

use DateTime;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for references
 */
class Reference extends AbstractEntity
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
     * Bibliographic entry to reference
     * 
     * @var ObjectStorage<Entry>
     */
    #[Lazy()]
    protected ObjectStorage $entry;

    /**
     * Detailed reference, e.g., a page number
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
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
    protected string $elaborationType = '';

    /**
     * Label to group the reference into
     * 
     * @var ObjectStorage<Tag>
     */
    #[Lazy()]
    protected ObjectStorage $label;

    /**
     * Date when the reference was last checked
     * 
     * @var DateTime|null
     */
    #[Validate([
        'validator' => 'DateTime',
    ])]
    protected ?DateTime $lastChecked = null;

    /**
     * Construct object
     *
     * @param Entry $entry
     * @return Reference
     */
    public function __construct(Entry $entry)
    {
        $this->initializeObject();

        $this->addEntry($entry);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->entry = new ObjectStorage();
        $this->label = new ObjectStorage();
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
     * Remove all entries
     */
    public function removeAllLabels(): void
    {
        $label = clone $this->label;
        $this->label->removeAll($label);
    }

    /**
     * Get last checked
     *
     * @return DateTime
     */
    public function getLastChecked(): DateTime
    {
        return $this->lastChecked;
    }

    /**
     * Set last checked
     *
     * @param DateTime $lastChecked
     */
    public function setLastChecked(DateTime $lastChecked): void
    {
        $this->lastChecked = $lastChecked;
    }
}

?>