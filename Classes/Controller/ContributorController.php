<?php

declare(strict_types=1);

# This file is part of the extension DA Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DABib\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\DABib\Domain\Model\Contributor;
use Digicademy\DABib\Domain\Repository\ContributorRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller to provide contributor data for bibliographic entries
 */
class ContributorController extends ActionController
{
    private ContributorRepository $contributorRepository;

    public function injectContributorRepository(ContributorRepository $contributorRepository): void
    {
        $this->contributorRepository = $contributorRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('contributors', $this->contributorRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(Contributor $contributor): ResponseInterface
    {
        $this->view->assign('contributor', $contributor);
        return $this->htmlResponse();
    }
}

?>
