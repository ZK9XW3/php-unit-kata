<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\Request\CommanderPizzaRequest;
use App\UseCase\CommanderPizza;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

final class CommanderPizzaController extends AbstractController
{
    public function __construct(
        private readonly CommanderPizza $commanderPizza,
        private readonly SerializerInterface $serializer
    )
    {
    }

    #[Route('/api/commander-pizza', name: self::class, methods: ['POST'])]
    public function __invoke(#[MapRequestPayload] CommanderPizzaRequest $request): JsonResponse
    {
        $response = $this->commanderPizza->__invoke($request);

        return new JsonResponse($this->serializer->serialize($response, 'json'), json: true);
    }
}
