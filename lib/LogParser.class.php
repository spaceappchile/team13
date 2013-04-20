<?php
/**
 * LogParser
 * 
 * @author alvaroveliz
 */

class LogParser
{
  private $filename;
  private $data;

  public function __construct($filename)
  {
    $this->filename = $filename;
    $this->parser = xml_parser_create('UTF-8');

    xml_parser_set_option($this->parser, XML_OPTION_SKIP_WHITE, 1);
    xml_parser_set_option($this->parser, XML_OPTION_TARGET_ENCODING, 'UTF-8');
    xml_set_object($this->parser, $this);
    xml_set_element_handler($this->parser, 'startElement', 'endElement');
    xml_set_character_data_handler($this->parser, 'characterData');
  }

  public function parse()
  {
    $fp = fopen($this->filename, 'r');
    $iterations = 0;
    $max_iterations = 4;
    while( $line = fgets($fp) ) {
      $iterations++;

      if ($iterations > 3) {
        echo htmlentities($line) . '<br />'; 
        xml_parse($this->parser, $line) or die(sprintf('XML ERROR: %s at line %d',
             xml_error_string(xml_get_error_code($this->parser)),
             xml_get_current_line_number($this->parser)));

        xml_parser_free($this->parser);
      }

      if ($iterations == $max_iterations) {
        break;
      }
    }
    fclose($fp);
  }

  public function startElement($parser, $element_name, $element_attrs)
  {
    echo 'START: '.$element_name.'<br />';
    echo '<pre>';
    echo 'START ATTRS: ';
    print_r($element_attrs);
    echo 'END ATTRS: ';
    echo '</pre>';
  }

  public function endElement($parser, $element_name)
  {
    echo 'END: ' .$element_name.'<br />';
  }

  public function characterData($parser, $data)
  {
    echo 'DATA: '.$data.'<br />';
  }

  function parseLine( $fp, $delim )
  {
    $result = "";
    while( !feof( $fp ) )
    {
        $tmp = fgetc( $fp );
        if( $tmp == $delim )
            return $result;
        $result .= $tmp;
    }
    return $result;
  }
}