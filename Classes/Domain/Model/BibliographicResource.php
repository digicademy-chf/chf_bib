<?php
declare(strict_types=1);

# This file is part of the extension CHF Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBib\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Digicademy\CHFBase\Domain\Model\AbstractResource;
use Digicademy\CHFGloss\Domain\Model\GlossaryResource;

defined('TYPO3') or die();

/**
 * Model for BibliographicResource
 */
class BibliographicResource extends AbstractResource
{
    /**
     * Resource to use as a glossary for this resource
     * 
     * @var GlossaryResource|LazyLoadingProxy
     */
    #[Lazy()]
    protected GlossaryResource|LazyLoadingProxy $glossary;

    /**
     * List of all bibliographic entries compiled in this resource
     * 
     * @var ?ObjectStorage<BibliographicEntry>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $allBibliographicEntries = null;

    /**
     * Construct object
     *
     * @param string $uuid
     * @param string $langCode
     * @return BibliographicResource
     */
    public function __construct(string $uuid, string $langCode)
    {
        parent::__construct($uuid, $langCode);
        $this->initializeObject();

        $this->setType('bibliographicResource');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->glossary = new LazyLoadingProxy();
        $this->allBibliographicEntries ??= new ObjectStorage();
    }

    /**
     * Get glossary
     * 
     * @return GlossaryResource
     */
    public function getGlossary(): GlossaryResource
    {
        if ($this->glossary instanceof LazyLoadingProxy) {
            $this->glossary->_loadRealInstance();
        }
        return $this->glossary;
    }

    /**
     * Set glossary
     * 
     * @param GlossaryResource
     */
    public function setGlossary(GlossaryResource $glossary): void
    {
        $this->glossary = $glossary;
    }

    /**
     * Get all bibliographic entries
     *
     * @return ObjectStorage<BibliographicEntry>
     */
    public function getAllBibliographicEntries(): ?ObjectStorage
    {
        return $this->allBibliographicEntries;
    }

    /**
     * Set all bibliographic entries
     *
     * @param ObjectStorage<BibliographicEntry> $allBibliographicEntries
     */
    public function setAllBibliographicEntries(ObjectStorage $allBibliographicEntries): void
    {
        $this->allBibliographicEntries = $allBibliographicEntries;
    }

    /**
     * Add all bibliographic entries
     *
     * @param BibliographicEntry $allBibliographicEntries
     */
    public function addAllBibliographicEntries(BibliographicEntry $allBibliographicEntries): void
    {
        $this->allBibliographicEntries?->attach($allBibliographicEntries);
    }

    /**
     * Remove all bibliographic entries
     *
     * @param BibliographicEntry $allBibliographicEntries
     */
    public function removeAllBibliographicEntries(BibliographicEntry $allBibliographicEntries): void
    {
        $this->allBibliographicEntries?->detach($allBibliographicEntries);
    }

    /**
     * Remove all all bibliographic entries
     */
    public function removeAllAllBibliographicEntries(): void
    {
        $allBibliographicEntries = clone $this->allBibliographicEntries;
        $this->allBibliographicEntries->removeAll($allBibliographicEntries);
    }
}
