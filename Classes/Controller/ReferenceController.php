<?php

declare(strict_types=1);

# This file is part of the extension CHF Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBib\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\CHFBib\Domain\Model\Reference;
use Digicademy\CHFBib\Domain\Repository\ReferenceRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for references
 */
class ReferenceController extends ActionController
{
    private ReferenceRepository $referenceRepository;

    public function injectReferenceRepository(ReferenceRepository $referenceRepository): void
    {
        $this->referenceRepository = $referenceRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('references', $this->referenceRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(Reference $reference): ResponseInterface
    {
        $this->view->assign('reference', $reference);
        return $this->htmlResponse();
    }
}

?>
