<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CategoryController
 *
 * @Route("/api/categories")
 * @package App\Controller
 */
class CategoryController extends Controller
{
    /**
     * List all categories
     *
     * @Route(methods={"GET"}, name="category_list")
     *
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function index(EntityManagerInterface $em)
    {
        $categories = $em
                ->getRepository(Category::class)
                ->findAll();

        return $this->json($categories);
    }

    /**
     * Show a Category
     *
     * @Route("/{id}", methods={"GET"}, name="category_show")
     * @param $id
     * @param EntityManagerInterface $em
     *
     * @return JsonResponse
     */
    public function show($id, EntityManagerInterface $em)
    {
        $category = $em
            ->getRepository(Category::class)
            ->find($id);

        if (!$category) {
            throw $this->createNotFoundException('Category not found.');
        }

        return $this->json($category);
    }

    /**
     * Create a category
     *
     * @Route(methods={"POST"}, name="category_create")
     * @param Request $request
     * @param EntityManagerInterface $em
     *
     * @return JsonResponse
     */
    public function store(Request $request, EntityManagerInterface $em)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->submit($request->request->all());

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($category);
            $em->flush();
        }

        return $this->json($category);
    }

    /**
     * Update a category
     *
     * @Route("/{id}", methods={"PUT"}, name="category_update")
     * @param Request $request
     * @param EntityManagerInterface $em
     *
     * @return JsonResponse
     */
    public function update($id, Request $request, EntityManagerInterface $em)
    {
        $category = $em
            ->getRepository(Category::class)
            ->find($id);

        if (!$category) {
            throw $this->createNotFoundException('Category not found.');
        }

        $form = $this->createForm(CategoryType::class, $category);
        $form->submit($request->request->all());
        $em->flush();

        return $this->json($category);
    }

    /**
     * Delete a Category
     *
     * @Route("/{id}", methods={"DELETE"}, name="category_delete")
     * @param $id
     * @param EntityManagerInterface $em
     *
     * @return JsonResponse
     */
    public function delete($id, EntityManagerInterface $em)
    {
        $category = $em
            ->getRepository(Category::class)
            ->find($id);

        if (!$category) {
            throw $this->createNotFoundException('Category not found.');
        }

        $em->remove($category);
        $em->flush();

        return $this->json(null, 204);
    }
}
