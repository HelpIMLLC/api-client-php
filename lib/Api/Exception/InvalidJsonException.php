<?php
/**
 * PHP version 5.3
 *
 * InvalidJsonException
 *
 * @category helpim
 * @package  api-client-php
 * @author   Helpim <it@help-im.ru>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://help-im.ru
 */
namespace Helpim\Api\Exception;

class InvalidJsonException extends \DomainException {
    private $sourceString;

    public function __construct($message = '', $code = 0, $sourceString = '')
    {
        parent::__construct($message, $code);
        $this->sourceString = $sourceString;
    }

    public function getSourceString()
    {
        return $this->sourceString;
    }
}

