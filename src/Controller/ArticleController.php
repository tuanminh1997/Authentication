<?php
/**
 * Created by PhpStorm.
 * User: tuanminh
 * Date: 28/05/2019
 * Time: 15:53
 */

namespace App\Controller;


use App\Entity\Article;
use App\Service\MarkdownHelper;
use App\Service\SlackClient;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Console\Descriptor\JsonDescriptor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;


class ArticleController extends AbstractController
{
    /**
     * @var bool
     */
    private $isDebug;

    public function __construct(bool $isDebug)
    {

        $this->isDebug = $isDebug;
    }
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage(EntityManagerInterface $em){

        $repository =$em->getRepository(Article::class);
        $articles=$repository->findBy([],['publishedAt'=>'DESC']);

        return $this->render('article/homepage.html.twig',[
                'articles'=>$articles,
            ]);
    }

    /**
     * @Route("/news/{slug}",name="article_show")
     */
    public function show($slug, SlackClient $slack, EntityManagerInterface $em){

        if($slug=='khaaaaan') {
             $slack->sendMessage('Khan','Ah, Kirk, my old friend...');

        }
        $repository = $em->getRepository(Article::class);
        /** @var Article $article */
        $article=$repository->findOneBy(['slug'=>$slug]);

        if(!$article){
            throw $this->createNotFoundException(sprintf('No article for slug "%s"', $slug));
        }

        $comments=['this is comment 1',
            'This is comment 2',
            'This is comment 3'];

        return $this->render('article/show.html.twig',[
            'article'=>$article,
            'comments' =>$comments,
        ]);
    }

    /**
     * @Route("/news/{slug}/heart", name="article_toggle_heart",methods={"POST"})
     */
    public function toggleArticleHeart($slug, LoggerInterface $logger){
        $logger->info('OK');
        return new JsonResponse(['hearts'=>rand(5,100)]);

    }

}