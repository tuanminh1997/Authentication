<?php
/**
 * Created by PhpStorm.
 * User: tuanminh
 * Date: 05/06/2019
 * Time: 14:43
 */

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleFormType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class ArticleAdminController extends BaseController
{
    /**
     * @Route("/admin/article/new",name="admin_article_new")
     * @IsGranted("ROLE_ADMIN_ARTICLE")
     */
    public function new(EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(ArticleFormType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            /** @var Article $article */
            $article =$form->getData();

            $em->persist($article);
            $em->flush();

            $this->addFlash('success','Article Created!');

            return $this->redirectToRoute('admin_article_list');

        }

        return $this->render('article_admin/new.html.twig',[
            'articleForm' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @Route("/admin/article/location-select", name="admin_article_location_select")
     * @IsGranted("ROLE_USER")
     * @return Response
     */
    public function getSpecificLocationSelect(Request $request)
    {

        if(!$this->isGranted('ROLE_ADMIN_ARTICLE') && $this->getUser()->getArticles()->isEmpty()){
            throw $this->createAccessDeniedException();
        }

        $article= new Article();
        $article->setLocation($request->query->get('location'));
        $form= $this->createForm(ArticleFormType::class, $article);

        if($form->has('specificLocationName')){
            return new Response(null,204);
        }

        return $this->render('article_admin/_specific_location_name.html.twig',[
            'articleForm'=>$form->createView()
        ]);

        
    }

    /**
     * @Route("/admin/article/{id}/edit", name="admin_article_edit")
     * @IsGranted("MANAGE",subject="article")
     */
    public function edit(Article $article, Request $request, EntityManagerInterface $em)
    {

        $form = $this->createForm(ArticleFormType::class,$article,[
            'include_published_at'=>true,
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($article);
            $em->flush();

            $this->addFlash('success', 'Article Updated!');

            return $this->redirectToRoute('admin_article_edit',[
                'id'=>$article->getId()
            ]);
        }
        return $this->render('article_admin/edit.html.twig', [
            'articleForm' => $form->createView()
        ]);
    }

    /**
     * @Route("admin/article",name="admin_article_list")
     * @param ArticleRepository $articleRepo
     * @return Response
     */
    public function list(ArticleRepository $articleRepo)
    {
        $articles = $articleRepo->findAll();
        return $this->render('article_admin/list.html.twig', [
            'articles' => $articles
        ]);

    }

}