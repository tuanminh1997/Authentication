<?php
/**
 * Created by PhpStorm.
 * User: tuanminh
 * Date: 05/06/2019
 * Time: 14:43
 */

namespace App\Controller;


use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleAdminController extends AbstractController
{
    /**
     * @Route("/admin/article/new")
     */


    public function new(EntityManagerInterface $em){

            die('todo');
        return new Response(sprintf("create new article id:#%d slug:%s",
                $article->getId(),
                $article->getSlug())
            );

    }


}