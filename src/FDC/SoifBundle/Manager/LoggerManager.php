<?php

namespace FDC\SoifBundle\Manager;

use \Exception;

/**
 * LoggerManager class.
 * 
 * @extends CoreManager
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * @company Ohwee
 */
class LoggerManager extends CoreManager
{
    private $soifLog;
    private $SoifLogDirectory;
    
    /**
     * setSoifLog function.
     * 
     * @access public
     * @param mixed $soifLog
     * @return void
     */
    public function setSoifLog($soifLog)
    {
        $this->soifLog = $soifLog;
    }
    
    /**
     * setSoifLogDirectory function.
     * 
     * @access public
     * @param mixed $soifLogDirectory
     * @return void
     */
    public function setSoifLogDirectory($soifLogDirectory)
    {
        $this->soifLogDirectory = $soifLogDirectory;
    }
    
    /**
     * write function.
     * 
     * @access public
     * @param mixed $filename
     * @param mixed $content
     * @return void
     */
    public function write($filename, $content, $prettyXml = true)
    {
        if ($this->soifLog) {
            if (file_exists($this->soifLogDirectory) === false) {
                throw new Exception("soif log directory doesn't exist, you must create the folder : {$this->soifLogDirectory}");
            }

            $content = ($prettyXml) ? $this->prettyXml($content) : $content;
            if (file_put_contents($this->soifLogDirectory. $filename, $content) === false) {
                throw new Exception("soif log couldn't be written in {$this->soifLogDirectory}{$filename}");
            }
        }
    }
    
    /**
     * prettyXml function.
     * 
     * @access private
     * @param mixed $xml
     * @return void
     * @source http://www.daveperrett.com/articles/2007/04/05/format-xml-with-php/
     */
    private function prettyXml($xml)
    {
        // add marker linefeeds to aid the pretty-tokeniser (adds a linefeed between all tag-end boundaries)
        $xml = preg_replace('/(>)(<)(\/*)/', "$1\n$2$3", $xml);

        // now indent the tags
        $token      = strtok($xml, "\n");
        $result     = ''; // holds formatted version as it is built
        $pad        = 0; // initial indent
        $matches    = array(); // returns from preg_matches()
        
        // scan each line and adjust indent based on opening/closing tags
        while ($token !== false) :
        
        // test for the various tag states
        
        // 1. open and closing tags on same line - no change
        if (preg_match('/.+<\/\w[^>]*>$/', $token, $matches)) :
          $indent=0;
        // 2. closing tag - outdent now
        elseif (preg_match('/^<\/\w/', $token, $matches)) :
          $pad--;
        // 3. opening tag - don't pad this one, only subsequent tags
        elseif (preg_match('/^<\w[^>]*[^\/]>.*$/', $token, $matches)) :
          $indent=1;
        // 4. no indentation needed
        else :
          $indent = 0;
        endif;
        
        // pad the line with the required number of leading spaces
        $line    = str_pad($token, strlen($token)+$pad, ' ', STR_PAD_LEFT);
        $result .= $line . "\n"; // add to the cumulative result, with linefeed
        $token   = strtok("\n"); // get the next token
        $pad    += $indent; // update the pad size for subsequent lines
        endwhile;
        
        return $result;
    }
}