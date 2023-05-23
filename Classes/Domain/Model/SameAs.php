<?php

declare(strict_types=1);

/*
 * This file is part of the extension DA Bib for TYPO3.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace Digicademy\DABib\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

defined('TYPO3') or die();

/**
 * Model to provide a link to the same entity at a different URI
 */
class SameAs extends AbstractEntity
{
    /**
     * Different URI of the same entity
     * 
     * @var string
     */
    protected string $uri = '';

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
}

?>