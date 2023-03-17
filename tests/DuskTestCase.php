<?php

    namespace Tests;

    use Laravel\Dusk\Browser;
    use Laravel\Dusk\TestCase as BaseTestCase;
    use Facebook\WebDriver\Chrome\ChromeOptions;
    use Facebook\WebDriver\Remote\RemoteWebDriver;
    use Facebook\WebDriver\Remote\DesiredCapabilities;

    /**
     * Class DuskTestCase
     *
     * @package Tests
     */
    abstract class DuskTestCase extends BaseTestCase
    {
        use CreatesApplication;

        /**
         * @return void
         */
        public function setUp(): void
        {
            parent::setUp();
        }

        /**
         * Prepare for Dusk test execution.
         *
         * @beforeClass
         * @return void
         */
        public static function prepare()
        {
            static::startChromeDriver();

            Browser::macro('scrollTo', function($element) {
                $this->script("$('html, body').animate({ scrollTop: $('$element').offset().top }, 0);");
                return $this;
            });
        }

        /**
         * Create the RemoteWebDriver instance.
         *
         * @return \Facebook\WebDriver\Remote\RemoteWebDriver
         */
        protected function driver()
        {
            $options = (new ChromeOptions)->addArguments([]);

            return RemoteWebDriver::create(
                'localhost:9515',
                DesiredCapabilities::chrome()->setCapability(ChromeOptions::CAPABILITY, $options)
            );
        }
    }
