<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Form\ArticleType;
use App\Form\CategoryType;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractBaseController
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    /**
     * @Route("/category",name="category_list", methods={"GET"})
     */
    public function list(CategoryRepository $categoryRepository)
    {
        $category  = $categoryRepository->findAll();
        return $this->json(["category"=> $category],
            Response::HTTP_OK,
            [],
            ["groups" => "category:detail"]
        );
    }


    /**
     * @Route("/category/{id}", name="category_get_unique", methods={"GET"})
     */
    public function item(Category $category)
    {
        return $this->json(["category"=> $category],
            Response::HTTP_OK,
            [],
            ["groups" => "category:detail"]
        );

    }


    /**
     * @Route("/category", name="category_add", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function add(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $category = new Category();
        $form = $this->createForm(CategoryType::class,$category);
        $form->submit($data);

        if($form->isValid()){
            $this->em->persist($category);
            $this->em-> flush();
            return $this->json(
                $category,
                Response::HTTP_CREATED,
                [],
                ["groups" => "category:detail"]
            );
        }
        $errors = $this->getFormErrors($form);
        return $this->json($errors);
    }


    /**
     * @Route("/category/{id}", name="category_delete_one", methods={"DELETE"})
     */
    public function delete(Category $category)
    {
        $this->em->remove($category);
        $this->em->flush();
        return $this->json($category,
            Response::HTTP_OK,
            [],
            ["groups" => "category:detail"]
        );
    }


    /**
     * @Route("/category/{id}", name="category_update_one", methods={"PATCH"})
     */
    public function patch(Request $request, Category $category)
    {
        return  $this->update(false,$request,$category);
    }


    /**
     * @Route("/category/{id}", name="category_update", methods={"PUT"})
     */
    public function put(Request $request, Category $category)
    {
        return  $this->update(true,$request,$category);
    }




    private function update(Bool $clearMissing,Request $request, Category $category ){
        $data = json_decode($request->getContent(), true);
        $form = $this->createForm(CategoryType::class,$category);
        $form->submit($data, $clearMissing);
        if($form->isValid()){
            $this->em->persist($category);
            $this->em-> flush();
            return $this->json($category,
                Response::HTTP_OK,
                [],
                ["groups" => "category:detail"]
            );
        }
        $errors = $this->getFormErrors($form);
        return $this->json($errors);
    }




}
