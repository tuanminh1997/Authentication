<?php
/**
 * Created by PhpStorm.
 * User: tuanminh
 * Date: 06/06/2019
 * Time: 08:14
 */

namespace App\Controller;




use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\CommentRepository;
use App\Service\SlackClient;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;



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
     * @Route("/")
     */
    public function homepage( ArticleRepository $repository){

        $articles=$repository->findAllPublishedOrderbyNewest();
        return $this->render('article/homepage.html.twig',[
            'articles'=>$articles,
        ]);
    }

    /**
     * @Route("/news/{slug}",name="article_show")
     */
    public function show(Article $article, SlackClient $slack, CommentRepository $commentRepository){

        if($article=='khaaaaan') {
            $slack->sendMessage('Khan','Ah, Kirk, my old friend...');

        }
        return $this->render('article/show.html.twig',[
            'article'=>$article,
        ]);
    }

    /**
     * @Route("/news/{slug}/heart", name="article_toggle_heart",methods={"POST"})
     */
    public function toggleArticleHeart(Article $article, LoggerInterface $logger, EntityManagerInterface $em){
        $article->incrementHeartCount();
        $em->flush();
        $logger->info('OK');
        return new JsonResponse(['hearts'=>$article->getHeartCount()]);


    }


}