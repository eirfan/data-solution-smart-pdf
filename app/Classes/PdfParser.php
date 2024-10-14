<?php 

namespace App\Classes;

use Smalot\PdfParser\Parser;
class PdfParser {

    protected $parser;

    public function __construct() {
        $this->parser = new Parser();
    }
    public function parseContent($file) {
        $content = $this->parser->parseFile($file);
        if(!isset($content)) {
            return false;
        }
        return $content;
    }
}