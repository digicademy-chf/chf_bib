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

defined('TYPO3') or die();

/**
 * Model to provide a reference to a bibliographic entry
 */
class Reference extends AbstractEntity
{
    #[Lazy()]
    /**
     * Bibliographic entry the relation refers to
     * 
     * @var ObjectStorage<Entry>
     */
    protected $entry;

    /**
     * Specific location of the reference
     * 
     * @var string
     */
    protected string $elaboration = '';

    /**
     * Specific location type of the reference
     * 
     * @var string
     */
    protected string $elaborationType = '';

    /**
     * Date when the source was last checked
     * 
     * @var DateTime
     */
    protected $lastChecked;

    /**
     * Initialize entries
     *
     * @return EntryRelation
     */
    public function __construct()
    {
        $this->entry = new ObjectStorage();
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
    /*public function addEntry(Entry $entry): void
    {
        $this->entry->attach($entry);
    }*/

    /**
     * Remove entry
     *
     * @param Entry $entry
     */
    /*public function removeEntry(Entry $entry): void
    {
        $this->entry->detach($entry);
    }*/

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
     * @param string $laboration
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
     * Get last checked date
     *
     * @return DateTime
     */
    public function getLastChecked(): DateTime
    {
        return $this->lastChecked;
    }

    /**
     * Set last checked date
     *
     * @param DateTime $lastChecked
     */
    public function setLastChecked(DateTime $lastChecked): void
    {
        $this->lastChecked = $lastChecked;
    }
}

?>