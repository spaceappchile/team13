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
    while (!feof($fp)) {
      $this->data .= fread($fp, 1024);
    }
    fclose($fp);

    xml_parse($this->parser, $this->data) or die(sprintf('XML ERROR: %s at line %d',
             xml_error_string(xml_get_error_code($this->parser)),
             xml_get_current_line_number($this->parser)));

    xml_parser_free($this->parser);
  }

  public function startElement($parser, $element_name, $element_attrs)
  {

  }

  public function endElement($parser, $element_name)
  {

  }

  public function characterData($parser, $data)
  {

  }
}