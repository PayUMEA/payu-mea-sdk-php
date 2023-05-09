<?php
/**
 * PayU MEA PHP SDK
 *
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link http://www.payu.co.za
 * @link http://help.payu.co.za/developers
 * @author Kenneth Onah <kenneth@netcraft-devops.com>
 */

namespace PayU\Auth;

/**
 * Class BasicAuth
 *
 * @package PayU\Auth
 */
class BasicAuth
{
    /**
     * Web service username as obtained from the safe shop portal
     *
     * @var string $username
     */
    private $username;

    /**
     * Web service password as obtained from the safe shop portal
     *
     * @var string $password
     */
    private $password;

    /**
     * Safe key as obtained from the safe shop portal
     *
     * @var string $safekey
     */
    private $safekey;

    /**
     * Construct
     *
     * @param string $username web service username obtained from the safe shop portal
     * @param string $password web service password obtained from the safe shop portal
     * @param string $safekey safe key obtained from the safe shop portal
     */
    public function __construct($username, $password, $safekey)
    {
        $this->username = $username;
        $this->password = $password;
        $this->safekey = $safekey;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get safe key
     *
     * @return string
     */
    public function getSafekey()
    {
        return $this->safekey;
    }
}
