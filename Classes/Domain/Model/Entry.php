<?php

declare(strict_types=1);

/*
 * This file is part of the extension DA Bib for TYPO3.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace Digicademy\DABib\Domain\Model;

use DateTime;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for bibliographic entries
 */
class Entry extends AbstractEntity
{
    /**
     * Zotero URI of the entry
     * 
     * @var string
     */
    protected string $uri = '';

    /**
     * Type of bibliographic entry
     * 
     * @var string
     */
    protected string $type = '';

    #[Lazy()]
    /**
     * Tag that can be used to group entries
     * 
     * @var ObjectStorage<Tag>
     */
    protected $label;

    #[Lazy()]
    #[Cascade('remove')]
    /**
     * List of URIs describing the same entity
     * 
     * @var ObjectStorage<SameAs>
     */
    protected $sameAs;

    #[Lazy()]
    /**
     * Contributor to non-independent publication (e.g. paper)
     * 
     * @var ObjectStorage<ContributorRelation>
     */
    protected $itemContributorRelation;

    /**
     * Title of non-independent publication (e.g. paper)
     * 
     * @var string
     */
    protected string $itemTitle = '';

    /**
     * Identifier of non-independent publication (e.g. paper)
     * 
     * @var string
     */
    protected string $itemIdentifier = '';

    /**
     * Type of identifier for non-independent publication (e.g. paper)
     * 
     * @var string
     */
    protected string $itemIdentifierType = '';

    #[Lazy()]
    /**
     * Contributor to independent publication (e.g. edited volume or monograph)
     * 
     * @var ObjectStorage<ContributorRelation>
     */
    protected $publicationContributorRelation;

    /**
     * Title of independent publication (e.g. edited volume or monograph)
     * 
     * @var string
     */
    protected string $publicationTitle = '';

    /**
     * Edition of independent publication (e.g. edited volume or monograph)
     * 
     * @var string
     */
    protected string $publicationEdition = '';

    /**
     * Type of edition of independent publication (e.g. edited volume or monograph)
     * 
     * @var string
     */
    protected string $publicationEditionType = '';

    /**
     * Place of independent publication (e.g. edited volume or monograph)
     * 
     * @var string
     */
    protected string $publicationPlace = '';

    /**
     * Publisher of independent publication (e.g. edited volume or monograph)
     * 
     * @var string
     */
    protected string $publicationPublisher = '';

    /**
     * Date of independent publication (e.g. edited volume or monograph)
     * 
     * @var DateTime
     */
    protected $publicationDate;

    #[Lazy()]
    #[Cascade('remove')]
    /**
     * Scope related to the published entity (e.g. page range, volume)
     * 
     * @var ObjectStorage<Scope>
     */
    protected $scope;

    /**
     * Extent of the published entity (e.g. volumes)
     * 
     * @var string
     */
    protected string $extent = '';

    /**
     * Type of extent of the published entity (e.g. volumes)
     * 
     * @var string
     */
    protected string $extentType = '';

    /**
     * Title of the series the entity is part of
     * 
     * @var string
     */
    protected string $seriesTitle = '';

    /**
     * Name of the meeting the entity was presented at
     * 
     * @var string
     */
    protected string $meetingTitle = '';

    /**
     * Identifier of the publication (e.g. URL)
     * 
     * @var string
     */
    protected string $identifier = '';

    /**
     * Type of identifier of the publication (e.g. URL)
     * 
     * @var string
     */
    protected string $identifierType = '';

    /**
     * Initialize label, contributors, and scope
     *
     * @return Entry
     */
    public function __construct()
    {
        $this->label                          = new ObjectStorage();
        $this->sameAs                         = new ObjectStorage();
        $this->itemContributorRelation        = new ObjectStorage();
        $this->publicationContributorRelation = new ObjectStorage();
        $this->scope                          = new ObjectStorage();
    }

    /**
     * Get URI
     *
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * Set URI
     *
     * @param string $uri
     */
    public function setUri(string $uri): void
    {
        $this->uri = $uri;
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
    /*public function addLabel(Tag $label): void
    {
        $this->label->attach($label);
    }*/

    /**
     * Remove label
     *
     * @param Tag $label
     */
    /*public function removeLabel(Tag $label): void
    {
        $this->label->detach($label);
    }*/

    /**
     * Get sameAs URI
     *
     * @return ObjectStorage|null
     */
    public function getSameAs(): ?ObjectStorage
    {
        return $this->sameAs;
    }

    /**
     * Set sameAs URI
     *
     * @param ObjectStorage $sameAs
     */
    public function setSameAs($sameAs): void
    {
        $this->sameAs = $sameAs;
    }

    /**
     * Add sameAs URI
     *
     * @param SameAs $sameAs
     */
    /*public function addSameAs(SameAs $sameAs): void
    {
        $this->sameAs->attach($sameAs);
    }*/

    /**
     * Remove sameAs URI
     *
     * @param SameAs $sameAs
     */
    /*public function removeSameAs(SameAs $sameAs): void
    {
        $this->sameAs->detach($sameAs);
    }*/

    /**
     * Get item contributor
     *
     * @return ObjectStorage|null
     */
    public function getItemContributorRelation(): ?ObjectStorage
    {
        return $this->itemContributorRelation;
    }

    /**
     * Set item contributor
     *
     * @param ObjectStorage $itemContributorRelation
     */
    public function setItemContributorRelation($itemContributorRelation): void
    {
        $this->itemContributorRelation = $itemContributorRelation;
    }

    /**
     * Add item contributor
     *
     * @param ContributorRelation $itemContributorRelation
     */
    /*public function addItemContributorRelation(ContributorRelation $itemContributorRelation): void
    {
        $this->itemContributorRelation->attach($itemContributorRelation);
    }*/

    /**
     * Remove item contributor
     *
     * @param ContributorRelation $itemContributorRelation
     */
    /*public function removeItemContributorRelation(ContributorRelation $itemContributorRelation): void
    {
        $this->itemContributorRelation->detach($itemContributorRelation);
    }*/

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
     * Get item identifier
     *
     * @return string
     */
    public function getItemIdentifier(): string
    {
        return $this->itemIdentifier;
    }

    /**
     * Set item identifier
     *
     * @param string $itemIdentifier
     */
    public function setItemIdentifier(string $itemIdentifier): void
    {
        $this->itemIdentifier = $itemIdentifier;
    }

    /**
     * Get item identifier type
     *
     * @return string
     */
    public function getItemIdentifierType(): string
    {
        return $this->itemIdentifierType;
    }

    /**
     * Set item identifier type
     *
     * @param string $itemIdentifierType
     */
    public function setItemIdentifierType(string $itemIdentifierType): void
    {
        $this->itemIdentifierType = $itemIdentifierType;
    }

    /**
     * Get publication contributor
     *
     * @return ObjectStorage|null
     */
    public function getPublicationContributorRelation(): ?ObjectStorage
    {
        return $this->publicationContributorRelation;
    }

    /**
     * Set publication contributor
     *
     * @param ObjectStorage $publicationContributorRelation
     */
    public function setPublicationContributorRelation($publicationContributorRelation): void
    {
        $this->publicationContributorRelation = $publicationContributorRelation;
    }

    /**
     * Add publication contributor
     *
     * @param ContributorRelation $publicationContributorRelation
     */
    /*public function addPublicationContributorRelation(ContributorRelation $publicationContributorRelation): void
    {
        $this->publicationContributorRelation->attach($publicationContributorRelation);
    }*/

    /**
     * Remove publication contributor
     *
     * @param ContributorRelation $publicationContributorRelation
     */
    /*public function removePublicationContributorRelation(ContributorRelation $publicationContributorRelation): void
    {
        $this->publicationContributorRelation->detach($publicationContributorRelation);
    }*/

    /**
     * Get publication title
     *
     * @return string
     */
    public function getPublicationTitle(): string
    {
        return $this->publicationTitle;
    }

    /**
     * Set publication title
     *
     * @param string $publicationTitle
     */
    public function setPublicationTitle(string $publicationTitle): void
    {
        $this->publicationTitle = $publicationTitle;
    }

    /**
     * Get publication edition
     *
     * @return string
     */
    public function getPublicationEdition(): string
    {
        return $this->publicationEdition;
    }

    /**
     * Set publication edition
     *
     * @param string $publicationEdition
     */
    public function setPublicationEdition(string $publicationEdition): void
    {
        $this->publicationEdition = $publicationEdition;
    }

    /**
     * Get publication-edition type
     *
     * @return string
     */
    public function getPublicationEditionType(): string
    {
        return $this->publicationEditionType;
    }

    /**
     * Set publication-edition type
     *
     * @param string $publicationEditionType
     */
    public function setPublicationEditionType(string $publicationEditionType): void
    {
        $this->publicationEditionType = $publicationEditionType;
    }

    /**
     * Get publication place
     *
     * @return string
     */
    public function getPublicationPlace(): string
    {
        return $this->publicationPlace;
    }

    /**
     * Set publication place
     *
     * @param string $publicationPlace
     */
    public function setPublicationPlace(string $publicationPlace): void
    {
        $this->publicationPlace = $publicationPlace;
    }

    /**
     * Get publication publisher
     *
     * @return string
     */
    public function getPublicationPublisher(): string
    {
        return $this->publicationPublisher;
    }

    /**
     * Set publication publisher
     *
     * @param string $publicationPublisher
     */
    public function setPublicationPublisher(string $publicationPublisher): void
    {
        $this->publicationPublisher = $publicationPublisher;
    }

    /**
     * Get publication date
     *
     * @return DateTime
     */
    public function getPublicationDate(): DateTime
    {
        return $this->publicationDate;
    }

    /**
     * Set publication date
     *
     * @param DateTime $publicationDate
     */
    public function setPublicationDate(DateTime $publicationDate): void
    {
        $this->publicationDate = $publicationDate;
    }

    /**
     * Get scope
     *
     * @return ObjectStorage|null
     */
    public function getScope(): ?ObjectStorage
    {
        return $this->scope;
    }

    /**
     * Set scope
     *
     * @param ObjectStorage $scope
     */
    public function setScope($scope): void
    {
        $this->scope = $scope;
    }

    /**
     * Add scope
     *
     * @param Scope $scope
     */
    /*public function addScope(Scope $scope): void
    {
        $this->scope->attach($scope);
    }*/

    /**
     * Remove scope
     *
     * @param Scope $scope
     */
    /*public function removeScope(Scope $scope): void
    {
        $this->scope->detach($scope);
    }*/








    /**
     * Get extent
     *
     * @return string
     */
    public function getExtent(): string
    {
        return $this->extent;
    }

    /**
     * Set extent
     *
     * @param string $extent
     */
    public function setExtent(string $extent): void
    {
        $this->extent = $extent;
    }

    /**
     * Get extent type
     *
     * @return string
     */
    public function getExtentType(): string
    {
        return $this->extentType;
    }

    /**
     * Set extent type
     *
     * @param string $extentType
     */
    public function setExtentType(string $extentType): void
    {
        $this->extentType = $extentType;
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
     * Get identifier
     *
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * Set identifier
     *
     * @param string $identifier
     */
    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }

    /**
     * Get identifier type
     *
     * @return string
     */
    public function getIdentifierType(): string
    {
        return $this->identifierType;
    }

    /**
     * Set identifier type
     *
     * @param string $identifierType
     */
    public function setIdentifierType(string $identifierType): void
    {
        $this->identifierType = $identifierType;
    }
}

?>