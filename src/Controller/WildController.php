<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class WildController
 * @package App\Controller
 * @Route("wild/", name="wild_")
 */

class WildController extends AbstractController
{
    /**
     * @Route("index", name="index")
     */
    public function index() :Response{
        return $this->render('wild/index.html.twig', [
            'website' => 'Wild Series',
        ]);
    }

    /**
     * @param string $slug
     * @return Response
     * @Route("show/{slug}",
     *     requirements={"slug"="[a-z0-9\-]+"},
     *     defaults={"slug"="Aucune série sélectionnée, veuillez choisir une série"},
     *     name="show"
     * )
     */

    public function show( string $slug)
    {
        $slug=ucwords(str_replace("-", " ", $slug));
        var_dump($slug);
        return $this->render('wild/show.html.twig',[
            'slug'=>$slug
        ]);
    }

}