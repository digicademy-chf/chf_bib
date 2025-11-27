<?php
declare(strict_types=1);

# This file is part of the extension CHF Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBib\Domain\Model;

use Digicademy\CHFBase\Domain\Model\Agent;
use Digicademy\CHFBase\Domain\Model\AbstractHeritage;
use Digicademy\CHFBase\Domain\Model\Traits\ExtentTrait;
use Digicademy\CHFBase\Domain\Validator\StringOptionsValidator;
use TYPO3\CMS\Extbase\Attribute\ORM\Lazy;
use TYPO3\CMS\Extbase\Attribute\Validate;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;

defined('TYPO3') or die();

/**
 * Model for BibliographicEntry
 */
class BibliographicEntry extends AbstractHeritage
{
    use ExtentTrait;

    /**
     * Approximate taxonomy of the entry
     * 
     * @var string
     */
    #[Validate([
        'validator' => StringOptionsValidator::class,
        'options'   => [
            'allowed' => [
                'artwork',
                'audioRecording',
                'bill',
                'blogPost',
                'book',
                'bookSection',
                'case',
                'computerProgram',
                'conferencePaper',
                'dataset',
                'dictionaryEntry',
                'document',
                'email',
                'encyclopediaArticle',
                'film',
                'forumPost',
                'hearing',
                'instantMessage',
                'interview',
                'journalArticle',
                'letter',
                'magazineArticle',
                'manuscript',
                'map',
                'newspaperArticle',
                'patent',
                'podcast',
                'preprint',
                'presentation',
                'radioBroadcast',
                'report',
                'standard',
                'statute',
                'thesis',
                'tvBroadcast',
                'videoRecording',
                'webpage',
            ],
        ],
    ])]
    protected string $type = 'book';

    /**
     * Date when the source was last checked
     * 
     * @var ?\DateTime
     */
    protected ?\DateTime $lastChecked = null;

    /**
     * Title of a non-independent publication, e.g., a paper
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options' => [
            'maximum' => 255,
        ],
    ])]
    protected string $itemTitle = '';

    /**
     * Title of the independent publication, e.g., a monograph
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options' => [
            'maximum' => 255,
        ],
    ])]
    protected string $standaloneTitle = '';

    /**
     * Name of the meeting the publication was presented at
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options' => [
            'maximum' => 255,
        ],
    ])]
    protected string $meetingTitle = '';

    /**
     * Name of a series this publication is part of
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options' => [
            'maximum' => 255,
        ],
    ])]
    protected string $seriesTitle = '';

    /**
     * Author of the publication
     * 
     * @var ObjectStorage<Agent>
     */
    #[Lazy()]
    protected ObjectStorage $author;

    /**
     * Editor of the publication
     * 
     * @var ObjectStorage<Agent>
     */
    #[Lazy()]
    protected ObjectStorage $editor;

    /**
     * Translator of the publication
     * 
     * @var ObjectStorage<Agent>
     */
    #[Lazy()]
    protected ObjectStorage $translator;

    /**
     * Further contributor of the publication
     * 
     * @var ObjectStorage<Agent>
     */
    #[Lazy()]
    protected ObjectStorage $contributor;

    /**
     * Date when the publication was published
     * 
     * @var ?\DateTime
     */
    protected ?\DateTime $date = null;

    /**
     * Non-standard publication date
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options' => [
            'maximum' => 255,
        ],
    ])]
    protected string $dateText = '';

    /**
     * Name of the publisher of this publication
     * 
     * @var ObjectStorage<Agent>
     */
    #[Lazy()]
    protected ObjectStorage $publisher;

    /**
     * Name of the library, archive, muesum, or gallery
     * 
     * @var Agent|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected Agent|LazyLoadingProxy|null $holdingOrg = null;

    /**
     * Publication location
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options' => [
            'maximum' => 255,
        ],
    ])]
    protected string $place = '';

    /**
     * Identifier assigned by the holding organisation
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options' => [
            'maximum' => 255,
        ],
    ])]
    protected string $callNumber = '';

    /**
     * Full citation in case all structured fields need to remain empty
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'String',
    ])]
    protected string $fallback = '';

    /**
     * Construct object
     *
     * @return BibliographicEntry
     */
    public function __construct()
    {
        parent::__construct();
        $this->initializeObject();

        $this->setIri('be');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->author = new ObjectStorage();
        $this->editor = new ObjectStorage();
        $this->translator = new ObjectStorage();
        $this->contributor = new ObjectStorage();
        $this->publisher = new ObjectStorage();
        $this->extent = new ObjectStorage();
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
     * Get last checked
     *
     * @return ?\DateTime
     */
    public function getLastChecked(): ?\DateTime
    {
        return $this->lastChecked;
    }

    /**
     * Set last checked
     *
     * @param \DateTime $lastChecked
     */
    public function setLastChecked(\DateTime $lastChecked): void
    {
        $this->lastChecked = $lastChecked;
    }

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
     * Get standalone title
     *
     * @return string
     */
    public function getStandaloneTitle(): string
    {
        return $this->standaloneTitle;
    }

    /**
     * Set standalone title
     *
     * @param string $standaloneTitle
     */
    public function setStandaloneTitle(string $standaloneTitle): void
    {
        $this->standaloneTitle = $standaloneTitle;
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
     * Get author
     *
     * @return ObjectStorage<Agent>
     */
    public function getAuthor(): ObjectStorage
    {
        return $this->author;
    }

    /**
     * Set author
     *
     * @param ObjectStorage<Agent> $author
     */
    public function setAuthor(ObjectStorage $author): void
    {
        $this->author = $author;
    }

    /**
     * Add author
     *
     * @param Agent $author
     */
    public function addAuthor(Agent $author): void
    {
        $this->author->attach($author);
    }

    /**
     * Remove author
     *
     * @param Agent $author
     */
    public function removeAuthor(Agent $author): void
    {
        $this->author->detach($author);
    }

    /**
     * Remove all authors
     */
    public function removeAllAuthor(): void
    {
        $author = clone $this->author;
        $this->author->removeAll($author);
    }

    /**
     * Get editor
     *
     * @return ObjectStorage<Agent>
     */
    public function getEditor(): ObjectStorage
    {
        return $this->editor;
    }

    /**
     * Set editor
     *
     * @param ObjectStorage<Agent> $editor
     */
    public function setEditor(ObjectStorage $editor): void
    {
        $this->editor = $editor;
    }

    /**
     * Add editor
     *
     * @param Agent $editor
     */
    public function addEditor(Agent $editor): void
    {
        $this->editor->attach($editor);
    }

    /**
     * Remove editor
     *
     * @param Agent $editor
     */
    public function removeEditor(Agent $editor): void
    {
        $this->editor->detach($editor);
    }

    /**
     * Remove all editors
     */
    public function removeAllEditor(): void
    {
        $editor = clone $this->editor;
        $this->editor->removeAll($editor);
    }

    /**
     * Get translator
     *
     * @return ObjectStorage<Agent>
     */
    public function getTranslator(): ObjectStorage
    {
        return $this->translator;
    }

    /**
     * Set translator
     *
     * @param ObjectStorage<Agent> $translator
     */
    public function setTranslator(ObjectStorage $translator): void
    {
        $this->translator = $translator;
    }

    /**
     * Add translator
     *
     * @param Agent $translator
     */
    public function addTranslator(Agent $translator): void
    {
        $this->translator->attach($translator);
    }

    /**
     * Remove translator
     *
     * @param Agent $translator
     */
    public function removeTranslator(Agent $translator): void
    {
        $this->translator->detach($translator);
    }

    /**
     * Remove all translators
     */
    public function removeAllTranslator(): void
    {
        $translator = clone $this->translator;
        $this->translator->removeAll($translator);
    }

    /**
     * Get contributor
     *
     * @return ObjectStorage<Agent>
     */
    public function getContributor(): ObjectStorage
    {
        return $this->contributor;
    }

    /**
     * Set contributor
     *
     * @param ObjectStorage<Agent> $contributor
     */
    public function setContributor(ObjectStorage $contributor): void
    {
        $this->contributor = $contributor;
    }

    /**
     * Add contributor
     *
     * @param Agent $contributor
     */
    public function addContributor(Agent $contributor): void
    {
        $this->contributor->attach($contributor);
    }

    /**
     * Remove contributor
     *
     * @param Agent $contributor
     */
    public function removeContributor(Agent $contributor): void
    {
        $this->contributor->detach($contributor);
    }

    /**
     * Remove all contributors
     */
    public function removeAllContributor(): void
    {
        $contributor = clone $this->contributor;
        $this->contributor->removeAll($contributor);
    }

    /**
     * Get date
     *
     * @return ?\DateTime
     */
    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * Get date text
     *
     * @return string
     */
    public function getDateText(): string
    {
        return $this->dateText;
    }

    /**
     * Set date text
     *
     * @param string $dateText
     */
    public function setDateText(string $dateText): void
    {
        $this->dateText = $dateText;
    }

    /**
     * Get publisher
     *
     * @return ObjectStorage<Agent>
     */
    public function getPublisher(): ObjectStorage
    {
        return $this->publisher;
    }

    /**
     * Set publisher
     *
     * @param ObjectStorage<Agent> $publisher
     */
    public function setPublisher(ObjectStorage $publisher): void
    {
        $this->publisher = $publisher;
    }

    /**
     * Add publisher
     *
     * @param Agent $publisher
     */
    public function addPublisher(Agent $publisher): void
    {
        $this->publisher->attach($publisher);
    }

    /**
     * Remove publisher
     *
     * @param Agent $publisher
     */
    public function removePublisher(Agent $publisher): void
    {
        $this->publisher->detach($publisher);
    }

    /**
     * Remove all publishers
     */
    public function removeAllPublisher(): void
    {
        $publisher = clone $this->publisher;
        $this->publisher->removeAll($publisher);
    }

    /**
     * Get holding organisation
     * 
     * @return Agent
     */
    public function getHoldingOrg(): Agent
    {
        if ($this->holdingOrg instanceof LazyLoadingProxy) {
            $this->holdingOrg->_loadRealInstance();
        }
        return $this->holdingOrg;
    }

    /**
     * Set holding organisation
     * 
     * @param Agent
     */
    public function setHoldingOrg(Agent $holdingOrg): void
    {
        $this->holdingOrg = $holdingOrg;
    }

    /**
     * Get place
     *
     * @return string
     */
    public function getPlace(): string
    {
        return $this->place;
    }

    /**
     * Set place
     *
     * @param string $place
     */
    public function setPlace(string $place): void
    {
        $this->place = $place;
    }

    /**
     * Get call number
     *
     * @return string
     */
    public function getCallNumber(): string
    {
        return $this->callNumber;
    }

    /**
     * Set call number
     *
     * @param string $callNumber
     */
    public function setCallNumber(string $callNumber): void
    {
        $this->callNumber = $callNumber;
    }

    /**
     * Get fallback
     *
     * @return string
     */
    public function getFallback(): string
    {
        return $this->fallback;
    }

    /**
     * Set fallback
     *
     * @param string $fallback
     */
    public function setFallback(string $fallback): void
    {
        $this->fallback = $fallback;
    }
}
