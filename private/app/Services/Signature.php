<?php

namespace App\Services;

use phpseclib\Crypt\RSA;

class Signature
{
    private $plainText;

    public function __construct($plainText)
    {
        $this->plainText = $plainText;
    }

    public function create()
    {
        $rsa = new RSA;
        $rsa->setHash('sha256');
        $rsa->setSignatureMode(RSA::SIGNATURE_PKCS1);
        $rsa->loadKey('-----BEGIN PUBLIC KEY-----
MFswDQYJKoZIhvcNAQEBBQADSgAwRwJAbgYLRCZ7e0FuCIfIwaxZgv5uUWE9tp2S
bzCAe7rYqIkuNvugI/7w7lvEOJt4CYm4KuEddOKzIKvn0hN+XG2NmQIDAQAB
-----END PUBLIC KEY-----');
        $rsa->loadKey('-----BEGIN RSA PRIVATE KEY-----
MIIBOQIBAAJAbgYLRCZ7e0FuCIfIwaxZgv5uUWE9tp2SbzCAe7rYqIkuNvugI/7w
7lvEOJt4CYm4KuEddOKzIKvn0hN+XG2NmQIDAQABAkAM/ZWy9EA8K1uMkku34lun
RddMsIiS2UQC8N0avtL6AyDZxvqxWcMYS+gXqzQCQRVta9PX+VB3PYTff3N3ShMh
AiEAqShJ3P4HaqySuPJvhBkU+8vpkZGVwx1ablnea+EPVK0CIQCmggdu1zaRGz42
fsSLadYT9ZZwCcV6rjpg41InXb2OHQIhAJ+zQrDaP8RNcyQa9n9/cpkadcQR75NK
9iJyxBOTYnbtAiAOF9VfOVICCCdE34ftMOEQwWmhRAJ19sc0Kilq8ZE4tQIgCj4P
UbiHS7ixw5++Q7kzpCTJU8GAALz6EqF4dYPVkWE=
-----END RSA PRIVATE KEY-----');
        return base64_encode($rsa->sign($this->plainText));
    }
}
