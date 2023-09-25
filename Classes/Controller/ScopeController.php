<?php

declare(strict_types=1);

# This file is part of the extension CHF Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBib\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\CHFBib\Domain\Model\Scope;
use Digicademy\CHFBib\Domain\Repository\ScopeRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for scopes
 */
class ScopeController extends ActionController
{
    private ScopeRepository $scopeRepository;

    public function injectScopeRepository(ScopeRepository $scopeRepository): void
    {
        $this->scopeRepository = $scopeRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('scopes', $this->scopeRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(Scope $scope): ResponseInterface
    {
        $this->view->assign('scope', $scope);
        return $this->htmlResponse();
    }
}

?>
