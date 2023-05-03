<?php


namespace App\Service;

use App\Entity\Menu;
use Doctrine\ORM\EntityManagerInterface;

class MenuService
{
    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    public function getMenu()
    {

        return $this->em->getRepository(Menu::class)->findAll();
    }

}