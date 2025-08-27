<?php
declare(strict_types=1);

# This file is part of the extension CHF Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBib\Domain\Model\Traits;

use Digicademy\CHFBib\Domain\Model\SourceRelation;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Trait for models to include a source-relation property
 */
trait SourceRelationTrait
{
    /**
     * Sources of this database record
     * 
     * @var ?ObjectStorage<SourceRelation>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $sourceRelation = null;

    /**
     * Get source relation
     *
     * @return ObjectStorage<SourceRelation>
     */
    public function getSourceRelation(): ?ObjectStorage
    {
        return $this->sourceRelation;
    }

    /**
     * Set source relation
     *
     * @param ObjectStorage<SourceRelation> $sourceRelation
     */
    public function setSourceRelation(ObjectStorage $sourceRelation): void
    {
        $this->sourceRelation = $sourceRelation;
    }

    /**
     * Add source relation
     *
     * @param SourceRelation $sourceRelation
     */
    public function addSourceRelation(SourceRelation $sourceRelation): void
    {
        $this->sourceRelation?->attach($sourceRelation);
    }

    /**
     * Remove source relation
     *
     * @param SourceRelation $sourceRelation
     */
    public function removeSourceRelation(SourceRelation $sourceRelation): void
    {
        $this->sourceRelation?->detach($sourceRelation);
    }

    /**
     * Remove all source relations
     */
    public function removeAllSourceRelation(): void
    {
        $sourceRelation = clone $this->sourceRelation;
        $this->sourceRelation->removeAll($sourceRelation);
    }
}
