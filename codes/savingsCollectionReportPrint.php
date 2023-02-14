<?php

use controller\CollectionController\CollectionController\CollectionController;

include_once "../controller/CollectionController.php";
// session_start();

$collection = new CollectionController();

$officer_id = null;
if ($_POST['officer'] != 'null') {
    $officer_id = $_POST['officer'];
}
if ($_SESSION['auth']['user_role'] > 0) {
    $officer_id = $_SESSION['auth']['user_id'];
}
$period = $_POST['report'];

if (isset($_POST['from_date']) && isset($_POST['end_date'])) {
    $from_date = date("Y-m-d", strtotime($_POST['from_date']));
    $end_date = date("Y-m-d", strtotime($_POST['end_date']));
}

if (isset($_POST['savings'])) {
    $result = $collection->savingsCollecReportload($period, $officer_id);

    $output = '<thead>
                    <tr>
                        <th>#</th>
                        <th>নাম</th>
                        <th>বই নং</th>
                        <th>মন্তব্য</th>
                        <th>সঞ্চয়</th>
                        <th>অফিসার</th>
                        <th>সময়</th>
                    </tr>
                </thead>';
    if ($result != false && $result != null) {
        $total = 0;
        $output .= "<tbody>";

        foreach ($result as $key => $row) {
            $output .= '<tr>
                        <td>' . ++$key . '</td>
                        <td>' . $row['client_name'] . '</td>
                        <td>' . $row['book'] . '</td>
                        <td>' . $row['expression'] . '</td>
                        <td>' . $row['deposit'] . '/-</td>
                        <td>' . $row['officer_name'] . '</td>
                        <td>' . date("d-m-Y h:i:s A", strtotime($row['created_at_time'])) . '</td>
                    </tr>';
            $total += $row['deposit'];
        }

        $output .= '</tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-end">সর্বমোট</td>
                        <td colspan="3">৳' . $total . '/-</td>
                    </tr>
                </tfoot>';
        echo $output;
    }
} elseif (isset($_POST['loan'])) {
    $result = $collection->loanCollecReportload($period, $officer_id);
    $output = '<thead>
                        <tr>
                            <th>#</th>
                            <th>নাম</th>
                            <th>বই নং</th>
                            <th>মন্তব্য</th>
                            <th>সঞ্চয়</th>
                            <th>ঋণ</th>
                            <th>লাভ</th>
                            <th>মোট</th>
                            <th>অফিসার</th>
                            <th>সময়</th>
                        </tr>
                    </thead>';
    if ($result != false && $result != null) {
        $deposit = 0;
        $loan = 0;
        $interest = 0;
        $total = 0;
        $output .= "<tbody>";

        foreach ($result as $key => $row) {
            $output .= '<tr>
                        <td>' . ++$key . '</td>
                        <td>' . $row['client_name'] . '</td>
                        <td>' . $row['book'] . '</td>
                        <td>' . $row['expression'] . '</td>
                        <td>' . $row['deposit'] . '/-</td>
                        <td>' . $row['loan'] . '/-</td>
                        <td>' . $row['interest'] . '/-</td>
                        <td>' . $row['total'] . '/-</td>
                        <td>' . $row['officer_name'] . '</td>
                        <td>' . date("d-m-Y h:i:s A", strtotime($row['created_at_time'])) . '</td>
                    </tr>';
            $deposit += $row['deposit'];
            $loan += $row['loan'];
            $interest += $row['interest'];
            $total += $row['total'];
        }

        $output .= '</tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-end">সর্বমোট</td>
                        <td >৳' . $deposit . '/-</td>
                        <td >৳' . $loan . '/-</td>
                        <td >৳' . $interest . '/-</td>
                        <td colspan="3">৳' . $total . '/-</td>
                    </tr>
                </tfoot>';
        echo $output;
    }
} elseif (isset($_POST['tamadiSavings'])) {
    $result = $collection->savingsCollecReportload($period, $officer_id, '1', $from_date, $end_date);

    $output = '<thead>
                        <tr>
                            <th>#</th>
                            <th>নাম</th>
                            <th>বই নং</th>
                            <th>মন্তব্য</th>
                            <th>কালেকশন</th>
                            <th>অফিসার</th>
                            <th>সময়</th>
                        </tr>
                    </thead>';
    if ($result != false && $result != null) {
        $total = 0;
        $output .= "<tbody>";

        foreach ($result as $key => $row) {
            $output .= '<tr>
                        <td>' . ++$key . '</td>
                        <td>' . $row['client_name'] . '</td>
                        <td>' . $row['book'] . '</td>
                        <td>' . $row['expression'] . '</td>
                        <td>' . $row['deposit'] . '/-</td>
                        <td>' . $row['officer_name'] . '</td>
                        <td>' . date("d-m-Y h:i:s A", strtotime($row['created_at_time'])) . '</td>
                    </tr>';
            $total += $row['deposit'];
        }

        $output .= '</tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-end">সর্বমোট</td>
                        <td colspan="3">৳' . $total . '/-</td>
                    </tr>
                </tfoot>';
        echo $output;
    }
} elseif (isset($_POST['tamadiLoan'])) {
    $result = $collection->loanCollecReportload($period, $officer_id, '1', $from_date, $end_date);
    $output = '<thead>
                        <tr>
                            <th>#</th>
                            <th>নাম</th>
                            <th>বই নং</th>
                            <th>মন্তব্য</th>
                            <th>সঞ্চয়</th>
                            <th>ঋণ</th>
                            <th>লাভ</th>
                            <th>মোট</th>
                            <th>অফিসার</th>
                            <th>সময়</th>
                        </tr>
                    </thead>';
    if ($result != false && $result != null) {
        $deposit = 0;
        $loan = 0;
        $interest = 0;
        $total = 0;
        $output .= "<tbody>";

        foreach ($result as $key => $row) {
            $output .= '<tr>
                        <td>' . ++$key . '</td>
                        <td>' . $row['client_name'] . '</td>
                        <td>' . $row['book'] . '</td>
                        <td>' . $row['expression'] . '</td>
                        <td>' . $row['deposit'] . '/-</td>
                        <td>' . $row['loan'] . '/-</td>
                        <td>' . $row['interest'] . '/-</td>
                        <td>' . $row['total'] . '/-</td>
                        <td>' . $row['officer_name'] . '</td>
                        <td>' . date("d-m-Y h:i:s A", strtotime($row['created_at_time'])) . '</td>
                    </tr>';
            $deposit += $row['deposit'];
            $loan += $row['loan'];
            $interest += $row['interest'];
            $total += $row['total'];
        }

        $output .= '</tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-end">সর্বমোট</td>
                        <td >৳' . $deposit . '/-</td>
                        <td >৳' . $loan . '/-</td>
                        <td >৳' . $interest . '/-</td>
                        <td colspan="3">৳' . $total . '/-</td>
                    </tr>
                </tfoot>';
        echo $output;
    }
}
