<?php

use controller\RegController\RegController\RegController;



include_once "../controller/RegController.php";
$reg = new RegController();

// Background Img
if (isset($_POST['bgImg'])) {
    $img = $_POST['bgImg'];
    $officer_id = $_SESSION['auth']['user_id'];

    $result = $reg->theme($img, $officer_id);

    if ($result != false) {
        echo $result;
    } else {
        echo true;
    }
}

// Load Settings Data
if (isset($_POST['settings']) && $_POST['settings'] == 1) {

    $result = $reg->loadSettings();

    if ($result != false) {
        echo json_encode($result);
    } else {
        echo true;
    }
}


if (isset($_POST['siteName'])) {
    // print_r($_POST);
    // print_r($_FILES);
    // die();
    $siteName = $_POST['siteName'];
    $timeStart = $_POST['timeStart'];
    $timeEnd = $_POST['timeEnd'];
    $old_logo = $_POST['old_logo'];

    if ($_FILES['logo']["name"] != '') {
        $logo = $_FILES['logo']["name"];
        $logoTmp = $_FILES['logo']['tmp_name'];
        $logoSize = $_FILES['logo']['size'];

        // Image Validation Checking
        if (!imgExtValidate($logo)) {
            echo "image_ext_error";  // RETURN AN ERROR
        } elseif (!imgSizeValidate($logoSize)) {
            echo "image_size_error";  // RETURN AN ERROR
        } else {
            if (unlink('../img/' . $old_logo)) {
                // Create image unique name
                $logo_name = uniqid("logo_") . "." . pathinfo($logo, PATHINFO_EXTENSION);

                // Image upload to the storage
                if (move_uploaded_file($logoTmp, "../img/" . $logo_name)) {
                    $result = $reg->primarySettings($siteName, $timeStart, $timeEnd, $logo_name);

                    if ($result) {
                        echo $result;
                    } else {
                        echo false;
                    }
                } else {
                    echo false;
                }
            } else {
                echo false;
            }
        }
    } else {
        $result = $reg->primarySettings($siteName, $timeStart, $timeEnd);

        if ($result) {
            echo $result;
        } else {
            echo false;
        }
    }
}

if (isset($_POST['officer']) && $_POST['officer'] == 1) {
    $query = "SELECT * FROM users WHERE role != '0' ORDER BY status DESC";
    $result = $reg->SettignElementsLoad($query);
    if ($result != false) {
        $output = '';
        // echo json_encode($result);
        foreach ($result as $keys => $row) {
            $output .= '<tr>
                            <td>' . ++$keys . '</td>
                            <td>' . $row['name'] . '</td>
                            <td><span class="d-inline-block py-1 px-4 text-capitalize ';
            if ($row['status'] == 1) {
                $output .= 'bg-success';
            } elseif ($row['status'] == 2) {
                $output .= 'bg-warning';
            } else {
                $output .= 'bg-danger';
            }
            $output .=      ' rounded" style="color: #fff; font-size: 18px;">';
            if ($row['status'] == 1) {
                $output .= 'ACTIVE';
            } elseif ($row['status'] == 2) {
                $output .= 'PANDING';
            } else {
                $output .= 'DEACTIVE';
            }
            $output .=      '</span></td>
                            <td>';
            if ($row['status'] == 1) {
                $output .=    '<div class="form-check form-switch text-center">
                                    <input class="form-check-input" name="action" type="checkbox" checked role="switch" id="' . $row['id'] . '">
                                    <label class="form-check-label" for="' . $row['id'] . '"></label>
                                </div>';
            } elseif ($row['status'] == 0) {
                $output .=    '<div class="form-check form-switch text-center">
                                    <input class="form-check-input" name="action" type="checkbox" role="switch" id="' . $row['id'] . '">
                                    <label class="form-check-label" for="' . $row['id'] . '"></label>
                                </div>';
            }
            $output .=         '</td>
                        </tr>';
        }
        echo $output;
    } else {
        echo '</tr>
                <td colspan="3">কোনো অফিসার পাওয়া যাইনি</td>
            </tr>';
    }
}

if (isset($_POST['officersID']) && isset($_POST['status'])) {
    $oficerID = $_POST['officersID'];
    $status = $_POST['status'];

    $query = "UPDATE users SET status='${status}' WHERE id = '${oficerID}'";
    $result = $reg->elementsPermission($query);
    if ($result != false) {
        echo $result;
    } else {
        echo false;
    }
}

if (isset($_POST['fields']) && $_POST['fields'] == 1) {
    $query = "SELECT * FROM feilds ORDER BY status DESC";
    $result = $reg->SettignElementsLoad($query);
    if ($result != false) {
        $output = '';
        // echo json_encode($result);
        foreach ($result as $keys => $row) {
            $output .= '<tr>
                            <td>' . ++$keys . '</td>
                            <td>' . $row['field_name'] . '</td>
                            <td>' . $row['field_dec'] . '</td>
                            <td><span class="d-inline-block py-1 px-4 text-capitalize ';
            if ($row['status'] == 1) {
                $output .= 'bg-success';
            } else {
                $output .= 'bg-danger';
            }
            $output .=      ' rounded" style="color: #fff; font-size: 18px;">';
            if ($row['status'] == 1) {
                $output .= 'ACTIVE';
            } else {
                $output .= 'DEACTIVE';
            }
            $output .=      '</span></td>
                            <td><a href="#" title="ইডিট" data-bs-toggle="modal" id="edit_load" data-id="' . $row['feild_id'] . '" data-bs-target="#message" data-type="field"><span class="text-warning" style="cursor: pointer; font-size: 22px;"><i class="bx bxs-edit"></i></span></a></td>
                            <td>';
            if ($row['status'] == 1) {
                $output .=    '<div class="form-check form-switch text-center">
                                    <input class="form-check-input" name="fieldAction" type="checkbox" checked role="switch" id="' . $row['feild_id'] . '">
                                    <label class="form-check-label" for="' . $row['feild_id'] . '"></label>
                                </div>';
            } else {
                $output .=    '<div class="form-check form-switch text-center">
                                    <input class="form-check-input" name="fieldAction" type="checkbox" role="switch" id="' . $row['feild_id'] . '">
                                    <label class="form-check-label" for="' . $row['feild_id'] . '"></label>
                                </div>';
            }
            $output .=         '</td>
                        </tr>';
        }
        echo $output;
    } else {
        echo '</tr>
                <td colspan="3">কোনো ফিল্ড পাওয়া যাইনি</td>
            </tr>';
    }
}

if (isset($_POST['fieldID']) && isset($_POST['status'])) {
    $fieldID = $_POST['fieldID'];
    $status = $_POST['status'];

    $query = "UPDATE feilds SET status ='${status}' WHERE feild_id = '${fieldID}'";
    $result = $reg->elementsPermission($query);
    if ($result != false) {
        echo $result;
    } else {
        echo false;
    }
}

if (isset($_POST['center']) && $_POST['center'] == 1) {
    $query = "SELECT * FROM centers ORDER BY status DESC";
    $result = $reg->SettignElementsLoad($query);
    if ($result != false) {
        $output = '';
        // echo json_encode($result);
        foreach ($result as $keys => $row) {
            $output .= '<tr>
                            <td>' . ++$keys . '</td>
                            <td>' . $row['center_name'] . '</td>
                            <td>' . $row['center_dec'] . '</td>
                            <td><span class="d-inline-block py-1 px-4 text-capitalize ';
            if ($row['status'] == 1) {
                $output .= 'bg-success';
            } else {
                $output .= 'bg-danger';
            }
            $output .=      ' rounded" style="color: #fff; font-size: 18px;">';
            if ($row['status'] == 1) {
                $output .= 'ACTIVE';
            } else {
                $output .= 'DEACTIVE';
            }
            $output .=      '</span></td>
                            <td><a href="#" title="ইডিট" data-bs-toggle="modal" id="edit_load" data-id="' . $row['center_id'] . '" data-bs-target="#message" data-type="center"><span class="text-warning" style="cursor: pointer; font-size: 22px;"><i class="bx bxs-edit"></i></span></a></td>
                            <td>';
            if ($row['status'] == 1) {
                $output .=    '<div class="form-check form-switch text-center">
                                    <input class="form-check-input" name="centerAction" type="checkbox" checked role="switch" id="' . $row['center_id'] . '">
                                    <label class="form-check-label" for="' . $row['center_id'] . '"></label>
                                </div>';
            } else {
                $output .=    '<div class="form-check form-switch text-center">
                                    <input class="form-check-input" name="centerAction" type="checkbox" role="switch" id="' . $row['center_id'] . '">
                                    <label class="form-check-label" for="' . $row['center_id'] . '"></label>
                                </div>';
            }
            $output .=         '</td>
                        </tr>';
        }
        echo $output;
    } else {
        echo '</tr>
                <td colspan="3">কোনো কেন্দ্র পাওয়া যাইনি</td>
            </tr>';
    }
}

if (isset($_POST['centerID']) && isset($_POST['status'])) {
    $centerID = $_POST['centerID'];
    $status = $_POST['status'];

    $query = "UPDATE centers SET status ='${status}' WHERE center_id = '${centerID}'";
    $result = $reg->elementsPermission($query);
    if ($result != false) {
        echo $result;
    } else {
        echo false;
    }
}

if (isset($_POST['period']) && $_POST['period'] == 1) {
    $query = "SELECT * FROM periods ORDER BY status DESC, period";
    $result = $reg->SettignElementsLoad($query);
    if ($result != false) {
        $output = '';
        // echo json_encode($result);
        foreach ($result as $keys => $row) {
            $output .= '<tr>
                            <td>' . ++$keys . '</td>
                            <td>' . $row['period_name'] . '</td>';
            $output .=      '<td>' . $row['period_details'] . '</td>
                            <td>';
            if ($row['period'] == 1) {
                $output .= 'দৈনিক';
            } elseif ($row['period'] == 7) {
                $output .= 'সাপ্তাহিক';
            } elseif ($row['period'] == 30) {
                $output .= 'মাসিক';
            } elseif ($row['period'] == 365) {
                $output .= 'বাৎসরিক';
            }
            $output .=      '</td><td>';
            if ($row['period_type'] == 1) {
                $output .= 'সঞ্চয়';
            } elseif ($row['period_type'] == 2) {
                $output .= 'ঋণ';
            } else {
                $output .= 'সঞ্চয়/ঋণ';
            }

            $output .=      '</td>
                            <td><span class="d-inline-block py-1 px-4 text-capitalize ';
            if ($row['status'] == 1) {
                $output .= 'bg-success';
            } else {
                $output .= 'bg-danger';
            }
            $output .=      ' rounded" style="color: #fff; font-size: 18px;">';
            if ($row['status'] == 1) {
                $output .= 'ACTIVE';
            } else {
                $output .= 'DEACTIVE';
            }
            $output .=      '</span></td>
                            <td><a href="#" title="ইডিট" data-bs-toggle="modal" id="edit_load" data-id="' . $row['period_id'] . '" data-bs-target="#message" data-type="period"><span class="text-warning" style="cursor: pointer; font-size: 22px;"><i class="bx bxs-edit"></i></span></a></td>
                            <td>';
            if ($row['status'] == 1) {
                $output .=    '<div class="form-check form-switch text-center">
                                    <input class="form-check-input" name="periodAction" type="checkbox" checked role="switch" id="' . $row['period_id'] . '">
                                    <label class="form-check-label" for="' . $row['period_id'] . '"></label>
                                </div>';
            } else {
                $output .=    '<div class="form-check form-switch text-center">
                                    <input class="form-check-input" name="periodAction" type="checkbox" role="switch" id="' . $row['period_id'] . '">
                                    <label class="form-check-label" for="' . $row['period_id'] . '"></label>
                                </div>';
            }
            $output .=         '</td>
                        </tr>';
        }
        echo $output;
    } else {
        echo '</tr>
                <td colspan="3">কোনো ক্ষেত্র পাওয়া যাইনি</td>
            </tr>';
    }
}

if (isset($_POST['periodID']) && isset($_POST['status'])) {
    $periodID = $_POST['periodID'];
    $status = $_POST['status'];

    $query = "UPDATE periods SET status ='${status}' WHERE period_id = '${periodID}'";
    $result = $reg->elementsPermission($query);
    if ($result != false) {
        echo $result;
    } else {
        echo false;
    }
}

if (isset($_POST['settingsEdit']) && $_POST['settingsEdit'] == 1 && isset($_POST['settingType']) && isset($_POST['id'])) {
    $id = $_POST['id'];
    $type = $_POST['settingType'];

    if ($type == "field") {
        $query = "SELECT * FROM feilds WHERE feild_id = '${id}'";
        $result = $reg->SettignElementsLoad($query);
        if ($result != false) {
            $output = '';
            // echo json_encode($result);
            foreach ($result as $keys => $row) {
                $output .= '<div class="col-md-12 mb-3">
                            <label for="name" class="pb-2">নাম <span class="text-danger">*</span></label>
                            <input type="hidden" id="type" value="field">
                            <input type="hidden" id="id" value="' . $row['feild_id'] . '">
                            <input type="text" style="text-indent: 0;" class="form-control form-input p-3 input_field" id="name" name="name" value="' . $row['field_name'] . '">
                            <div id="name-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                ফিল্ডের নাম লিখুন
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="details" class="pb-2">বিস্তারিত</label>
                            <textarea class="form-control p-3 input_field" id="details" name="dec" rows="3">' . $row['field_dec'] . '</textarea>
                            <div id="dec-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                ফিল্ড সম্পর্কে বিস্তারিত লিখুন
                            </div>
                        </div>';
            }
            echo $output;
        } else {
            echo '</tr>
                <td colspan="3">কোনো ক্ষেত্র পাওয়া যাইনি</td>
            </tr>';
        }
    } elseif ($type == "center") {
        $query = "SELECT * FROM centers WHERE center_id = '${id}'";
        $result = $reg->SettignElementsLoad($query);
        if ($result != false) {
            $output = '';
            // echo json_encode($result);
            foreach ($result as $keys => $row) {
                $output .= '<div class="col-md-12 mb-3">
                            <label for="name" class="pb-2">নাম <span class="text-danger">*</span></label>
                            <input type="hidden" id="type" value="center">
                            <input type="hidden" id="id" value="' . $row['center_id'] . '">
                            <input type="text" style="text-indent: 0;" class="form-control form-input p-3 input_field" id="name" name="name" value="' . $row['center_name'] . '">
                            <div id="name-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                ফিল্ডের নাম লিখুন
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="details" class="pb-2">বিস্তারিত</label>
                            <textarea class="form-control p-3 input_field" id="details" name="dec" rows="3">' . $row['center_dec'] . '</textarea>
                            <div id="dec-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                ফিল্ড সম্পর্কে বিস্তারিত লিখুন
                            </div>
                        </div>';
            }
            echo $output;
        } else {
            echo '</tr>
                <td colspan="3">কোনো ক্ষেত্র পাওয়া যাইনি</td>
            </tr>';
        }
    } elseif ($type == "period") {
        $query = "SELECT * FROM periods WHERE period_id = '${id}'";
        $result = $reg->SettignElementsLoad($query);
        if ($result != false) {
            $output = '';
            // echo json_encode($result);
            foreach ($result as $keys => $row) {
                $output .= '<div class="col-md-12 mb-3">
                            <label for="name" class="pb-2">নাম <span class="text-danger">*</span></label>
                            <input type="hidden" id="type" value="period">
                            <input type="hidden" id="id" value="' . $row['period_id'] . '">
                            <input type="text" style="text-indent: 0;" class="form-control form-input p-3 input_field" id="name" name="name" value="' . $row['period_name'] . '">
                            <div id="name-feedback" class="invalid-feedback" style="display: none; font-size: 18px;">
                                ফিল্ডের নাম লিখুন
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="details" class="pb-2">বিস্তারিত</label>
                            <textarea class="form-control p-3 input_field" id="details" name="dec" rows="3">' . $row['period_details'] . '</textarea>
                        </div>';
            }
            echo $output;
        } else {
            echo '</tr>
                <td colspan="3">কোনো ক্ষেত্র পাওয়া যাইনি</td>
            </tr>';
        }
    }
}

if (isset($_POST['type']) && isset($_POST['id']) && isset($_POST['name']) && isset($_POST['dec'])) {
    $type = $_POST['type'];
    $id = $_POST['id'];
    $name = $_POST['name'];
    $dec = $_POST['dec'];

    if ($type == "field") {
        $query = "UPDATE feilds SET field_name  ='${name}', field_dec  ='${dec}' WHERE feild_id = '${id}'";
    } elseif ($type == "center") {
        $query = "UPDATE centers SET center_name  ='${name}', center_dec  ='${dec}' WHERE center_id = '${id}'";
    } elseif ($type == "period") {
        $query = "UPDATE periods SET period_name  ='${name}', period_details  ='${dec}' WHERE period_id = '${id}'";
    }

    $result = $reg->elementsPermission($query);
    if ($result != false) {
        echo $result;
    } else {
        echo false;
    }
}
