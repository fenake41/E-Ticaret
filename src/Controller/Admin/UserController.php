<?php

namespace App\Controller\Admin;

use App\Entity\Users;
use App\Form\UsersType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/admin/user", name="admin_user")
     */
    public function index()
    {
        $users=$this->getDoctrine()
            ->getRepository(Users::class)->findAll();

        return $this->render('admin/user/index.html.twig', [
            'users' => $users,
        ]);
    }
    /**
     * @Route("/admin/user/new", name="admin_user_new")
     */
    public function new(Request $request):Response

    {
        $user = new Users();
        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())  {
            $em=$this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('admin_user');
        }
        return $this->render('admin/user/created_form.html.twig',[
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/admin/user/edit/{id}", name="admin_user_edit")
     */
    public function edit(Request $request, Users $users):Response
    {
        $form=$this->createForm(UsersType::class, $users);
        $form->handleRequest($request);

        if($form->isSubmitted() )  {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('admin_user');
        }
       //echo "mer";
        //die();
        return $this->render('admin/user/edit_form.html.twig',[
            'user'=>$users,
            'form'=> $form->createView(),
        ]);
    }
    /**
     * @Route("/admin/user/delete/{id}", name="admin_user_delete")
     */
    public function delete(Users $users):Response
    {
        $em = $this->getDoctrine()->getManager();
        $em -> remove($users);
        $em->flush();
        return $this->redirectToRoute('admin_user');

    }

}
