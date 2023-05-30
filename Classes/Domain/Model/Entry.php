<?php

declare(strict_types=1);

# This file is part of the extension DA Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


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
    protected string $zoteroUri = '';

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

    #[Lazy()]
    #[Cascade('remove')]
    /**
     * List of URIs describing the same entity
     * 
     * @var ObjectStorage<SameAs>
     */
    protected $sameAs;

    /**
     * Title of non-independent publication (e.g. paper)
     * 
     * @var string
     */
    protected string $itemTitle = '';

    /**
     * Title of independent publication (e.g. edited volume or monograph)
     * 
     * @var string
     */
    protected string $publicationTitle = '';

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
    /**
     * Author of the entry
     * 
     * @var ObjectStorage<Contributor>
     */
    protected $contributorAuthor;

    #[Lazy()]
    /**
     * Editor of to the entry
     * 
     * @var ObjectStorage<Contributor>
     */
    protected $contributorEditor;

    #[Lazy()]
    /**
     * Translator of the entry
     * 
     * @var ObjectStorage<Contributor>
     */
    protected $contributorTranslator;

    #[Lazy()]
    /**
     * Generic contributor to the entry
     * 
     * @var ObjectStorage<Contributor>
     */
    protected $contributorGeneric;

    #[Lazy()]
    #[Cascade('remove')]
    /**
     * Scope related to the published entity (e.g. volume)
     * 
     * @var ObjectStorage<Scope>
     */
    protected $scope;

    /**
     * Extent of the published entity (e.g. page range)
     * 
     * @var string
     */
    protected string $extent = '';

    /**
     * Type of extent of the published entity (e.g. page range)
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
     * Initialize label, contributors, and scope
     *
     * @return Entry
     */
    public function __construct()
    {
        $this->label                 = new ObjectStorage();
        $this->sameAs                = new ObjectStorage();
        $this->contributorAuthor     = new ObjectStorage();
        $this->contributorEditor     = new ObjectStorage();
        $this->contributorTranslator = new ObjectStorage();
        $this->contributorGeneric    = new ObjectStorage();
        $this->scope                 = new ObjectStorage();
    }

    /**
     * Get Zotero URI
     *
     * @return string
     */
    public function getZoteroUri(): string
    {
        return $this->zoteroUri;
    }

    /**
     * Set Zotero URI
     *
     * @param string $zoteroUri
     */
    public function setZoteroUri(string $zoteroUri): void
    {
        $this->zoteroUri = $zoteroUri;
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
     * Get author
     *
     * @return ObjectStorage|null
     */
    public function getContributorAuthor(): ?ObjectStorage
    {
        return $this->contributorAuthor;
    }

    /**
     * Set author
     *
     * @param ObjectStorage $contributorAuthor
     */
    public function setContributorAuthor($contributorAuthor): void
    {
        $this->contributorAuthor = $contributorAuthor;
    }

    /**
     * Add author
     *
     * @param Contributor $contributorAuthor
     */
    /*public function addContributorAuthor(Contributor $contributorAuthor): void
    {
        $this->contributorAuthor->attach($contributorAuthor);
    }*/

    /**
     * Remove author
     *
     * @param Contributor $contributorAuthor
     */
    /*public function removeContributorAuthor(Contributor $contributorAuthor): void
    {
        $this->contributorAuthor->detach($contributorAuthor);
    }*/

    /**
     * Get editor
     *
     * @return ObjectStorage|null
     */
    public function getContributorEditor(): ?ObjectStorage
    {
        return $this->contributorEditor;
    }

    /**
     * Set editor
     *
     * @param ObjectStorage $contributorEditor
     */
    public function setContributorEditor($contributorEditor): void
    {
        $this->contributorEditor = $contributorEditor;
    }

    /**
     * Add editor
     *
     * @param Contributor $contributorEditor
     */
    /*public function addContributorEditor(Contributor $contributorEditor): void
    {
        $this->contributorEditor->attach($contributorEditor);
    }*/

    /**
     * Remove editor
     *
     * @param Contributor $contributorEditor
     */
    /*public function removeContributorEditor(Contributor $contributorEditor): void
    {
        $this->contributorEditor->detach($contributorEditor);
    }*/

    /**
     * Get translator
     *
     * @return ObjectStorage|null
     */
    public function getContributorTranslator(): ?ObjectStorage
    {
        return $this->contributorTranslator;
    }

    /**
     * Set translator
     *
     * @param ObjectStorage $contributorTranslator
     */
    public function setContributorTranslator($contributorTranslator): void
    {
        $this->contributorTranslator = $contributorTranslator;
    }

    /**
     * Add translator
     *
     * @param Contributor $contributorTranslator
     */
    /*public function addContributorTranslator(Contributor $contributorTranslator): void
    {
        $this->contributorTranslator->attach($contributorTranslator);
    }*/

    /**
     * Remove translator
     *
     * @param Contributor $contributorTranslator
     */
    /*public function removeContributorTranslator(Contributor $contributorTranslator): void
    {
        $this->contributorTranslator->detach($contributorTranslator);
    }*/

    /**
     * Get generic contributor
     *
     * @return ObjectStorage|null
     */
    public function getContributorGeneric(): ?ObjectStorage
    {
        return $this->contributorGeneric;
    }

    /**
     * Set generic contributor
     *
     * @param ObjectStorage $contributorGeneric
     */
    public function setContributorGeneric($contributorGeneric): void
    {
        $this->contributorGeneric = $contributorGeneric;
    }

    /**
     * Add generic contributor
     *
     * @param Contributor $contributorGeneric
     */
    /*public function addContributorGeneric(Contributor $contributorGeneric): void
    {
        $this->contributorGeneric->attach($contributorGeneric);
    }*/

    /**
     * Remove generic contributor
     *
     * @param Contributor $contributorGeneric
     */
    /*public function removeContributorGeneric(Contributor $contributorGeneric): void
    {
        $this->contributorGeneric->detach($contributorGeneric);
    }*/

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
}

?>