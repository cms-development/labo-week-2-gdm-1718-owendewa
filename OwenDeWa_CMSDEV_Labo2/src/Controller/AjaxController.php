<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AjaxController extends AbstractController
{
    /**
     * @Route("/ajax", name="ajax")
     */
    public function index()
    {

        return new Response('test');
    }
    /**
     * @Route("/like", name="ajax-like" , methods={"GET", "POST"})
     */
    public function like(Request $request)
    {

        if($request->request->get('phase')){
            //make something curious, get some unbelieveable data
            $arrData = ['output' => 'liked'];
            return new JsonResponse($arrData);
        }

        return $this->render('detail.html.twig');
    }
    /**
     * @Route("/dislike", name="ajax-dislike" , methods={"GET", "POST"})
     */
    public function dislike(Request $request)
    {

        if($request->request->get('phase')){
            //make something curious, get some unbelieveable data
            $arrData = ['output' => 'disliked'];
            return new JsonResponse($arrData);
        }

        return $this->render('detail.html.twig');
    }

}
