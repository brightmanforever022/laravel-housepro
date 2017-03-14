<?php
return array(
    'client_id' => 'AQQLZn7gObnHlr3CzMeC29ILZfId6O0hcURrO7Mln8fyrWsi241VtrOkPXIcnqF1VgQ7OJFBFc0-LoEP',
    'secret' => 'EAtjR6zB20tZS1gAfpmMYE_TWn6pS4nrUHyW7JhpjKEOkXd8v9MBEwGP_X0uWB70mtQT5JpyLAoCxp-y',

    /**
     * SDK configuration 
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',

        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,

        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,

        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',

        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ),
);