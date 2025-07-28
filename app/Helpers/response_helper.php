<?php

//flash data thong bao
// if (!function_exists('redirect_with_message')) {
//     function redirect_with_message($response_status, $response_data, $response_url = null)
//     {
//         $response_data_array = [
//             'status' => $response_status,
//             'data'   => $response_data
//         ];

//         if ($response_url) {
//             if (strcmp($response_status, 'error')) {
//                 return redirect()->route($response_url)->with('response_message', $response_data_array);

//             } else {
//                 return redirect()->route($response_url)->with('response_message', $response_data_array);

//             }
//         }

//         if (strcmp($response_status, 'error')) {

//             return redirect()->back()->with('response_message', $response_data_array);

//         } else {

//             return redirect()->back()->with('response_message', $response_data_array);
//         }

//     }
// }



if (!function_exists('redirect_with_message')) {
    function redirect_with_message($response_status, $response_data, $response_url = null, $params = [])
    {
        // Lưu thông báo vào session
        $response_data_array = [
            'status' => $response_status,
            'data'   => $response_data
        ];

        // Nếu có URL, thực hiện redirect kèm theo thông báo
        if ($response_url) {
            return redirect()->to($response_url . '?' . http_build_query($params))->with('response_message', $response_data_array);
        }

        return redirect()->to(previous_url())->with('response_message', $response_data_array);
    }
}

if (!function_exists('redirect_with_message_url')) {
    function redirect_with_message_url($response_status, $response_data, $response_url)
    {
        $response_data_array = [
            'status' => $response_status,
            'data'   => $response_data
        ];

        if ($response_url) {
            if (strcmp($response_status, 'error')) {
                return redirect()->route($response_url)->with('response_message', $response_data_array);

            } else {
                return redirect()->route($response_url)->with('response_message', $response_data_array);

            }
        }

        if (strcmp($response_status, 'error')) {
            return redirect()->back()->with('response_message', $response_data_array);

        } else {

            return redirect()->back()->with('response_message', $response_data_array);
        }

    }
}
