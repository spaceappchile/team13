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

    xml_parser_set_option($this->parser, XML_OPTION_SKIP_WHITE, true);
    xml_parser_set_option($this->parser, XML_OPTION_TARGET_ENCODING, 'UTF-8');
    xml_set_object($this->parser, $this);
    xml_set_element_handler($this->parser, 'startElement', 'endElement');
    xml_set_character_data_handler($this->parser, 'characterData');
  }

  public function parse()
  {
    $fp = fopen($this->filename, 'r');
    $iterations = 0;
    $max_iterations = 7;
    $line1 = '<Debug TimeStamp="2013-04-17T23:51:25.349" File="ACDImpl.cpp" Line="643" Routine="ReceiverBandMod::ReceiverBand ACDImpl::getCurrentCartrigeInternal()" Host="" Process="CONTROL/DV14/cppContainer" Thread="CONTROL/DV14/FrontEnd/ACDMonitoringThread" Context="" SourceObject="CONTROL/DV14/cppContainer-GL"><![CDATA[Problem manipulating hardware. (type=10000, code=21)]]><Data Name="Additional"><![CDATA[Could not determine the Calibrationd device position. It returned: 14]]></Data></Debug>';

    $line2 = '<Debug TimeStamp="2013-04-17T23:51:25.349" File="FrontEndUtils.cpp" Line="118" Routine="ReceiverBandMod::ReceiverBand FrontEndUtils::intToBand(int)" Host="" Process="CONTROL/DV14/cppContainer" Thread="CONTROL/DV14/FrontEnd/ACDMonitoringThread" Context="" SourceObject="CONTROL/DV14/cppContainer-GL"><![CDATA[Illegal Parameter Error (type=10000, code=2)]]><Data Name="Additional"><![CDATA[The requested band number is unrecognized]]></Data></Debug>';

    $line3 = '<Debug TimeStamp="2013-04-17T23:51:25.398" File="ACDImpl.cpp" Line="643" Routine="ReceiverBandMod::ReceiverBand ACDImpl::getCurrentCartrigeInternal()" Host="" Process="CONTROL/DV14/cppContainer" Thread="CONTROL/DV14/FrontEnd/ACDMonitoringThread" Context="" SourceObject="CONTROL/DV14/cppContainer-GL"><![CDATA[Problem manipulating hardware. (type=10000, code=21)]]><Data Name="Additional"><![CDATA[Could not determine the Calibrationd device position. It returned: 14]]></Data></Debug>
    ';

    while( $line = fgets($fp) ) {
      $line = trim($line);

      if ($iterations > 3) {
        $this->parseLine($line, $iterations);
      }  

      $iterations++;

      if ($iterations == $max_iterations) {
        break;
      }
    }
    xml_parser_free($this->parser);
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

  function parseLine( $line , $iteration = 0 )
  {
    echo htmlentities($line) . '<br />'; 
    xml_parse($this->parser, $line) or die(sprintf('XML ERROR: %s at line %d (Code : %d) - Iteration : %d',
         xml_error_string(xml_get_error_code($this->parser)),
         xml_get_current_line_number($this->parser), xml_get_error_code($this->parser), $iteration));
    echo '<hr />';
  }
}