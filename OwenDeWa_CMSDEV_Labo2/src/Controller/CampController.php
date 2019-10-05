<?php

namespace App\Controller;

use App\Entity\Camps;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;

class CampController extends AbstractController
{
    /**
     * @Route("/add", name="add-page", methods={"GET", "POST"})
     */
    public function addCampPage(\Symfony\Component\HttpFoundation\Request $request)
    {
        $camp = New Camps();
        $form = $this->createFormBuilder($camp)
            ->add('title', TextType::class)
            ->add('quote', TextType::class)
            ->add('date', DateType::class)
            ->add('image', TextType::class)
            ->add('description', TextType::class)
            ->add('watch', CheckboxType::class, [
                'label' => 'Watch',
                'required' => false,
            ])
            ->add('save', SubmitType::class, ['label' => 'Add camp'])
            ->getForm();
        if($request->isMethod('get')){
            return $this->render('camp/add.html.twig', [
                'form' => $form->createView()
            ]);
        }
        if($request->isMethod('post')){
            $data = $request->request->get('form');
            $manager = $this->getDoctrine()->getManager();
            $camp->setTitle($data['title']);
            $camp->setQuote($data['quote']);
            $camp->setDate(new \DateTime($data['date']['day'].'/'.$data['date']['month'].'/'.$data['date']['year']));
            $camp->setImage($data['image']);
            $camp->setDescription($data['description']);
            if(array_key_exists("watch", $data)){
                $camp->setWatch($data['watch']);
            }
            $manager->persist($camp);
            $manager->flush();

            $this->addFlash('succes', 'Camp created');
            return $this->redirectToRoute('welcome');
        }
    }
}
