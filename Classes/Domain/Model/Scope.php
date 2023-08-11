<?php

declare(strict_types=1);

# This file is part of the extension DA Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DABib\Domain\Model;

use Digicademy\DABib\Domain\Validator\StringOptionsValidator;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Model for scopes
 */
class Scope extends AbstractEntity
{
    /**
     * Specific notation, e.g., URL, ISSN, volume, issue, or another number
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'minimum' => 1,
            'maximum' => 255,
        ],
    ])]
    protected string $text = '';

    /**
     * Type of notation
     * 
     * @var string
     */
    #[Validate([
        'validator' => StringOptionsValidator::class,
        'options'   => [
            'allowed' => [
                'urn',
                'url',
                'issn',
                'isbn',
                'callNumber',
                'volume',
                'issue',
                'edition',
                'version',
            ],
        ],
    ])]
    protected string $type = '';

    /**
     * Initialize object
     *
     * @param string $text
     * @param string $type
     * @return Scope
     */
    public function __construct(string $text, string $type)
    {
        $this->setText($text);
        $this->setType($type);
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Set text
     *
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
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
}

?>