<?php
declare(strict_types=1);

# This file is part of the extension CHF Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBib\Controller;

use Digicademy\CHFBase\Domain\Repository\AbstractResourceRepository;
use Digicademy\CHFBib\Domain\Model\BibliographicEntry;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

defined('TYPO3') or die();

/**
 * Controller for Bibliography
 */
class BibliographyController extends ActionController
{
    private AbstractResourceRepository $abstractResourceRepository;

    public function injectAbstractResourceRepository(AbstractResourceRepository $abstractResourceRepository): void
    {
        $this->abstractResourceRepository = $abstractResourceRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('resource', $this->abstractResourceRepository->findOneBy(['type' => 'bibliographicResource']));
        return $this->htmlResponse();
    }

    public function showAction(BibliographicEntry $bibliographicEntry): ResponseInterface
    {
        $this->view->assign('bibliographicEntry', $bibliographicEntry);
        return $this->htmlResponse();
    }
}
