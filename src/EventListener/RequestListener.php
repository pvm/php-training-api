<?php
namespace App\EventListener;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class RequestListener
{
    public function onKernelRequest(GetResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        // When get raw json data, convert to json
        $this->transform($event->getRequest());
    }

    private function transform(Request $request)
    {
        if ($content = $request->getContent()) {
            $data = json_decode($content, true);
            $request->attributes->replace($data);
        }
    }
}