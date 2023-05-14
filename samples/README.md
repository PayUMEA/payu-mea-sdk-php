# SOAP API Samples

These examples are created to demonstrate PayU MEA PHP SDK capabilities. The demo is designed to demonstrate the default use-cases for each payment flow.

This sample project is a simple PHP app that you can explore to understand what PayU APIs can do for you. Irrespective of how you installed your SDK, you should be able to get the demo running by following the instructions below:

## Requirements
1. PHP 8.0 and later
2. PHP extensions:
```php
ext-json
ext-soap
ext-xml
```
## Viewing Sample Code
We recommend you run the demo locally and try each payment flow. However, you can view the demo source code by clicking `Source` Button next to it each payment flow when the application running.

## Instructions

PHP provides [ built-in support ]( http://php.net/manual/en/features.commandline.webserver.php) for hosting PHP application.

Note: The root directory for composer based installation would be `vendor` and for direct download from the repository it would be `payu-mea-sdk-php-master`. Please update the commands accordingly.

1. Run `php -f payu-mea-sdk-php-master/samples/index.php` from your project root directory.
2. This would host a PHP server at `localhost:5500`. The output should look something like this:
    
    ```
    <!-- Welcome to PayU MEA SDK PHP -- >
    [Sat May 13 16:14:23 2023] PHP 8.1.17 Development Server (http://localhost:5500) started
    ```
3. Open [http://localhost:5500/](http://localhost:5500/) in your web browser, and you should be able to see the sample dashboard.
4. You should see a sample dashboard as shown below:
![Sample Web](https://raw.githubusercontent.com/netcraft-devops/payu-mea-sdk-php/master/samples/images/dashboard.png)

#### Configuration (Optional)

The demo comes pre-configured with test accounts but in case you need to try them against your account, you must
   * Update the [bootstrap.php](bootstrap.php) file with your username, password and safekey.

Also included with these demo is a [sdk_config.ini](sdk_config.ini) file. A PHP ini style configuration file. This file provide additional configuration options for this SDK.

## Alternative Options

There are two other ways you could run your samples, as shown below:

* #### Alternatives: LAMP Stack (PHP 8+ Versions)

    * You could host the entire project in your local web server, by using tools like [MAMP](http://www.mamp.info/en/) or [XAMPP](https://www.apachefriends.org/index.html).
    * Once done, you could easily open the samples by opening the matching URL. For e.g.:
`http://localhost[:port]/[sdk-directory]/samples/index.html`

* #### Alternatives: Running on console
    > Please note that there are few payment flow that require a working local server, to receive redirects from PayU Payment Page

    * To run samples itself on console, you need to open command prompt, and change to samples directory.
    * Execute the sample php script by using `php -f` command as shown below:
    ```
    php -f enterprise/payment/create-payment.php
    ```

    * The result would be as shown below:
    ![Sample Console](https://raw.githubusercontent.com/netcraft-devops/payu-mea-sdk-php/master/samples/images/console_output.png)

## More help
   * [Developers Documentation](https://payusahelp.atlassian.net/wiki/spaces/developers/overview)
   * [Reporting Issues / Feature Requests](https://github.com/PayUMEA/payu-mea-sdk-php/issues)
