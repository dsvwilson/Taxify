<?php

class Deactivate {
    public static function deactivate() { 
        flush_rewrite_rules(); // true by default
    }
}