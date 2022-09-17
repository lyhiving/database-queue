<?php

namespace Uvodo\Mailer\Presentation\Api\RequestHandlers;

use Modules\Option\Domain\Exceptions\OptionAlreadyExistsException;
use Modules\Option\Domain\Exceptions\OptionNotFoundException;
use Modules\Plugin\Domain\Context;
use Modules\Plugin\Infrastructure\Helpers\OptionHelper;
use Presentation\Shared\Response\EmptyResponse;
use Presentation\Shared\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use Services\HttpService;

class CreatUpdateSettingsRequestHandler
{
    public function __construct(
        private HttpService $httpService,
        private OptionHelper $optionHelper,
        private Context $context
    ) {
    }

    /**
     * @param ServerRequestInterface $req
     * @return JsonResponse|EmptyResponse
     * @throws OptionAlreadyExistsException
     * @throws OptionNotFoundException
     */
    public function __invoke(ServerRequestInterface $req): JsonResponse|EmptyResponse
    {
        $input = $this->httpService->getInput($req);

        $status = $input->has('status') ? 1 : 0;

        if (!$this->optionHelper->getOption($this->context, 'queue_status')) {
            $this->optionHelper->addOption($this->context, 'queue_status', 0);
        }

        $this->optionHelper->updateOption($this->context, 'queue_status', $status);

        return new EmptyResponse();
    }
}
