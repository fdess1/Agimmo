<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 20/12/2018
 * Time: 10:27
 */

namespace App\Controller;



use App\Entity\Image;
use App\Form\ImageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    /*
    public function index (Request $request):Response  { return $this->render('create-image.html.twig');}
*/
    /**
     * @Route("/upload/Image")
     *
     */


    public function createImage(Request $request):Response
    {
        $image = new Image();
        $crefrm = $this->createForm(ImageType::class, $image);
        $crefrm->handleRequest($request);
        if ($crefrm->isSubmitted()&& $crefrm->isValid()) {
            $image = $crefrm->getData();
            $mngr = $this->getDoctrine()->getManager();
            $mngr->persist($image);
            $mngr->flush();
            $this->addFlash('success', 'image enregistree');
        }
        return $this->render ('create-image.html.twig', [
            'createForm'=> $crefrm->createView()
        ]);

    }
}