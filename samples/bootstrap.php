<?php
/*
 * Sample bootstrap file.
 */

// Include the composer Autoloader
// The location of your project's vendor autoloader.
$composerAutoload = dirname(__DIR__) . '/vendor/autoload.php';

if (!file_exists($composerAutoload)) {
    //If the project is used as its own project, it would use soap-api-sdk-php composer autoloader.
    $composerAutoload = dirname(dirname(dirname(__DIR__))) . '/autoload.php';


    if (!file_exists($composerAutoload)) {
        echo "The 'vendor' folder is missing. You must run 'composer update' to resolve application dependencies.\n
                Please see the README for more information.\n";
        exit(1);
    }
}

require $composerAutoload;
require __DIR__ . '/util.php';

use PayU\Framework\Core\CredentialManager;
use PayU\Framework\Authentication;
use PayU\Framework\Soap\Context;

// Suppress DateTime warnings, if not set already
date_default_timezone_set(@date_default_timezone_get());

// Adding Error Reporting for understanding errors properly
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Replace these values by entering your own SOAP username and password by visiting https://help.payu.co.za/developers
$acct6Username = 'Staging Integration Store 3';
$acct6Password = 'WSAUFbw6';
$acct6Safekey = '{07F70723-1B96-4B97-B891-7BF708594EEA}';
$acct6StoreId = 'Staging Integration Store 3';
$acct6PaymentMethods = 'EFT_PRO';

$acct7Username = '200239';
$acct7Password = '5AlTRPoD';
$acct7Safekey = '{07F70723-1B96-4B97-B891-7BF708594EEA}';
$acct7StoreId = 'Staging Integration Store';
$acct7PaymentMethods = 'CREDITCARD';


/**
 * All default SOAP options are stored in the array inside the Http\Config class. To make changes to those settings
 * for your specific environments, feel free to add them using the code shown below
 * Uncomment line to override any default SOAP options.
 */
//Http\Config::$defaultSoapOptions['trace'] = true;
/** @var Context $apiContext */
$apiContext = getApiContext(
    [
        $acct6Username,
        $acct7Username,
    ],
    [
        $acct6Password,
        $acct7Password,
    ],
    [
        $acct6Safekey,
        $acct7Safekey,
    ],
    [
        $acct6PaymentMethods,
        $acct7PaymentMethods,
    ]
);

return $apiContext;

/**
 * Helper method for getting an APIContext for all calls
 * @param array $usernames Web service username
 * @param array $passwords Web service password
 * @param array $safeKeys safe key
 * @param array $paymentMethods supported payment methods
 * @return array PayU\Soap\Context[]
 * @throws Exception
 */
function getApiContext(array $usernames, array $passwords, array $safeKeys, array $paymentMethods): array
{

    // #### SDK configuration
    // Register the sdk_config.ini file in current directory
    // as the configuration source.

    if (!defined("PYU_CONFIG_PATH")) {
        define("PYU_CONFIG_PATH", __DIR__);
    }

    // ### Api context
    // Use an Context object to authenticate
    // API calls. The username and password for the
    // Authentication class can be retrieved from
    // https://help.payu.co.za/display/developers/Test+Credentials
    $credentialManager = CredentialManager::getInstance();

    $apiContextEnterprise = new Context(
        $credentialManager->getCredentialObject('account1')
    );

    $apiContextRedirect = new Context(
        $credentialManager->getCredentialObject('account2')
    );

    $apiContextFm = new Context(
        $credentialManager->getCredentialObject('account3')
    );

    $apiContextDebitOrder = new Context(
        $credentialManager->getCredentialObject('account4')
    );

    $apiContextRTR = new Context(
        $credentialManager->getCredentialObject('account5')
    );

    $apiContextEFTRedirect = new Context(
        new Authentication(
            $usernames[0],
            $passwords[0],
            $safeKeys[0]
        )
    );

    $apiContextCCToken = new Context(
        new Authentication(
            $usernames[1],
            $passwords[1],
            $safeKeys[1]
        )
    );

    // Comment this line out and uncomment the PP_CONFIG_PATH
    // 'define' block if you want to use static file
    // based configuration

    $apiContextEnterprise->setConfig(
        [
            'mode' => 'sandbox',
            'log.log_enabled' => true,
            'log.file_name' => __DIR__ . '/PayU.log',
            'log.log_level' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
            'cache.enabled' => true,
            'account1.payment_methods' => $apiContextEnterprise->get('account1.payment_methods'),
            'http.connect_timeout' => 1800,
            'log.adapter_factory' => '\PayU\Log\DefaultLogFactory' // Factory class implementing \PayU\Log\PayULogFactory
        ]
    );

    $apiContextRedirect->setConfig(
        [
            'mode' => 'sandbox',
            'log.log_enabled' => true,
            'log.file_name' => __DIR__ . '/PayU.log',
            'log.log_level' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
            'cache.enabled' => true,
            'account2.payment_methods' => $apiContextEnterprise->get('account2.payment_methods'),
            'http.connect_timeout' => 30,
            'log.adapter_factory' => '\PayU\Log\DefaultLogFactory' // Factory class implementing \PayU\Log\PayULogFactory
        ]
    );

    $apiContextFm->setConfig(
        [
            'mode' => 'sandbox',
            'log.log_enabled' => true,
            'log.file_name' => __DIR__ . '/PayU.log',
            'log.log_level' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
            'cache.enabled' => true,
            'account3.payment_methods' => $apiContextEnterprise->get('account3.payment_methods'),
            'http.connect_timeout' => 30,
            'log.adapter_factory' => '\PayU\Log\DefaultLogFactory' // Factory class implementing \PayU\Log\PayULogFactory
        ]
    );

    $apiContextDebitOrder->setConfig(
        [
            'mode' => 'sandbox',
            'log.log_enabled' => true,
            'log.file_name' => __DIR__ . '/PayU.log',
            'log.log_level' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
            'cache.enabled' => true,
            'account4.payment_methods' => $apiContextEnterprise->get('account4.payment_methods'),
            'http.connect_timeout' => 30,
            'log.adapter_factory' => '\PayU\Log\DefaultLogFactory' // Factory class implementing \PayU\Log\PayULogFactory
        ]
    );

    $apiContextRTR->setConfig(
        [
            'mode' => 'sandbox',
            'log.log_enabled' => true,
            'log.file_name' => __DIR__ . '/PayU.log',
            'log.log_level' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
            'cache.enabled' => true,
            'account5.payment_methods' => $apiContextEnterprise->get('account5.payment_methods'),
            'http.connect_timeout' => 30,
            'log.adapter_factory' => '\PayU\Log\DefaultLogFactory' // Factory class implementing \PayU\Log\PayULogFactory
        ]
    );

    $apiContextEFTRedirect->setConfig(
        [
            'mode' => 'sandbox',
            'log.log_enabled' => true,
            'log.file_name' => __DIR__ . '/PayU.log',
            'log.log_level' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
            'cache.enabled' => true,
            'account6.payment_methods' => $paymentMethods[0],
            'http.connect_timeout' => 30,
            'log.adapter_factory' => '\PayU\Log\DefaultLogFactory' // Factory class implementing \PayU\Log\PayULogFactory
        ]
    );

    $apiContextCCToken->setConfig(
        [
            'mode' => 'sandbox',
            'log.log_enabled' => true,
            'log.file_name' => __DIR__ . '/PayU.log',
            'log.log_level' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
            'cache.enabled' => true,
            'account6.payment_methods' => $paymentMethods[1],
            'http.connect_timeout' => 30,
            'log.adapter_factory' => '\PayU\Log\DefaultLogFactory' // Factory class implementing \PayU\Log\PayULogFactory
        ]
    );

    return [
        $apiContextEnterprise,
        $apiContextRedirect,
        $apiContextFm,
        $apiContextDebitOrder,
        $apiContextRTR,
        $apiContextEFTRedirect,
        $apiContextCCToken
    ];
}
