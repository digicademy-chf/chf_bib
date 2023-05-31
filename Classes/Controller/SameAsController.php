<?php

declare(strict_types=1);

# This file is part of the extension DA Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DABib\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\DABib\Domain\Model\SameAs;
use Digicademy\DABib\Domain\Repository\SameAsRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller to provide a link to the same entity at a different URI
 */
class SameAsController extends ActionController
{
    private SameAsRepository $sameAsRepository;

    public function injectSameAsRepository(SameAsRepository $sameAsRepository): void
    {
        $this->sameAsRepository = $sameAsRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('sameass', $this->sameAsRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(SameAs $sameAs): ResponseInterface
    {
        $this->view->assign('sameas', $sameAs);
        return $this->htmlResponse();
    }
}

?>
