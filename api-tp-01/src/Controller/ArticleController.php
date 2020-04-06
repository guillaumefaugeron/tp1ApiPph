<?php

namespace App\Controller;
use App\Entity\Article;
use App\Entity\Category;
use App\Form\ArticleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

class ArticleController extends AbstractBaseController
{


    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    /**
     * @Route("/article",name="article_list", methods={"GET"})
     */
    public function list(ArticleRepository $articleRepository)
    {
        $article  = $articleRepository->findAll();
        return $this->json(["articles"=> $article],
            Response::HTTP_OK,
            [],
            ["groups" => "article:detail"]
        );
    }


    /**
     * @Route("/article/{id}", name="article_get_unique", methods={"GET"})
     */
    public function item(Article $article)
    {
        return $this->json(["article"=> $article],
            Response::HTTP_OK,
            [],
            ["groups" => "article:detail"]
        );

    }


    /**
     * @Route("/article", name="article_add", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function add(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $article = new Article();
        $form = $this->createForm(ArticleType::class,$article);
        $form->submit($data);

        if($form->isValid()){
            $this->em->persist($article);
            $this->em-> flush();
            return $this->json(
                $article,
                Response::HTTP_CREATED,
                [],
                ["groups" => "article:detail"]
            );
        }
        $errors = $this->getFormErrors($form);
        $form['status']->getErrors();
        return $this->json($errors);
    }


    /**
     * @Route("/article/{id}", name="article_delete_one", methods={"DELETE"})
     */
    public function delete(Article $article)
    {
        $this->em->remove($article);
        $this->em->flush();
        return $this->json($article,
            Response::HTTP_OK,
            [],
            ["groups" => "article:detail"]
        );
    }


    /**
     * @Route("/article/{id}", name="article_update_one", methods={"PATCH"})
     */
    public function patch(Request $request, Article $article)
    {
        return  $this->update(false,$request,$article);
    }


    /**
     * @Route("/article/{id}", name="article_update", methods={"PUT"})
     */
    public function put(Request $request, Article $article)
    {
        return  $this->update(true,$request,$article);
    }




    private function update(Bool $clearMissing,Request $request, Article $article ){
        $data = json_decode($request->getContent(), true);
        $form = $this->createForm(ArticleType::class,$article);
        $form->submit($data, $clearMissing);
        if($form->isValid()){
            $this->em->persist($article);
            $this->em-> flush();
            return $this->json($article,
                Response::HTTP_OK,
                [],
                ["groups" => "article:detail"]
            );
        }
        $errors = $this->getFormErrors($form);
        $form['status']->getErrors();
        return $this->json($errors);
    }

    /**
     * @Route("/articlepopular", name="popular_article_list", methods={"GET"})
     */
    public function list_popular(ArticleRepository $articleRepository)
    {
        $article = $articleRepository->findBy(array("trending" => 1));
        return $this->json(["article"=> $article],
            Response::HTTP_OK,
            [],
            ["groups" => "article:detail"]
        );
    }

    /**
     * @Route("/articleCategory/{id}", name="articlePopular", methods={"GET"})
     */
    public function articleCategory(ArticleRepository $articleRepository, Category $category)
    {
        $articles = $articleRepository->findBy(array('category_id' => $category->getId()));
        return $this->json(
            [$articles],
            Response::HTTP_OK,
            [],
            ["groups" => "article:detail"]
        );
    }


}
