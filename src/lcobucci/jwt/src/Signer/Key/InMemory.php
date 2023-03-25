<?php

namespace Lcobucci\JWT\Signer\Key;

use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Encoding\CannotDecodeContent;


use function base64_decode;

final class InMemory extends Key
{

    private string $contents;
    private string $passphrase;



    /**
     * @param string $contents
     * @param string $passphrase
     *
     * @return self
     */
    public static function plainText($contents, $passphrase = '')
    {
        return new self($contents, $passphrase);
    }


    /** @deprecated Deprecated since v4.3 */
    public static function empty(): self
    {
        $emptyKey             = new self('empty', 'empty');
        $emptyKey->contents   = '';
        $emptyKey->passphrase = '';

        return $emptyKey;
    }

    /**
     * @param string $contents
     * @param string $passphrase
     *
     * @return self
     */
    public static function base64Encoded($contents, $passphrase = '')
    {
        $decoded = base64_decode($contents, true);

        if ($decoded === false) {
            throw CannotDecodeContent::invalidBase64String();
        }

        return new self($decoded, $passphrase);
    }

    /**
     * @param string $path
     * @param string $passphrase
     *
     * @return InMemory
     *
     * @throws FileCouldNotBeRead
     */
    public static function file($path, $passphrase = '')
    {
        return new self('file://' . $path, $passphrase);
    }
}
