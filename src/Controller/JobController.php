<?php

namespace App\Controller;

use App\Entity\Job;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobController extends AbstractController
{
    /**
     * @Route("/", name="job.list")
     *
     */
    public function list(EntityManagerInterface $em): Response
    {
        $query = $em->createQuery(
            'SELECT j FROM App:Job j WHERE j.expiresAt > :date'
        )->setParameter('date', new \DateTime());
        $jobs = $query->getResult();

        return $this->render('job/list.html.twig', [
            'jobs' => $jobs,
        ]);

        /*         $jobs = $this->getDoctrine()->getRepository(Job::class)->findBy(['activated' => true]);
 */
    }

    /**
     * @Route("/{id}", name="job.show")
     *
     */
    public function show(Job $job): Response
    {
        return $this->render('job/show.html.twig', [
            'job' => $job,
        ]);
    }
}
