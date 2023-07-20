<?php

declare(strict_types=1);

# This file is part of the extension DA Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DABib\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\DABib\Domain\Model\BibliographicResource;
use Digicademy\DABib\Domain\Repository\BibliographicResourceRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for bibliographic resources
 */
class BibliographicResourceController extends ActionController
{
    private BibliographicResourceRepository $bibliographicResourceRepository;

    public function injectBibliographicResourceRepository(BibliographicResourceRepository $bibliographicResourceRepository): void
    {
        $this->bibliographicResourceRepository = $bibliographicResourceRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('bibliographicResources', $this->bibliographicResourceRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(BibliographicResource $bibliographicResource): ResponseInterface
    {
        $this->view->assign('bibliographicResource', $bibliographicResource);
        return $this->htmlResponse();
    }
}

?>
