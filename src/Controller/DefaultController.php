<?php


namespace App\Controller;


use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="home")
     */
    public function index(ProgramRepository $programRepository){

        return $this->render('home.html.twig',[
            'programs' => $programRepository->findAll(),
        ]);
    }

}