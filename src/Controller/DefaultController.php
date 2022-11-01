<?php

namespace App\Controller;

use App\Entity\Product;
use http\Client\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $productList = $entityManager->getRepository(Product::class)->findAll();
        dd($productList);

        return $this->render('main/default/index.html.twig', []);
    }

    /**
     * @Route("/product-add", method="GET", name="product_add")
     */
    public function productAdd(Request $request): Response
    {
        $product = new Product();
        $product->setTitle('Product ' . rand(1, 100));
        $product->setDescription('smth');
        $product->setPrice(10);
        $product->setQuantity(1);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($product);
        $entityManager->flush();

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/edit-product", method="GET|POST", name="product_edit"): Response
     */
    public function editProduct(Request $request): Response
    {
        return $this->render('main/default/edit_product.html.twig', []);
    }
}
