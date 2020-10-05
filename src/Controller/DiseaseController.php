<?php

namespace App\Controller;

use App\Entity\Disease;
use App\Entity\PrescriptionLog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DiseaseController extends AbstractController
{
    /**
     * @param $id
     * @return JsonResponse
     * @Route("/disease/{id}", name="disease", requirements={"page" = "\d+"}, methods={"GET", "POST"})
    */
    public function getDiseaseById(Request $request, int $id): JsonResponse
    {
        $parameterArray = [];
        if ($content = $request->getContent()) {
            $parameterArray = json_decode($content, true);
        }

        $repository = $this->getDoctrine()->getRepository(Disease::class);
        $disease = $repository->find($id);

        if (!empty($parameterArray['name'])) {
            $prescriptionLog = new PrescriptionLog();
            $prescriptionLog->setName($parameterArray['name']);
            $prescriptionLog->setDate(new \DateTime());
            $prescriptionLog->setDisease($disease);
            $em = $this->getDoctrine()->getManager();
            $em->persist($prescriptionLog);
            $em->flush();
        }

        return $this->json($disease);
    }
}
