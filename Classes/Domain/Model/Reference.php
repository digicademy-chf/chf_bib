<?php

declare(strict_types=1);

# This file is part of the extension DA Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DABib\Domain\Model;

use DateTime;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for references
 */
class Reference extends AbstractEntity
{
    /**
     * Unique reference identifier
     * 
     * @var string
     */
    protected $uuid;

    #[Lazy()]
    /**
     * Bibliographic entry to reference
     * 
     * @var ObjectStorage<Entry>
     */
    protected $entry;

    /**
     * Detailed reference, e.g., a page number
     * 
     * @var string
     */
    protected string $elaboration = '';

    /**
     * Type of detailed reference
     * 
     * @var string
     */
    protected string $elaborationType = '';

    #[Lazy()]
    /**
     * Label to group the reference into
     * 
     * @var ObjectStorage<Tag>
     */
    protected $label;

    /**
     * Date when the reference was last checked
     * 
     * @var DateTime
     */
    protected $lastChecked;

    /**
     * Initialize object
     *
     * @return EntryRelation
     */
    public function __construct()
    {
        $this->entry = new ObjectStorage();
        $this->label = new ObjectStorage();
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
     * Get entry
     *
     * @return ObjectStorage|null
     */
    public function getEntry(): ?ObjectStorage
    {
        return $this->entry;
    }

    /**
     * Set entry
     *
     * @param ObjectStorage $entry
     */
    public function setEntry($entry): void
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