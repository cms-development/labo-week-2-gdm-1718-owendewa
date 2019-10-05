<?php

namespace App\Controller;

use App\Entity\Camps;
use App\Entity\Reactions;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WelcomeController extends AbstractController
{
    /**
     * @Route("/", name="welcome")
     */
    public function index()
    {
        $manager = $this->getDoctrine()->getManager();
        $repository = $manager->getRepository(Camps::class);
        $camps = $repository->findBy(array(),array('id'=>'DESC'),4,0);

        $watchcamps = $repository ->findBy(array('watch' => 1));
        shuffle($watchcamps);
        return $this->render('welcome/index.html.twig', [
            'controller_name' => 'WelcomeController',
            'camps' => $camps,
            'watchcamps' => $watchcamps
        ]);
    }


}
