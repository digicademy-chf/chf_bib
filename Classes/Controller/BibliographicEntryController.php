<?php
declare(strict_types=1);

# This file is part of the extension CHF Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBib\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\CHFBib\Domain\Model\BibliographicEntry;
use Digicademy\CHFBib\Domain\Repository\BibliographicEntryRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

defined('TYPO3') or die();

/**
 * Controller for BibliographicEntry
 */
class BibliographicEntryController extends ActionController
{
    private BibliographicEntryRepository $bibliographicEntryRepository;

    public function injectBibliographicEntryRepository(BibliographicEntryRepository $bibliographicEntryRepository): void
    {
        $this->bibliographicEntryRepository = $bibliographicEntryRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('bibliographicEntries', $this->bibliographicEntryRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(BibliographicEntry $bibliographicEntry): ResponseInterface
    {
        $this->view->assign('bibliographicEntry', $bibliographicEntry);
        return $this->htmlResponse();
    }
}
