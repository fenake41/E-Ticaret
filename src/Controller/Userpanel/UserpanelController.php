<?php

namespace App\Controller\Userpanel;

use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/userpanel")
 */
class UserpanelController extends AbstractController
{
    /**
     * @Route("/", name="userpanel")
     */
    public function index()
    {
        return $this->render('userpanel/show.html.twig');
    }

    /**
     * @Route("/show", name="userpanel_show", methods="GET")
     */
    public function show()
    {
        return $this->render('userpanel/show.html.twig');
    }
    /**
     * @Route("/edit", name="userpanel_edit", methods="GET|POST")
     */
    public function edit(Request $request): Response
    {
        $usersession = $this->getUser();
        $user = $this->getDoctrine()
            ->getRepository(Users::class)
            ->find($usersession->getid());

        if($request->isMethod('POST')){
            $submittedToken = $request->request->get('token');
            if($this->isCsrfTokenValid('user-form1', $submittedToken)){
                $user->setName($request->request->get("name"));
                $user->setPassword($request->request->get("password"));
                $user->setAdress($request->request->get("adress"));
                $user->setCity($request->request->get("city"));
                $user->setPhone($request->request->get("phone"));
                $this->getDoctrine()->getManager()->flush();
                $this->addFlash('success','Üye Bilgisi Güncellendi');
                return $this->redirectToRoute('userpanel_show');
            }
        }

        return $this->render('userpanel/edit.html.twig', [
            'user'=> $user,
        ]);
    }
}
