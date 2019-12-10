<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Form\ProgramSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category")
     * @isGranted("ROLE_ADMIN")
     */
    public function index(Request $request) : Response
    {
        $category=new Category();
        $form=$this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        $EnMana=$this->getDoctrine()->getManager();
        if($form->isSubmitted()){
            $EnMana->persist($category);
            $EnMana->flush();
            return $this->redirectToRoute('category');
        }

        return $this->render('category/index.html.twig', [
            'form'=>$form->createView()
        ]);
    }



}
