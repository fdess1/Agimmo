<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 03/12/2018
 * Time: 11:26
 */

namespace App\Controller;


use App\Entity\Bien;
use App\Form\BienType;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;



class BienController extends AbstractController
{
    /** home il faut bien arriver qq part
     * @Route("/")
     *
     */
    public function home():Response   {
      //  $url = $this->generateUrl( 'app_bien_biensactifs', ['noproj'=>143]);
        // var_dump ($url); die ('test generateUrl');

        // recup du repository des biens
        $bienrep = $this->getDoctrine()->getRepository(Bien::class);
        // recup des biens
        $biens = $bienrep->findAll();


        return $this->render('Bien/listeBiens.html.twig', [ 'biens'=>$biens]);
    }


    /** biensActifs la liste des seuls biens actifs
     * @Route("/biensactifs")
     *
     */
    public function biensActifs():Response   {
      //  $url = $this->generateUrl( 'app_bien_biensactifs', ['noproj'=>143]);
        // var_dump ($url); die ('test generateUrl');

        // recup du repository des project
        $bienrep = $this->getDoctrine()->getRepository(Bien::class);
        // recup des projets
        // $projs = $projrep->findAll();
        $biens = $bienrep->findAll();
        // var_dump ($biens); // die ("Adieu");

        return $this->render('Bien/listeBiens.html.twig', [ 'biens'=>$biens]);
    }
    /**
     * @Route("/thanks")
     *
     */
    public function thanks() {
        return new Response( '<html><body><h1>special thanks</h1>Et encore merci à tous, pour tout</body></html>');
    }
    /**
     * @Route("/bien/{nobien}",requirements={"nobien"="\d+"})
     *
     */
    public function biendetail(int $nobien=1 ):Response  {
        $bienrep = $this->getDoctrine()->getRepository(Bien::class);
        // recup des biens
        $bien = $bienrep->find($nobien);
        if (is_null( $bien)){
            $this->addFlash('error', "Bien $nobien non trouvé , Jean-Claude");
            throw $this->createNotFoundException("Bien $nobien non trouvé, Jean-Luc");
            return $this->render('errors/error404.html.twig');// inutile, je pense
        }
        dump($bien);
        // recup langages
        //$langages = $proj->getLangages();
           // var_dump($langages); die ('langages');

        return $this->render('Bien/afficheBiens.html.twig', [ 'bien'=>$bien
            //,'langages'=>$langages
        ]);
    }

    /**
     * @Route("/session")
     *
     */
    public function createSession (SessionInterface $session):Response     {
        $session->set('MonNom', 'Frederic DESSAIN');
        return $this->redirectToRoute('index');

        // var_dump($session); die ('test recup session');
    }

    /**
     * @Route("/depuissession")
     *
     */
    public function recupDepuisSession (SessionInterface $session):Response     {
        $nom = $session->get('MonNom'); return new Response("Nom : $nom");
        // var_dump($session); die ('test recup session');
    }
    /**
     * @Route("/flash/create")
     *
     */
    public function createFlash(){
        $this->addFlash('success', 'RIEN correctement ajouté');
        return $this->redirectToRoute('index');
    }

    /**
     * @Route("/create/manuel")
     *
     */
    public function createManuel(): Response
    {
        // creation d'un projet
        $bien = new Bien();
        // Remplissage du projet
        $bien->setNomUsage('La maison des 3 petits cochons');
        $bien->setAd1('15 rue du Loup Pendu');
        $bien->setCp('91570');
        $bien->setBnType('INDIV');
        $bien->setDescrAcces('Après le bois qui fait peur, prendre à gauche le chemin en cul de sac'); // descr_acces
        $bien->setVille('Bievres');
        $bien->setCodePays('FR');
        $bien->setPrix(1055.2);
        $bien->setSurfaceHabitable(402);// grannnnd
        $bien->setNbloyesParAn(12);// grannnnd
        $bien->setTypeChauffage ('Gaz');
        $bien->setHautDebit ('FIBRE paternelle');

        // var_dump ($projet); die ('Pour voir');

    // Etape 3 : Enregistrer l’instance en BDD. Pour cela on se sert de Doctrine :


        $manager = $this->getDoctrine()->getManager();  // Recup de doctrine

        $manager->persist ($bien);  // prepa du sql

        $manager->flush();  // Exe du sql
        // Redirection vers l'accueil
        $this->addFlash('success', 'Bien "'. $bien->getNomUsage () . '" inséré en base, Jean-Luc. Et encore merci');
        return $this->redirectToRoute('app_bien_biensactifs');
    }

    /** modif_bien : modif d'un bien, la plus automatique possible
     * @Route("/bien/maj/{id}")
     * @param Request $request
     * @param Bien $bien
     * @return Response
     */
    public function modif_bien(Request $request, Bien $bien): Response
    { // Modif du projet
        if ($bien )
            $em = $this->getDoctrine()->getManager();
        if (! $bien || ! $em) {
            throw NotFoundHttpException ("Bien '".$bien->getBnId()."' non trouvé");
        }
        $nom = $bien->getNomUsage() ." (".$bien->getBnId().')';
        $form = $this->createForm(BienType:: class, $bien );
        // Recup donnees _POSTS
        $form->handleRequest( $request);
        // Verif validité des donnes
        if ($form->isSubmitted() && $form->isValid()) {
            $bien = $form->getData();
            // Et puis on insert
            $mngr = $this->getDoctrine()->getManager();
            $mngr->persist($bien);
            $mngr->flush();
            $this->addFlash('success', 'Bien "' . $nom . '" mis à jour');
            // redirection
            return $this->redirectToRoute('app_bien_biensactifs');
        }

        return $this->render( "Bien/modifBien.html.twig", [
            'createForm' => $form->createView()
        ]);


    }
    /** del_bien : detruit un projet, la plus automatique possible
     * @Route("/bien/suppr/{id}")
     * @param Bien $bien
     * @return Response
     */
    public function del_bien(Bien $bien): Response
    {
        if ($bien )    $em = $this->getDoctrine()->getManager();
        if (! $bien || ! $em) {
            throw NotFoundHttpException ("Bien non trouvé");
        }
        $name = $bien->getNomUsage() ." (".$bien->getBnId().')';
        $em->remove($bien);
        $em->flush();

        $this->addFlash('warning', 'Bien ' .  $name . ' correctement supprimé');
        return $this->redirectToRoute( "index");
    }

    /** new_proj : detruit un projet, la plus automatique possible
     * @Route("/bien/add")
     * @param Request $request
     * @return Response
     */
    public function new_bien(Request $request): Response
    { // Création d'un nouveau bien
        $bien = new Bien();
        // creation
        $form = $this->createForm(BienType:: class, $bien );

        // Recup donnees _POSTS
        $form->handleRequest( $request);
        // Verif validité des donnes
        if ($form->isSubmitted() && $form->isValid()) {
            $bien = $form->getData();
            // Et puis on insert
            $mngr = $this->getDoctrine()->getManager();
            $mngr->persist ($bien);
            $mngr->flush ();
            $this->addFlash('success', 'Bien ' . $bien->getNomUsage() . ' créé');
            // redirection
            return $this->redirectToRoute('app_bien_biensactifs');
        }

        return $this->render( "Bien/creeBien.html.twig", [
            'createForm' => $form->createView()
        ]);

    }
}