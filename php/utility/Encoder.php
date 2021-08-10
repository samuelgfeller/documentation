<?php

/**
* UTF-8 encoder
*
* During the database migration between BrokerStar and Amtangee non-ascii chars like `ü` or `ä` were 
* displayed as `"�"` when taking out of the database.   
*
* The following class converts any text in UTF-8 and it seemed to work for my usecase pretty well.
*/
class Encoder
{
    /**
     * When retrieving the data from the amtangee database, letters with accents are shows as "�"
     * This function loops through a result set and calls the function arrayToUTF8 which encodes everything to utf8
     *
     * @param array $dataSet
     * @return array
     */
    public function resultSetToUTF8(array $dataSet): array
    {
        $encoded = [];
        foreach ($dataSet as $key => $data) {
            $encoded[$key] = $this->arrayToUTF8($data);
        }
        return $encoded;
    }

    /**
     * Encode array values to utf 8
     *
     * @param array $array
     * @return array
     */
    public function arrayToUTF8(array $array): array
    {
        $encoded = [];
        foreach ($array as $key => $data) {
            // If a string is already utf8, utf8_encode messes it up. Zürich becomes ZÃ¼rich
            if (is_string($data) === true && mb_detect_encoding($data) !== 'UTF-8') {
                // utf8 _encode makes an empty string out of null values which can't be compared like if($val === '')
                $encoded[$key] = utf8_encode($data);
            }else{
                $encoded[$key] = $data; // not encode, raw data
            }
        }
        return $encoded;
    }
}
