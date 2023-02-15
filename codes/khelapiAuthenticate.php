<?php

use controller\ProfileSTMUpdate\ProfileSTMController;

include_once "../controller/ProfileSTMUpdateController.php";
$fields = new ProfileSTMController();

// Savings Field Report Load
if (isset($_POST['fieldReport']) && $_POST['fieldReport'] == 1) {
    $result = $fields->savingskhelapiReport();
    $output = "";

    if ($result != false) {
        $savings = [];
        foreach ($result as $keys => $row) {
            $output .= '<tr>
                            <td>' . ++$keys . '</td>
                            <td>' . $row['period_name'] . '</td>
                            <td>' . $row['total'] . '</td>
                            <td><a href="' . baseUrl('khelapi-saving-report') . '?report=' . $row['period_id'] . '&&days=' . $row['period_days'] . '"><span class="text-warning" style="cursor: pointer; font-size: 36px;"><i class="bx bxs-folder-open"></i></span></a></td>
                        </tr>';
            $savings[] = $row['total'];
        }
        $output .= '<tr>
                            <td colspan="2" class="text-end border-top">সর্বমোট</td>
                            <td colspan="2" class="border-top">' . array_sum($savings) . '</td>
                        </tr>';
        echo $output;
    } else {
        $output .= '<tr>
                            <td colspan="4" class="text-center">কোনো বই পাওয়া যাইনি</td>
                        </tr>';
        $output .= '<tr>
                            <td colspan="2" class="text-end border-top">সর্বমোট</td>
                            <td colspan="2" class="border-top">0</td>
                        </tr>';
        echo $output;
    }
}

// Loan Field Report Load
if (isset($_POST['fieldReport']) && $_POST['fieldReport'] == 2) {
    $result = $fields->loanskhelapiReport();
    $output = "";

    if ($result != false) {
        $savings = [];
        foreach ($result as $keys => $row) {
            $output .= '<tr>
                            <td>' . ++$keys . '</td>
                            <td>' . $row['period_name'] . '</td>
                            <td>' . $row['total'] . '</td>
                            <td><a href="' . baseUrl('khelapi-loan-report') . '?report=' . $row['period_id'] . '&&days=' . $row['period_days'] . '"><span class="text-warning" style="cursor: pointer; font-size: 36px;"><i class="bx bxs-folder-open"></i></span></a></td>
                        </tr>';
            $savings[] = $row['total'];
        }
        $output .= '<tr>
                            <td colspan="2" class="text-end border-top">সর্বমোট</td>
                            <td colspan="2" class="border-top">' . array_sum($savings) . '</td>
                        </tr>';
        echo $output;
    } else {
        $output .= '<tr>
                            <td colspan="4" class="text-center">কোনো বই পাওয়া যাইনি</td>
                        </tr>';
        $output .= '<tr>
                            <td colspan="2" class="text-end border-top">সর্বমোট</td>
                            <td colspan="2" class="border-top">0</td>
                        </tr>';
        echo $output;
    }
}
