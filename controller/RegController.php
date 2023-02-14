<?php

namespace controller\RegController\RegController;

use PDO;
use config\Database\Database;

include_once "../config/app.php";
include_once "../config/database.php";

class RegController
{
    public function __construct()
    {
        $this->db = new Database();
        $this->conn = $this->db->link;
        $this->db_name = $this->db->dbName;
    }

    // User Registration Function
    public function userReg($email, $name, $nid = null, $mobile_1, $mobile_2 = null, $blood = null, $dob = null, $role, $status = 2, $token, $image = null)
    {
        $sql = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $sql->execute([$email]);
        $result = $sql->rowCount();
        if ($result > 0) {
            return "email_exist";  // DATA DOES NOT INSERTED
        } else {
            $sql = $this->conn->prepare("INSERT INTO users (email, name, nid, mobile_1, mobile_2, blood, dob, role, image, status, token) VALUES (:email, :name, :nid, :mobile_1, :mobile_2, :blood, :dob, :role, :image, :status, :token)");


            // CHECK TO SEE INSERT DATA OR NOT
            if ($sql->execute([":email" => $email, ":name" => $name, ":nid" => $nid, ":mobile_1" => $mobile_1, ":mobile_2" => $mobile_2, ":blood" => $blood, ":dob" => $dob, ":role" => $role, ":image" => $image, ":status" => $status, ":token" => $token])) {
                return true;  // DATA SUCCESSFULLY INSERTED
            } else {
                return false;  // DATA DOES NOT INSERTED
            }
        }
    }

    // User Update Method
    public function userUpdate($name, $nid = null, $mobile_1, $mobile_2 = null, $blood = null, $dob = null, $id, $image = null)
    {
        if ($image == null) {
            $sql = $this->conn->prepare("UPDATE users SET name = :name,nid=:nid,mobile_1=:mobile_1,mobile_2=:mobile_2,blood=:blood,dob=:dob, updated_at= CURRENT_DATE WHERE id= :id");

            // CHECK TO SEE INSERT DATA OR NOT
            if ($sql->execute([":name" => $name, ":nid" => $nid, ":mobile_1" => $mobile_1, ":mobile_2" => $mobile_2, ":blood" => $blood, ":dob" => $dob, ":id" => $id])) {
                if ($sql->rowCount() > 0) {
                    return true;  // DATA SUCCESSFULLY INSERTED
                } else {
                    return false;
                }
            } else {
                return false;  // DATA DOES NOT INSERTED
            }
        } else {
            $sql = $this->conn->prepare("UPDATE users SET name = :name,nid=:nid,mobile_1=:mobile_1,mobile_2=:mobile_2,blood=:blood,dob=:dob, image=:image,updated_at= CURRENT_DATE WHERE id= :id");

            // CHECK TO SEE INSERT DATA OR NOT
            if ($sql->execute([":name" => $name, ":nid" => $nid, ":mobile_1" => $mobile_1, ":mobile_2" => $mobile_2, ":blood" => $blood, ":dob" => $dob, ":image" => $image, ":id" => $id])) {
                if ($sql->rowCount() > 0) {
                    return true;  // DATA SUCCESSFULLY INSERTED
                } else {
                    return false;
                }
            } else {
                return false;  // DATA DOES NOT INSERTED
            }
        }
    }

    // Field Registration Function
    public function fieldReg($field_name, $field_dec = null)
    {
        $sql = $this->conn->prepare("SELECT * FROM feilds WHERE field_name = ?");
        $sql->execute([$field_name]);
        $result = $sql->rowCount();
        if ($result > 0) {
            return "name_exist";  // DATA DOES NOT INSERTED
        } else {
            $sql = $this->conn->prepare("INSERT INTO feilds (field_name, field_dec) VALUES (:name, :dec)");

            // CHECK TO SEE INSERT DATA OR NOT
            if ($sql->execute([":name" => $field_name, ":dec" => $field_dec])) {
                return true;  // DATA SUCCESSFULLY INSERTED
            } else {
                return false;  // DATA DOES NOT INSERTED
            }
        }
    }

    // center Registration Function
    public function centerReg($center_name, $center_dec = null, $feild)
    {
        $sql = $this->conn->prepare("SELECT * FROM centers WHERE center_name = ?");
        $sql->execute([$center_name]);
        $result = $sql->rowCount();
        if ($result > 0) {
            return "name_exist";  // DATA DOES NOT INSERTED
        } else {
            $sql = $this->conn->prepare("INSERT INTO centers (center_name, center_dec, feild_id) VALUES (:name, :dec, :feild)");

            // CHECK TO SEE INSERT DATA OR NOT
            if ($sql->execute([":name" => $center_name, ":dec" => $center_dec, ":feild" => $feild])) {
                return true;  // DATA SUCCESSFULLY INSERTED
            } else {
                return false;  // DATA DOES NOT INSERTED
            }
        }
    }


    // Period Registration Function
    public function periodReg($period_name, $period, $period_type, $period_details = null)
    {
        $type = implode(",", $period_type);
        $sql = $this->conn->prepare("SELECT * FROM periods WHERE period_name = ?");
        $sql->execute([$period_name]);
        $result = $sql->rowCount();
        if ($result > 0) {
            return "name_exist";  // DATA DOES NOT INSERTED
        } else {
            $sql = $this->conn->prepare("INSERT INTO periods (period_name, period, period_type, period_details) VALUES (:name, :period, :period_type, :period_details)");

            // CHECK TO SEE INSERT DATA OR NOT
            if ($sql->execute([":name" => $period_name, ":period" => $period, ":period_type" => $type, ":period_details" => $period_details])) {
                return true;  // DATA SUCCESSFULLY INSERTED
            } else {
                return false;  // DATA DOES NOT INSERTED
            }
        }
    }

    // FDR Registration
    public function fdrReg($name, $deposit, $start_date, $expiry_date, $dec = null, $officer_id)
    {
        $sql = $this->conn->prepare("INSERT INTO fdr_lists (name, deposit, start, expiry, details, officers_id) VALUES (:name, :deposit, :start, :expiry, :details, :officers_id)");

        // CHECK TO SEE INSERT DATA OR NOT
        if ($sql->execute([":name" => $name, ":deposit" => $deposit, ":start" => $start_date, ":expiry" => $expiry_date, ":details" => $dec, ":officers_id" => $officer_id])) {
            return true;  // DATA SUCCESSFULLY INSERTED
        } else {
            return false;  // DATA DOES NOT INSERTED
        }
    }
    // FDR Update
    public function fdrupdate($fdrID, $name, $deposit, $start_date, $expiry_date, $dec = null)
    {
        $sql = $this->conn->prepare("UPDATE fdr_lists SET name= :name, deposit= :deposit,start= :start, expiry = :expiry, details = :details WHERE id = :id");

        // CHECK TO SEE INSERT DATA OR NOT
        if ($sql->execute([":name" => $name, ":deposit" => $deposit, ":start" => $start_date, ":expiry" => $expiry_date, ":details" => $dec, ":id" => $fdrID])) {
            if ($sql->rowCount() > 0) {
                return true;  // DATA SUCCESSFULLY INSERTED
            } else {
                return false;  // DATA DOES NOT INSERTED
            }
        } else {
            return false;  // DATA DOES NOT INSERTED
        }
    }
    // FDR Switch
    public function fdrSwitch($id, $status)
    {
        $sql = $this->conn->prepare("UPDATE fdr_lists SET status = '${status}' WHERE id = '${id}'");

        // CHECK TO SEE INSERT DATA OR NOT
        if ($sql->execute()) {
            if ($sql->rowCount() > 0) {
                return true;  // DATA SUCCESSFULLY INSERTED
            } else {
                return false;  // DATA DOES NOT INSERTED
            }
        } else {
            return false;  // DATA DOES NOT INSERTED
        }
    }

    // Income Registration
    public function incomeReg($income, $date, $dec, $officer_id)
    {
        $sql = $this->conn->prepare("INSERT INTO incomes (date, income, details, officer_id) VALUES (:date, :income, :details, :officer_id)");

        // CHECK TO SEE INSERT DATA OR NOT
        if ($sql->execute([":date" => $date, ":income" => $income, ":details" => $dec, ":officer_id" => $officer_id])) {
            return true;  // DATA SUCCESSFULLY INSERTED
        } else {
            return false;  // DATA DOES NOT INSERTED
        }
    }

    // Income Update
    public function incomeUpdate($income, $date, $dec, $id)
    {
        $sql = $this->conn->prepare("UPDATE incomes SET date= :date, income= :income, details=:details, updated_at= CURRENT_DATE WHERE id = :id");

        // CHECK TO SEE INSERT DATA OR NOT
        if ($sql->execute([":date" => $date, ":income" => $income, ":details" => $dec, ":id" => $id])) {
            return true;  // DATA SUCCESSFULLY INSERTED
        } else {
            return false;  // DATA DOES NOT INSERTED
        }
    }
    // Income Delete
    public function incomeDelete($id)
    {
        $sql = $this->conn->prepare("DELETE FROM incomes WHERE id = :id");

        // CHECK TO SEE INSERT DATA OR NOT
        if ($sql->execute([":id" => $id])) {
            return true;  // DATA SUCCESSFULLY INSERTED
        } else {
            return false;  // DATA DOES NOT INSERTED
        }
    }

    // Expence Registration
    public function expenceReg($expence, $date, $dec, $officer_id, $type, $fdrID = null)
    {
        if ($fdrID != null) {
            $this->conn->beginTransaction();

            $sql = $this->conn->prepare("UPDATE fdr_lists SET interest= interest + '${expence}' WHERE id = '${fdrID}'");
            $sql->execute();
            if ($sql->rowCount() > 0) {
                $sql = $this->conn->prepare("INSERT INTO expenses (date, expence, details, type, officer_id) VALUES (:date, :expence, :details, :type, :officer_id)");

                // CHECK TO SEE INSERT DATA OR NOT
                if ($sql->execute([":date" => $date, ":expence" => $expence, ":details" => $dec, ":type" => $type, ":officer_id" => $officer_id])) {
                    if ($sql->rowCount() > 0) {
                        $this->conn->commit();
                        return true;  // DATA SUCCESSFULLY INSERTED
                    } else {
                        $this->conn->rollback();
                        return false;  // DATA DOES NOT INSERTED
                    }
                } else {
                    return false;  // DATA DOES NOT INSERTED
                }
            } else {
                $this->conn->rollback();
                return false;  // DATA DOES NOT INSERTED
            }
        } else {

            $sql = $this->conn->prepare("INSERT INTO expenses (date, expence, details, type, officer_id) VALUES (:date, :expence, :details, :type, :officer_id)");

            // CHECK TO SEE INSERT DATA OR NOT
            if ($sql->execute([":date" => $date, ":expence" => $expence, ":details" => $dec, ":type" => $type, ":officer_id" => $officer_id])) {
                if ($sql->rowCount() > 0) {
                    return true;  // DATA SUCCESSFULLY INSERTED
                } else {
                    return false;  // DATA DOES NOT INSERTED
                }
            } else {
                return false;  // DATA DOES NOT INSERTED
            }
        }
    }

    // Income Update
    public function expenceUpdate($expence, $date, $dec, $id)
    {
        $sql = $this->conn->prepare("UPDATE expenses SET date= :date, expence= :expence, details=:details, updated_at= CURRENT_DATE WHERE id = :id");

        // CHECK TO SEE INSERT DATA OR NOT
        if ($sql->execute([":date" => $date, ":expence" => $expence, ":details" => $dec, ":id" => $id])) {
            if ($sql->rowCount() > 0) {
                return true;  // DATA SUCCESSFULLY INSERTED
            } else {
                return false;  // DATA DOES NOT INSERTED
            }
        } else {
            return false;  // DATA DOES NOT INSERTED
        }
    }

    // Income Delete
    public function expenceDelete($id)
    {
        $sql = $this->conn->prepare("DELETE FROM expenses WHERE id = :id");

        // CHECK TO SEE INSERT DATA OR NOT
        if ($sql->execute([":id" => $id])) {
            if ($sql->rowCount() > 0) {
                return true;  // DATA SUCCESSFULLY INSERTED
            } else {
                return false;  // DATA DOES NOT INSERTED
            }
        } else {
            return false;  // DATA DOES NOT INSERTED
        }
    }

    // Send Message Registration
    public function sendMSGReg($officer_id, $officer, $sub, $details)
    {
        $sql = $this->conn->prepare("INSERT INTO notification (from_officer_id, sub, details, to_officer_id) VALUES (:from, :sub, :details, :to)");

        // CHECK TO SEE INSERT DATA OR NOT
        if ($sql->execute([":from" => $officer_id, ":sub" => $sub, ":details" => $details, ":to" => $officer])) {
            if ($sql->rowCount() > 0) {
                return true;  // DATA SUCCESSFULLY INSERTED
            } else {
                return false;  // DATA DOES NOT INSERTED
            }
        } else {
            return false;  // DATA DOES NOT INSERTED
        }
    }

    // background Theme Registration
    public function theme($img, $officer_id)
    {
        $sql = $this->conn->prepare("SELECT * FROM themes WHERE officers_id = '${officer_id}'");
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $this->conn->prepare("UPDATE themes SET bg_img = :img WHERE officers_id = '${officer_id}'");

            $sql->execute([":img" => $img]);

            if ($sql->rowCount() > 0) {
                return true;  // DATA SUCCESSFULLY INSERTED
            } else {
                return false;  // DATA DOES NOT INSERTED
            }
        } else {
            $sql = $this->conn->prepare("INSERT INTO themes(officers_id, bg_img) VALUES (:id, :img)");

            $sql->execute([":id" => $officer_id, ":img" => $img]);

            if ($sql->rowCount() > 0) {
                return true;  // DATA SUCCESSFULLY INSERTED
            } else {
                return false;  // DATA DOES NOT INSERTED
            }
        }
    }

    // Primary Settings
    public function primarySettings($siteName, $timeStart, $timeEnd, $logo_name = null)
    {
        if ($logo_name != null) {
            $query = "UPDATE settings SET site_name='${siteName}',time_start='${timeStart}',time_end='${timeEnd}',logo='${logo_name}' WHERE id = '1'";
        } else {
            $query = "UPDATE settings SET site_name='${siteName}',time_start='${timeStart}',time_end='${timeEnd}' WHERE id = '1'";
        }

        $sql = $this->conn->prepare($query);

        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;  // DATA SUCCESSFULLY INSERTED
        } else {
            return false;  // DATA DOES NOT INSERTED
        }
    }

    // Load Settings
    public function loadSettings()
    {

        $sql = $this->conn->prepare("SELECT * FROM settings WHERE id = '1'");

        $sql->execute();

        if ($sql->rowCount() > 0) {
            $result = $sql->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return false;  // DATA DOES NOT INSERTED
        }
    }

    // Load Elements for Settings
    public function SettignElementsLoad($query)
    {

        $sql = $this->conn->prepare($query);

        $sql->execute();

        if ($sql->rowCount() > 0) {
            $result = $sql->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return false;  // DATA DOES NOT Retrive
        }
    }
    // Elements Permission
    public function elementsPermission($query)
    {

        $sql = $this->conn->prepare($query);

        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;  // DATA DOES NOT INSERTED
        }
    }
}
