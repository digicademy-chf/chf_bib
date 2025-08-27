<?php
declare(strict_types=1);

# This file is part of the extension CHF Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBib\Domain\Model;

use Digicademy\CHFBase\Domain\Model\AbstractResource;
use Digicademy\CHFGloss\Domain\Model\Traits\GlossaryTrait;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

/**
 * Model for AbstractBibliographicResource
 */
class AbstractBibliographicResource extends AbstractResource
{
    /**
     * Construct object
     *
     * @param string $langCode
     * @return BibliographicResource
     */
    public function __construct(string $langCode)
    {
        parent::__construct($langCode);

        $this->setType('bibliographicResource');
    }
}

# If CHF Gloss is available
if (ExtensionManagementUtility::isLoaded('chf_gloss')) {

    /**
     * Model for BibliographicResource (with glossary property)
     */
    class BibliographicResource extends AbstractBibliographicResource
    {
        use GlossaryTrait;
    }

# If no relevant extensions are available
} else {

    /**
     * Model for BibliographicResource
     */
    class BibliographicResource extends AbstractBibliographicResource
    {}
}
