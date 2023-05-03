<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\PageRepository;
use App\Service\MenuService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    protected $menus;
    public function __construct(MenuService $menuService)
    {
        $this->menus = $menuService->getMenu();
    }

    /**
     * @Route("/", name="app_home")
     */
    public function index(ArticleRepository  $articleRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $article = $paginator->paginate(
            $articleRepository->findBy(['isPublish' => true],['date' => 'DESC']), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            4/*limit per page*/
        );
        return $this->render('home/index.html.twig', [
            'articles' => $article,
            'menus' => $this->menus
        ]);
    }

    /**
     * @Route("/views/{id}", name="articleView")
     */
    public function articleView(int $id, ArticleRepository  $articleRepository, Request $request): Response
    {
        $article = $articleRepository->findOneBy(['id' => $id]);
        return $this->render('home/article.html.twig', [
            'article' => $article,
            'menus' => $this->menus
        ]);
    }

    /**
     * @Route("/about", name="app_about")
     */
    public function aboutPage(PageRepository $pageRepository): Response
    {
        $about = $pageRepository->findOneBy(['id' => 1]);
        return $this->render('home/about.html.twig', [
            'about' => $about,
            'menus' => $this->menus
        ]);
    }


}
