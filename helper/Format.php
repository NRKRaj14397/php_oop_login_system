<?php
/**
 * Format class goes here
 */

 class Format {

    public function validation($data){
        $data = trim($data);
        $data = strip_tags($data);
        $data = htmlspecialchars($data);
        return $data;
    }
 }
?>