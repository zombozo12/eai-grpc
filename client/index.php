<?php
require 'vendor/autoload.php';

$client = new \Work_leave\WorkClient('127.0.0.1:50050', [
    'credentials' => \Grpc\ChannelCredentials::createInsecure()
]);

$valid_employee = new \Work_leave\Employee();
$valid_employee->setEmployeeId(1);
$valid_employee->setName('Wiguna R');
$valid_employee->setAccruedLeaveDays(10);
$valid_employee->setRequestedLeaveDays(4);

$get = $client->EligibleForLeave($valid_employee)->wait();
list($response, $array) = $get;

$getEligible = $response->getEligible();

if($getEligible){
    $grantLeave = $client->grantLeave($valid_employee)->wait();
    list($response, $array) = $grantLeave;
    $arrResponse = array();
    array_push($arrResponse, [
        "eligible" => $response->getGranted(),
        "accrued_leave_days" => $response->getAccruedLeaveDays(),
        "granted_leave_days" => $response->getGrantedLeaveDays()
    ]);
    print_r($arrResponse);
}else{
    echo "You are currently ineligible for leave days";
}