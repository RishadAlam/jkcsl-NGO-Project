<?php

use controller\FieldDataController\FieldDataController\FieldDataController;

include_once "../controller/FieldDataController.php";
$fields = new FieldDataController();

if (isset($_POST['savings']) && $_POST['savings'] == 1) {
    $result = $fields->savingsAuditLoad();

    if ($result != false) {
        $output = '<thead>
                        <th>#</th>
                        <th>ক্ষেত্র</th>
                        <th>টাকা</th>
                    </thead>
                    <tbody>';
        $totalSavings = array();
        foreach ($result as $keys => $row) {
            $output .= '<tr>
                            <td>' . ++$keys . '</td>
                            <td>' . $row['period_name'] . '</td>
                            <td>৳' . $row['total'] . '/-</td>
                        </tr>';
            $totalSavings[] = $row['total'];
        }
        $output .= '</tbody>
                    <tfoot>
                        <tr  style="font-weight: bolder;">
                            <td></td>
                            <td style="font-size: 22px;">সর্বমোট</td>
                            <td style="font-size: 22px;" id="totalSavings">৳' . array_sum($totalSavings) . '/-</td>
                        </tr>
                    </tfoot>';
        echo $output;
    } else {
        echo false;
    }
}

if (isset($_POST['loanSavings']) && $_POST['loanSavings'] == 1) {
    $result = $fields->loanSavingsAuditLoad();

    if ($result != false) {
        $output = '<thead>
                        <th>#</th>
                        <th>ক্ষেত্র</th>
                        <th>টাকা</th>
                    </thead>
                    <tbody>';
        $totalLoanSavings = array();
        foreach ($result as $keys => $row) {
            $output .= '<tr>
                            <td>' . ++$keys . '</td>
                            <td>' . $row['period_name'] . '</td>
                            <td>৳' . $row['total'] . '/-</td>
                        </tr>';
            $totalLoanSavings[] = $row['total'];
        }
        $output .= '</tbody>
                    <tfoot>
                        <tr  style="font-weight: bolder;">
                            <td></td>
                            <td style="font-size: 22px;">সর্বমোট</td>
                            <td style="font-size: 22px;">৳' . array_sum($totalLoanSavings) . '/-</td>
                        </tr>
                    </tfoot>';
        echo $output;
        // print_r($result);
    } else {
        echo false;
    }
}

if (isset($_POST['loans']) && $_POST['loans'] == 1) {
    $result = $fields->loansAuditLoad();

    if ($result != false) {
        $output = '<thead>
                                <th>#</th>
                                <th>ক্ষেত্র</th>
                                <th>ঋণ প্রদান</th>
                                <th>ঋণ আদায়</th>
                                <th>ঋণ বাকি</th>
                                <th>সর্বমোট ঋণ</th>
                                <th>মোট লাভ</th>
                                <th>লাভ আদায়</th>
                                <th>লাভ বাকি</th>
                                <th>সর্বমোট লাভ</th>
                            </thead><tbody>';
        $totalLoan = [];
        $totalLoanRec = [];
        $totalLoanRem = [];
        $Loantotal = [];
        $totalInterest = [];
        $totalInterestRec = [];
        $totalInterestRem = [];
        $interestTotal = [];
        foreach ($result as $keys => $row) {
            $output .= '<tr>
                            <td>' . ++$keys . '</td>
                            <td>' . $row['period_name'] . '</td>
                            <td>৳' . $row['total_loan'] . '/-</td>
                            <td>৳' . $row['loan'] . '/-</td>
                            <td>৳' . $row['loan_rem'] . '/-</td>
                            <td>৳' . $row['loan_total'] . '/-</td>
                            <td>৳' . $row['total_interest'] . '/-</td>
                            <td>৳' . $row['interest'] . '/-</td>
                            <td>৳' . $row['interest_rem'] . '/-</td>
                            <td>৳' . $row['interest_total'] . '/-</td>
                        </tr>';
            $totalLoan[] = $row['total_loan'];
            $totalLoanRec[] = $row['loan'];
            $totalLoanRem[] = $row['loan_rem'];
            $Loantotal[] = $row['loan_total'];
            $totalInterest[] = $row['total_interest'];
            $totalInterestRec[] = $row['interest'];
            $totalInterestRem[] = $row['interest_rem'];
            $interestTotal[] = $row['interest_total'];
        }
        $output .= '</tbody>
                    <tfoot>
                        <tr  style="font-weight: bolder;">
                            <td colspan="2" style="font-size: 22px; text-align: right;">সর্বমোট</td>
                            <td style="font-size: 22px;">৳' . array_sum($totalLoan) . '/-</td>
                            <td style="font-size: 22px;">৳' . array_sum($totalLoanRec) . '/-</td>
                            <td style="font-size: 22px;">৳' . array_sum($totalLoanRem) . '/-</td>
                            <td style="font-size: 22px;">৳' . array_sum($Loantotal) . '/-</td>
                            <td style="font-size: 22px;">৳' . array_sum($totalInterest) . '/-</td>
                            <td style="font-size: 22px;">৳' . array_sum($totalInterestRec) . '/-</td>
                            <td style="font-size: 22px;">৳' . array_sum($totalInterestRem) . '/-</td>
                            <td style="font-size: 22px;">৳' . array_sum($interestTotal) . '/-</td>
                        </tr>
                    </tfoot>';
        echo $output;
        // print_r($result);
    } else {
        echo false;
    }
}

if (isset($_POST['totalSavings']) && $_POST['totalSavings'] == 1) {
    $result = $fields->totalFDRLoad();

    if ($result != false) {
        $output = '<thead>
                        <th>#</th>
                        <th>খাত</th>
                        <th>টাকা</th>
                    </thead>
                    <tbody>';
        $total = array();
        foreach ($result as $keys => $row) {
            $output .= '<tr>
                            <td>' . ++$keys . '</td>
                            <td>' . $row['name'] . '</td>
                            <td>৳' . $row['savings'] . '/-</td>
                        </tr>';
            $total[] = $row['savings'];
        }
        $output .= '</tbody>
                    <tfoot>
                        <tr  style="font-weight: bolder;">
                            <td></td>
                            <td style="font-size: 22px;">সর্বমোট</td>
                            <td style="font-size: 22px;">৳' . array_sum($total) . '/-</td>
                        </tr>
                    </tfoot>';
        echo $output;
    } else {
        echo false;
    }
}

if (isset($_POST['finalAudit']) && $_POST['finalAudit'] == 1) {
    $result = $fields->finalAuditLoad();

    if ($result != false) {
        $output = '<thead>
                        <th>#</th>
                        <th>খাত</th>
                        <th>টাকা</th>
                    </thead>
                    <tbody>';
        $total = array();
        foreach ($result as $keys => $row) {
            $output .= '<tr>
                            <td>' . ++$keys . '</td>
                            <td>' . $row['name'] . '</td>
                            <td>৳' . $row['tk'] . '/-</td>
                        </tr>';
            $total[] = $row['tk'];
        }
        $final = $total['0'] - $total['1'];
        $output .= '</tbody>
                    <tfoot>
                        <tr  style="font-weight: bolder;" class="';
        if ($final > 0) {
            $output .=          'bg-success';
        } else {
            $output .=          'bg-danger';
        }
        $output .=          '">
                            <td></td>
                            <td class="d-flex justify-content-between">';
        if ($final > 0) {
            $output .=       'লাভ <span><i class="bx bx-plus';
        } else {
            $output .=       'লোকসান <span><i class="bx bx-minus';
        }
        $output .=          '"></i></span></td>
                            <td style="font-size: 22px;">' . $final . '/-</td>
                        </tr>
                    </tfoot>';
        echo $output;
    } else {
        echo false;
    }
}
