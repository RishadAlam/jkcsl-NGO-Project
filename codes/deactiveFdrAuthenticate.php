<?php

use controller\dataLoadController\dataLoadController\dataLoadController;
// include_once "../config/app.php";
include_once "../controller/dataLoadController.php";

$load = new dataLoadController();

if ($_SESSION['auth']['user_role'] == 0) {
    $status = '0';
    $result = $load->fdrLoad($status);
    if ($result != false && $result != null) {
        // print_r($result);
        // die();
        $i = 1;
        foreach ($result as $keys => $value) {
            $subarray = array();
            $subarray[] = $i++;
            $subarray[] = $value['name'];
            $subarray[] = date("d/m/Y", strtotime($value['start']));
            $subarray[] = date("d/m/Y", strtotime($value['expiry']));
            $subarray[] = $value['details'];
            $subarray[] = $value['deposit'];
            $subarray[] = $value['interest'];
            $subarray[] = '<span class="d-inline-block py-1 px-4 text-capitalize bg-danger rounded" style="color: #fff; font-size: 18px;">DEACTIVATE</span>';
            $subarray[] = '<div class="form-check form-switch text-center">
                                            <input class="form-check-input" name="action" type="checkbox" role="switch" id="' . $value['id'] . '">
                                            <label class="form-check-label" for="' . $value['id'] . '"></label>
                                        </div>';
            $subarray[] = '<a href="#" title="ইডিট" data-bs-toggle="modal" id="edit_load" data-id="' . $value['id'] . '" data-bs-target="#message"><span class="text-warning" style="cursor: pointer; font-size: 22px;"><i class="bx bxs-edit"></i></span></a>';
            $output[] = $subarray;
        }
        $data = array(
            // "recordsFiltered" => $rowCount,
            "data" => $output,
        );
        echo json_encode($data);
    } else {
        echo json_encode(null);
    }
} else {
    echo json_encode(null);
}
