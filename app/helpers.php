<?php


if (! function_exists('redir')){
    function redir($uri, $status = '302', $headers = []){
        return new \Zend\Diactoros\Response\RedirectResponse($uri , $status, $headers);
    }
}
if (! function_exists('is_ajax')){
    function is_ajax(){
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) == 'XMLHttpRequest';
    }
}

if (! function_exists('error')){
    function error(?array $parameters = []){
        http_response_code(400);
        echo json_encode($parameters);
        exit();
    }
}
if (! function_exists('success')){
    function success(?array $parameters = []){
        http_response_code(200);
        echo json_encode($parameters);
        exit();
    }
}

if (! function_exists('redirect')){
    function redirect($uri, $data = []){

        if (isset($data) AND is_array($data)){
            $datas = implode('', $data);
            header("Location:{$uri}{$datas}");
            exit();
        }else{
            header("Location:{$uri}");
            exit();
        }

    }
}
