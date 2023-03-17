<?php

    namespace App\Helpers;

    use InvalidArgumentException;

    class LiqPay
    {
        const CURRENCY_EUR = 'EUR';
        const CURRENCY_USD = 'USD';
        const CURRENCY_UAH = 'UAH';
        const CURRENCY_RUB = 'RUB';
        const CURRENCY_RUR = 'RUR';

        protected $_supportedCurrencies = [
            self::CURRENCY_EUR,
            self::CURRENCY_USD,
            self::CURRENCY_UAH,
            self::CURRENCY_RUB,
            self::CURRENCY_RUR,
        ];

        private $_api_url = 'https://www.liqpay.ua/api/';

        private $_checkout_url = 'https://www.liqpay.ua/api/3/checkout';

        private $_public_key;

        private $_private_key;

        private $_server_response_code = null;

        public function __construct($public_key, $private_key)
        {
            if (empty($public_key)) {
                throw new InvalidArgumentException('public_key is empty');
            }

            if (empty($private_key)) {
                throw new InvalidArgumentException('private_key is empty');
            }

            $this->_public_key  = $public_key;
            $this->_private_key = $private_key;
        }

        public function api($path, $params = [], $timeout = 5)
        {
            if (! isset($params['version'])) {
                throw new InvalidArgumentException('version is null');
            }

            $url         = $this->_api_url . $path;
            $public_key  = $this->_public_key;
            $private_key = $this->_private_key;
            $data        = $this->encode_params(array_merge(compact('public_key'), $params));
            $signature   = $this->str_to_sign($private_key . $data . $private_key);
            $postfields  = http_build_query(['data' => $data, 'signature' => $signature]);

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $server_output               = curl_exec($ch);
            $this->_server_response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            curl_close($ch);

            return json_decode($server_output);
        }

        public function get_response_code()
        {
            return $this->_server_response_code;
        }

        public function cnb_form($params)
        {
            $language = 'ru';
            if (isset($params['language']) && $params['language'] === 'en') {
                $language = 'en';
            }

            $params    = $this->cnb_params($params);
            $data      = $this->encode_params($params);
            $signature = $this->cnb_signature($params);

            return sprintf(
                '<form method="POST" action="%s" accept-charset="utf-8">
                            %s
                            %s
                            <input type="image" src="//static.liqpay.ua/buttons/p1%s.radius.png" name="btn_text" />
                        </form>',
                $this->_checkout_url,
                sprintf('<input type="hidden" name="%s" value="%s" />', 'data', $data),
                sprintf('<input type="hidden" name="%s" value="%s" />', 'signature', $signature),
                $language
            );
        }

        public function viewData($params)
        {
            $language = 'ru';
            if (isset($params['language']) && $params['language'] === 'en') {
                $language = 'en';
            }
            \Log::error('liqpay_params!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!', $params);
            $params    = $this->cnb_params($params);
            $data      = $this->encode_params($params);
            $signature = $this->cnb_signature($params);

            return compact('data', 'signature', 'language');
        }

        public function cnb_signature($params)
        {
            $params      = $this->cnb_params($params);
            $private_key = $this->_private_key;
            $json        = $this->encode_params($params);
            $signature   = $this->str_to_sign($private_key . $json . $private_key);

            return $signature;
        }

        private function cnb_params($params)
        {
            $params['public_key'] = $this->_public_key;

            if (! isset($params['version'])) {
                throw new InvalidArgumentException('version is null');
            }

            if (! isset($params['amount'])) {
                throw new InvalidArgumentException('amount is null');
            }

            if (! isset($params['currency'])) {
                throw new InvalidArgumentException('currency is null');
            }

            if (! in_array($params['currency'], $this->_supportedCurrencies)) {
                throw new InvalidArgumentException('currency is not supported');
            }

            if ($params['currency'] === self::CURRENCY_RUR) {
                $params['currency'] = self::CURRENCY_RUB;
            }

            if (! isset($params['description'])) {
                throw new InvalidArgumentException('description is null');
            }

            return $params;
        }

        private function encode_params($params)
        {
            return base64_encode(json_encode($params));
        }

        public function decode_params($params)
        {
            return json_decode(base64_decode($params), true);
        }

        public function str_to_sign($str)
        {
            return base64_encode(sha1($str, 1));
        }
    }
