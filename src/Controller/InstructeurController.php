<?php


namespace App\Controller;


use App\Entity\Activiteiten;
use App\Entity\Lessen;
use App\form\type\ActiviteitType;
use App\form\type\LesType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class InstructeurController extends AbstractController
{
    /**
     * @Route("/instructeur/activiteit", name="edit_act")
     */
    public function editEntity()
    {
        $les = $this->getDoctrine()
            ->getRepository(Lessen::class)
            ->findAll();

        if (!$les) {
            throw $this->createNotFoundException(
                'No products found '
            );
        }

        return $this->render("/instructeur/activiteitEdit.html.twig", [
            'lessen' => $les]);
    }


    /**
     * @Route("/instructeur/{id}" , name="delete_les")
     */
    public function deleteAction($id)
    {
        $les = $this->getDoctrine()
            ->getRepository(Lessen::class)
            ->find($id);
        if (!$les) {
            throw $this->createNotFoundException(
                'No products found '
            );
        }
        $enitymanager = $this->getDoctrine()->getManager();
        $enitymanager->remove($les);
        $enitymanager->flush();

        return $this->redirectToRoute("edit_act");
    }

//    /**
//     * @Route("/instructeur/update/{id}" , name="aanpassen_activiteit")
//     */
//    public function updateAction(Request $request, $id)
//    {
//        $entityManager = $this->getDoctrine()->getManager();
//        $activiteit = $entityManager->getRepository(Activiteiten::class)->find($id);
//
//        if (!$activiteit) {
//            throw $this->createNotFoundException(
//                'No product found for id ' . $id
//            );
//        }
//
//
//        $form = $this->createForm(ActiviteitType::class, $activiteit);
//        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid()) {
//            $activiteit = $form->getData();
//            $entityManager->persist($activiteit);
//            $entityManager->flush();
//
//
//            return $this->redirectToRoute('lijst_activiteit', [
//                'id' => $activiteit->getId()]);
//        }
//        return $this->render('directeur/activiteitAanpassen.html.twig' , [
//            'form' => $form->createView()]);
//
//    }

    /**
     * @Route("/instructeur/update/{id}" , name="aanpassen")
     */
    public function updateAction(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $lessen = $entityManager->getRepository(Lessen::class)->find($id);

        if (!$lessen) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }


        $form = $this->createForm(LesType::class, $lessen);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $lessen = $form->getData();
            $entityManager->persist($lessen);
            $entityManager->flush();


            return $this->redirectToRoute('edit_act', [
                'id' => $lessen->getId()]);
        }
        return $this->render('instructeur/formIn.html.twig' , [
            'form' => $form->createView()]);

    }
    /**
     * @Route("Instructeur/les/form", name="inst_form_show")
     */
    public function new(Request $request)
    {
        // creates a task object and initializes some data for this example
        $les= new Lessen();


        $form = $this->createForm(LesType::class, $les);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $les = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($les);
            $entityManager->flush();

            return $this->redirectToRoute('lijst_activiteit');
        }
        return $this->render('/instructeur/lesToevoegen.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
