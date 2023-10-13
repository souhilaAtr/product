<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use App\Repository\ServiceRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(ProductRepository $productRepository): Response
    {
        $produits = $productRepository->findAll();
        // dd($produits);

        return $this->render('product/index.html.twig', [
            "produits" => $produits
        ]);
    }

    #[Route('/service', name: "service")]
    public function afficherservice(ServiceRepository $sv)
    {
        $services =  $sv->findAll();
        return $this->render('product/afficheservice.html.twig', [
            "services" => $services
        ]);
    }


    #[Route('/produit/ajout', name: "ajoutproduit")]
    public function ajoutProduit(Request $request, ManagerRegistry $managerRegistry)
    {
        $produit = new Product();

        $form = $this->createForm(ProductType::class, $produit);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $managerRegistry->getManager();
            $manager->persist($produit);
            $manager->flush();
            return $this->redirectToRoute("app_product");
        }

        return $this->render("product/ajoutproduit.html.twig", [
            "produit" => $produit,
            "fromulaire" => $form->createView()
        ]);
    }
}
