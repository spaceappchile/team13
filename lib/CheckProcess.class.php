<?php

require_once 'MySQL.php';

/**
 * Description of CheckProcess
 *
 * @author rmorenp
 */
class CheckProcess {
    /*
    private $arrayHappyProcess = array(
            '1' => 'component CONTROL/Array001 activated and initialized in %d ms.',
            '2' => '%s observing mode starting.',
            '3' => "client '%s' attempts to retrieve component '%s' more than once; will return existing reference",
            '4' => 'Defining, in the correlator, an array called %s with antennas [%s]',
            '5' => 'Tuning BB_1 to %s BB_2 to %s BB_3 to %s BB_4 to %s (%s)',
            '6' => 'Starting scan number %d on array %s with scan intent CALIBRATE_POINTING using CHANNEL_AVERAGE_CROSS.',
            '7' => 'Subscan %s has an intent of ON_SOURCE, takes %f seconds & starts at %s',
            '8' => '%s observing mode shutting down',
            '9' => 'The %s has been archived',
            '10' => "client '%s' has successfully released a component with curl=%s",
    );
    */
    private $arrayHappyProcess = array(
        '1' => ' activated and initialized in',
        '2' => 'observing mode starting.',
        '3' => "attempts to retrieve component",
        '4' => 'Defining, in the correlator, an array called ',
        '5' => 'Tuning BB_1 to ',
        '6' => 'with scan intent CALIBRATE_POINTING using CHANNEL_AVERAGE_CROSS.',
        '7' => ' has an intent of ON_SOURCE, takes ',
        '8' => 'observing mode shutting down',
        '9' => ' has been archived',
        '10' => "has successfully released a component with curl=CONTROL",
        
    );
    
    private $arrayStatus = array();

    public function validateProcess($logRegister) {
        $step = $this->searchStep('CONTROL/Array003');
        $isStep = preg_match('|'.$this->arrayHappyProcess[$step+1].'|', $logRegister);
        if($isStep)
        {
            $this->setStep('CONTROL/Array003');
        }
        return $isStep;
    }
    
    public function searchStep($arrayQuest){
        if(isset($this->arrayStatus[$arrayQuest]))
        {
            return $this->arrayStatus[$arrayQuest];
        }
        return $this->setStep($arrayQuest);
    }
    
    public function setStep($arrayQuest){
        if(isset($this->arrayStatus[$arrayQuest]))
        {
            $this->arrayStatus[$arrayQuest] = $this->arrayStatus[$arrayQuest]+1;
            if($this->arrayStatus[$arrayQuest]>= count($this->arrayHappyProcess))
            {
                $this->arrayStatus[$arrayQuest] = 0;
            }
        }
        else 
        {
            $this->arrayStatus[$arrayQuest] = 0;
        }
        return $this->arrayStatus[$arrayQuest];
    }

}