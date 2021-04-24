<?php
    namespace libs;

    class StringTool {

        /**
         * @param the sentence to be capitalized
         * @return the sentence with all words capitalized
         */
        public static function capitalizeAll(string $string): string {
            if(!is_string($string)){
                throw new \Exception('Argument value is not String');
            }
            return ucwords(strtolower($string));
        }

    }
    class IntegerTool {

    }
?>
