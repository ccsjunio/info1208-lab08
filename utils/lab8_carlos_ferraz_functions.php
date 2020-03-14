<?php
    /**
     * Functions library
     */
    function sanitizeArray($arrayInput){

        $response = array();

        if(!isset($arrayInput) || is_null($arrayInput)){
            return false;
        }

        foreach ($arrayInput as $key=>$value) {
            
            if ( is_null($key) || is_null($value) || $key==="" || $value==="" ) {
                break;
            }

            $newKey = htmlentities($key);
            $newValue = htmlentities($value);
            $response[$newKey]=$newValue;

        } // end of foreach($arrayInput as $key=>$value)

        return $response;
    } // end of public function sanitizeArray

    /**
     * Function to determine the correct undefined article for a noun
     * Returns false in case it is not a noun
     * Returns "a" or "an" depending on the noun provided
     * Works on the English Language only
     */
    function undefinedArticleTo($noun){
        // identifies if the holding name initiates with a vowel
        // in order to agree with the article
        $pattern = '/^[aeiou]/';
        return preg_match($pattern, $noun)===0 ? "a" : "an";
    }
?>