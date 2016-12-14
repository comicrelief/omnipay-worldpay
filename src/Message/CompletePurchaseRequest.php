<?php

namespace Omnipay\WorldPay\Message;

use Omnipay\Common\Exception\InvalidResponseException;

/**
 * WorldPay Complete Purchase Request
 */
class CompletePurchaseRequest extends PurchaseRequest
{
    public function getData()
    {
        if ($this->httpRequest->getMethod() === 'POST') {
            $callbackPW = (string) $this->httpRequest->request->get('callbackPW');

            if ($callbackPW !== $this->getCallbackPassword()) {
                throw new InvalidResponseException("Invalid callback password");
            }

            $data = $this->httpRequest->request->all();
        } else {
            $data = $this->httpRequest->query->all();
        }

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new CompletePurchaseResponse($this, $data);
    }
}
