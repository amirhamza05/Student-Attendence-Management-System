<?php

class Lib
{
    public function alert($msg = "")
    {
        echo "<script>alert('{$msg}');</script>";
    }

    public function redirect($location = "", $msg = "")
    {
        if ($msg != "") {
            $this->alert($msg);
        }

        echo "<script>window.location.replace('{$location}')</script>";
    }

    public function back()
    {
        echo "<script> history.back() </script>";
    }

    public function apiBack($response = [], $area = "")
    {
        $response['time_out'] = time();
        if($area != ""){
            $response['area'] = $area;
        }
        if (isset($_SESSION['form_response'])) {
            unset($_SESSION['form_response']);
        }

        $_SESSION['form_response'] = $response;
        $this->back();
    }

    public function formResponse($area = "")
    {
        if (!isset($_SESSION['form_response'])) {
            return;
        }



        $data = $_SESSION['form_response'];
        if (isset($data['time_out'])) {
            $now = time();
            if (($now - $data['time_out']) >= 5) {
                unset($_SESSION['form_response']);
                return;
            }
        }

        if(isset($data['area']) && $data['area'] != $area)return;


        $label = "danger";
        if (isset($data['error'])) {
            if ($data['error'] == 0) {
                $label = "success";
            }

        }
        $msg = isset($data['error_msg']) ? $data['error_msg'] : "";

        echo "
			<div class='alert alert-{$label}' role='alert'>
  				$msg
			</div>
		";

        unset($_SESSION['form_response']);

    }

    public function createRandomPassword($len = 16){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $randomString = "";
        for ($i = 0; $i < $len; $i++) { 
            $index = rand(0, strlen($characters) - 1); 
            $randomString .= $characters[$index]; 
        }
        return $randomString;
    }

}

function lib()
{
    return new Lib();
}
