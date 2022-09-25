<?php

class Activate {
    public static function activate() {
        $this->custom_post_type(); // calling the Taxes custom post type here in case it failed initially    
        flush_rewrite_rules(); // true by default
    }
}