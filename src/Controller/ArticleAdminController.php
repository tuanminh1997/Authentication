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
        $article=new Article();
        $article->setTitle('Bacon')
            ->setSlug('b-a-c-o-n-'.rand(100,999))
            ->setContent('This is content');


        if(rand(1,10)>2){
            $article->setPublishedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));
        }
        $em->persist($article);
        $em->flush();

        return new Response(sprintf("create new article id:#%d slug:%s",
                $article->getId(),
                $article->getSlug())
            );

    }


}