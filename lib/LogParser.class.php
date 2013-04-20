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

  private $onDebug = FALSE;
  private $onData = FALSE;


  public function __construct($filename)
  {
    $this->filename = $filename;
    $this->data = array();
  }

  public function parse()
  {
    $fp = fopen($this->filename, 'r');
    $iterations = 0;
    $max_iterations = 2000;
    $previousLine = '';

    while( $line = fgets($fp) ) 
    {
      $line = trim($line);

      if ($iterations > 3) {

        if ( preg_match('/(.+)>$/i', $line)) {
          $this->parser = xml_parser_create('UTF-8');

          xml_parser_set_option($this->parser, XML_OPTION_SKIP_WHITE, true);
          xml_parser_set_option($this->parser, XML_OPTION_TARGET_ENCODING, 'UTF-8');
          xml_set_object($this->parser, $this);
          xml_set_element_handler($this->parser, 'startElement', 'endElement');
          xml_set_character_data_handler($this->parser, 'characterData');

          $line = $previousLine . $line;
          $this->parseLine($line, $iterations);

          xml_parser_free($this->parser);
          $this->parser = NULL; 
          $previousLine = '';
        }
        else {
          $previousLine .= $line;
        }
      }  

      $iterations++;

      if ($iterations == $max_iterations) {
        break;
      }
    }
    fclose($fp);
  }

  public function startElement($parser, $element_name, $element_attrs)
  {
    if ($element_name == 'DEBUG') {
      $this->onDebug = TRUE;
    }
  }

  public function endElement($parser, $element_name)
  {
    if ($element_name == 'DEBUG') {
      $this->onDebug = FALSE;
    }
  }

  public function characterData($parser, $data)
  {
    if ($this->onDebug) {
      echo 'DEBUG DATA: '.$data.'<br />';
      array_push($this->data, $data);
    }
    // if (!in_array($data, $this->data)) {
    //   array_push($this->data, $data);
    // }
  }

  public function parseLine( $line , $iteration = 0 )
  {
    xml_parse($this->parser, $line) or die(sprintf('XML ERROR: %s at line %d column %d byte %d (Code : %d) - Iteration : %d<br />Line : %s',
         xml_error_string(xml_get_error_code($this->parser)),
         xml_get_current_line_number($this->parser), xml_get_current_column_number($this->parser), xml_get_current_byte_index($this->parser), xml_get_error_code($this->parser), $iteration, htmlentities($line)));
    // echo '<hr />';
  }

  public function getData()
  {
    return $this->data;
  }
}