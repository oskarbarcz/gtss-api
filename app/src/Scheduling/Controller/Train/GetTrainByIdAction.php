<?php

declare(strict_types=1);

namespace App\Scheduling\Controller\Train;

use App\Scheduling\Controller\Resources\TrainDetailedResource;
use App\Scheduling\Entity\Train;
use App\Scheduling\Repository\TrainRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;

final class GetTrainByIdAction extends AbstractController
{
    private TrainRepository $trainRepository;

    public function __construct(TrainRepository $trainRepository)
    {
        $this->trainRepository = $trainRepository;
    }

    #[Route('/api/v1/train/{id}')]
    public function __invoke(Uuid $id): JsonResponse
    {
        $train = $this->trainRepository->find($id);

        if (!$train instanceof Train) {
            $error = [
                'code' => 404,
                'message' => 'Train with given ID was not found.',
            ];

            return new JsonResponse($error, Response::HTTP_NOT_FOUND);
        }

        $resource = new TrainDetailedResource($train);

        return $this->json($resource);
    }
}
