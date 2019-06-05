<?php
/**
 * Created by PhpStorm.
 * User: tuanminh
 * Date: 28/05/2019
 * Time: 15:53
 */

namespace App\Controller;


use App\Service\MarkdownHelper;
use App\Service\SlackClient;
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
     * @Route("/")
     */
    public function homepage(){

        return $this->render('article/homepage.html.twig');
    }

    /**
     * @Route("/news/{slug}",name="article_show")
     */
    public function show($slug,MarkdownHelper $markdownHelper, SlackClient $slack){

        if($slug=='khaaaaan') {
             $slack->sendMessage('Khan','Ah, Kirk, my old friend...');

        }

        $comments=['this is comment 1',
            'This is comment 2',
            'This is comment 3'];



        $articleContent=<<<EOF
Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,
lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit
labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow
**turkey** shank eu pork belly meatball non cupim.
Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur
**laboris**  sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,
capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing
picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt
occaecat lorem meatball prosciutto quis strip steak.
Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak
mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon
strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur
cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck
fugiat. 
EOF;

        $articleContent=$markdownHelper->parse($articleContent);

        return $this->render('article/show.html.twig',[
            'title' => ucwords(str_replace('-','',$slug)),
            'slug'=>$slug,
            'articleContent'=>$articleContent,
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