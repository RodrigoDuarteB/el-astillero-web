<?php
    namespace App\Libs\Tools;

    class StringTool {

        /**
         * @param the sentence to be capitalized
         * @return the sentence with all words capitalized
         */
        public static function capitalizeEachWord(string $string): string {
            if(!is_string($string)){
                throw new \Exception('Argument value is not string');
            }
            return ucwords(strtolower($string));
        }

    }

