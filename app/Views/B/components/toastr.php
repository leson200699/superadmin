<?php

$response_message = session('response_message');
if (!empty($response_message)) {
    $response_status = $response_message['status'];
    $response_data   = $response_message['data'];
    if ($response_status == 'success') {
        echo "
             toastr['success']('$response_data');
             toastr.options = {
                'closeButton': false,
                'debug': false,
                'newestOnTop': false,
                'progressBar': true,
                'positionClass': 'toast-top-right',
                'preventDuplicates': false,
                'onclick': null,
                'showDuration': '300',
                'hideDuration': '1000',
                'timeOut': '5000',
                'extendedTimeOut': '1000',
                'showEasing': 'swing',
                'hideEasing': 'linear',
                'showMethod': 'fadeIn',
                'hideMethod': 'fadeOut'
            }
        ";
    }
    if ($response_status == 'error') {
        echo "
             toastr['error']('$response_data');
             toastr.options = {
                'closeButton': false,
                'debug': false,
                'newestOnTop': false,
                'progressBar': true,
                'positionClass': 'toast-top-right',
                'preventDuplicates': false,
                'onclick': null,
                'showDuration': '300',
                'hideDuration': '1000',
                'timeOut': '5000',
                'extendedTimeOut': '1000',
                'showEasing': 'swing',
                'hideEasing': 'linear',
                'showMethod': 'fadeIn',
                'hideMethod': 'fadeOut'
            }
        ";
    }

}
?>

