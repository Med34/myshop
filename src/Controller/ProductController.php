<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/", name="product.index")
     */
    public function index()
    {
        // Get all products sort by name ascending.
        $repository = $this->getDoctrine()->getRepository(Product::class);
        $products = $repository->findAllSortByName();

        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @param $id Product identifier
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/product/{id}", name="product.show")
     */
    public function show($id) : Response
    {
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);
        if ($product === null) {
            throw new NotFoundHttpException();
        }

        return $this->render('product/show.html.twig', [
            'product'       => $product,
        ]);
    }
}
