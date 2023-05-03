<?php

namespace App\Controller;

use App\Service\MenuService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    protected $menus;
    public function __construct(MenuService $menuService)
    {
        $this->menus = $menuService->getMenu();
    }

    /**
     * @Route("/admin", name="app_admin")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', ['menus' => $this->menus]);
    }
}
