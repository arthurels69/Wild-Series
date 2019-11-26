<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Program;
use App\Entity\Season;
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
    public function index(): Response
    {

        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findAll();

        if (!$programs) {
            throw $this->createNotFoundException(
                'No program found in program\'s table.'
            );
        }
        return $this->render('wild/index.html.twig', [
            'website' => 'Wild Series',
            'programs' => $programs
        ]);
    }

    /**
     * Getting a program with a formatted slug for title
     *
     * @param string $slug The slugger
     * @Route("show/{slug<^[a-z0-9-]+$>}", defaults={"slug" = null}, name="show")
     * @return Response
     */
    public function show(?string $slug): Response
    {
        if (!$slug) {
            throw $this
                ->createNotFoundException('No slug has been sent to find a program in program\'s table.');
        }
        $slug = preg_replace(
            '/-/',
            ' ', ucwords(trim(strip_tags($slug)), "-")
        );
        $program = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findOneBy(['title' => mb_strtolower($slug)]);
        if (!$program) {
            throw $this->createNotFoundException(
                'No program with ' . $slug . ' title, found in program\'s table.'
            );
        }

        return $this->render('wild/show.html.twig', [
            'program' => $program,
            'slug' => $slug,
        ]);
    }


    /**
     * @param string $categoryName
     * @Route("category/{categoryName}", name="show_category")
     * @return Response
     */
    public function showByCategory(string $categoryName): Response
    {

        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneBy(['name' => $categoryName]);
       $categoryId=$category->getId();
        $movies = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findBy(
                ['category' => $categoryId],
                ['id' => 'ASC'],
                6,
                0);
        if (!$movies) {
            throw $this->createNotFoundException(
                'No movies found in ' . $categoryName . ' category table'
            );
        }
        return $this->render('wild/category.html.twig', [
            'movies' => $movies,
            'category'=>$categoryName

        ]);
    }

    /**
     * @param string $slug
     * @Route ("category/program/{slug<^[a-z0-9-]+$>}", defaults={"slug" = null}, name="show_program")
     * @return Response
     */

    public function showByProgram(string $slug){
        $slug = preg_replace(
            '/-/',
            ' ', ucwords(trim(strip_tags($slug)), "-")
        );
        $program=$this->getDoctrine()
            ->getRepository(Program::class)
            ->findOneBy(['title'=>$slug]);
        if (!$program){
            throw $this->createNotFoundException(
                'No program find in list'
            );
        }
        return $this->render('wild/category.html.twig',[
            'program'=>$program
        ]);
    }

    /**
     * @param int $id
     * @Route ("season/{id}", name="show_season")
     * @return Response
     */
    public function showBySeason (int $id){
        $season=$this->getDoctrine()
            ->getRepository(Season::class)
            ->findOneBy(['id'=>$id]);
        if(!$season) {
            throw $this->createNotFoundException(
                'No season find'
            );
        }
        return $this->render('wild/season.html.twig',[
           'season'=>$season
        ]);
        }

}