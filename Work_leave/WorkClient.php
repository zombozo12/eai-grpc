<?php
namespace Work_leave;

use Grpc\BaseStub;

class WorkClient extends BaseStub{
    public function __construct($hostname, $opts, $channel = null)
    {
        parent::__construct($hostname, $opts, $channel);
    }

    public function EligibleForLeave(Employee $argument, $metadata = [], $options = []){
        return $this->_simpleRequest('/work_leave.EmployeeLeaveDaysService/EligibleForLeave', $argument, ['\Work_leave\LeaveEligibility', 'decode'], $metadata, $options);
    }

    public function grantLeave(Employee $argument, $metadata = [], $options = []){
        return $this->_simpleRequest('/work_leave.EmployeeLeaveDaysService/grantLeave', $argument, ['\Work_leave\LeaveFeedback', 'decode'], $metadata, $options);
    }
}