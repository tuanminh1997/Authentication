<?php
/**
 * Created by PhpStorm.
 * User: tuanminh
 * Date: 28/05/2019
 * Time: 15:53
 */

namespace App\Controller;


use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Console\Descriptor\JsonDescriptor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Twig\Environment;


class ArticleController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function homepage(){

        return $this->render('article/homepage.html.twig');
    }

    /**
     * @Route("/news/{slug}",name="article_show")
     */
    public function show($slug, Environment $twigEnviroment){
        $comments=['this is comment 1',
            'This is comment 2',
            'This is comment 3'];



        $html= $twigEnviroment->render('article/show.html.twig',[
            'title' => ucwords(str_replace('-','',$slug)),
            'slug'=>$slug,  
            'comments' =>$comments,

        ]);
        return new Response($html);
    }

    /**
     * @Route("/news/{slug}/heart", name="article_toggle_heart",methods={"POST"})
     */
    public function toggleArticleHeart($slug, LoggerInterface $logger){
        $logger->info('OK');
        return new JsonResponse(['hearts'=>rand(5,100)]);

    }

}