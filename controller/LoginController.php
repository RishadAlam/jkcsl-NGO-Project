<?php

namespace controller\LoginController\LoginController;

use PDO;
use config\Database\Database;

include_once "../config/app.php";
include_once "../config/database.php";
// namespace controller\LoginController;

class LoginController
{

    public function __construct()
    {
        $this->db = new Database();
        $this->conn = $this->db->link;
    }

    public function login($user_email, $user_password, $rememberMe = null)
    {
        // User Email Authentication
        $sql = $this->conn->prepare("SELECT status FROM users WHERE email = ?");
        $sql->execute([$user_email]);

        if ($sql->rowCount() > 0) {
            // Fetch user Status
            $result = $sql->fetch(PDO::FETCH_ASSOC);

            // Status Authentication
            if ($this->status($result['status'])) {
                // Password Authentication
                $sql = $this->conn->prepare("SELECT * FROM users WHERE email = :email AND password = :pass");
                $sql->execute([":email" => $user_email, ":pass" => $user_password]);

                if ($sql->rowCount() > 0) {
                    // Store Data in user variable
                    $user = $sql->fetch(PDO::FETCH_ASSOC);

                    // Call User Authentication Function
                    $this->userAutentication($user, $rememberMe);
                    return true;
                } else {
                    // Redirect to login Page
                    redirect("login.php", "password_error", "ভুল পাসওয়ার্ড দিয়েছেন");
                }
            }
        } else {
            // Redirect to login Page
            redirect("login", "email_error", "ভুল ইমেল দিয়েছেন");
        }
    }

    // Status Checking Function
    public function status($userStatus)
    {
        if ($userStatus == 1) {
            return true;
        } elseif ($userStatus == 2) {
            redirect("404.php");
            return false;
        } else {
            redirect("404.php");
            return false;
        }
    }

    // User Authentication Function
    public function userAutentication($user, $rememberMe = null)
    {
        // Create Authentication Session
        $_SESSION['authenticate'] = true;

        // Create Remember me Cookies
        isset($rememberMe) ? setcookie("userEmail", $user['email'], time() + 604800, "/") : null;

        $id = $user['id'];
        $sql = $this->conn->prepare("SELECT * FROM themes WHERE officers_id = '${id}' LIMIT 1");
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $theme = $sql->fetchALL(PDO::FETCH_ASSOC);
        } else {
            $sql = $this->conn->prepare("SELECT * FROM themes WHERE officers_id = 'all' LIMIT 1");
            $sql->execute();
            $theme = $sql->fetchALL(PDO::FETCH_ASSOC);
        }
        foreach ($theme as $value) {
            $bgIMG = $value['bg_img'];
        }

        // Store user data
        $_SESSION['auth'] = [
            'user_id' => $user['id'],
            'user_name' => $user['name'],
            'user_role' => $user['role'],
            'user_email' => $user['email'],
            'user_img' => $user['image'],
            'bgImg' => $bgIMG,
        ];

        // Create Authentication Cookies
        setcookie("userID", $_SESSION['auth']['user_id'], time() + 604800, "/");
        setcookie("userName", $_SESSION['auth']['user_name'], time() + 604800, "/");
        setcookie("userRole", $_SESSION['auth']['user_role'], time() + 604800, "/");
        setcookie("userImg", $_SESSION['auth']['user_img'], time() + 604800, "/");
        setcookie("bgImg", $_SESSION['auth']['bgImg'], time() + 604800, "/");
    }

    public function logout()
    {
        if (isset($_SESSION['authenticate']) === true) {
            setcookie("userID", $_SESSION['auth']['id'], time() - 604800, "/");
            session_unset();
            session_destroy();
            return true;
        } else {
            return false;
        }
    }

    public function chengePassword($current, $new, $confirm)
    {
        $userID = $_SESSION['auth']['user_id'];
        $currentPassword = sha1($current);
        $newPassword = sha1($new);
        $confirmPassword = sha1($confirm);

        $sql = $this->conn->prepare("SELECT password FROM users WHERE id = '${userID}'");
        $sql->execute();
        $cPassword = $sql->fetchAll(PDO::FETCH_ASSOC);

        if ($cPassword[0]['password'] === $currentPassword) {
            $sql = $this->conn->prepare("UPDATE users SET password = '${confirmPassword}' WHERE id = '${userID}'");

            if ($sql->execute()) {
                if ($sql->rowCount() > 0) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return "wrongPassword";
        }
    }

    public function activateAccount($newPass, $email, $token)
    {
        $newPass = sha1($newPass);

        $sql = $this->conn->prepare("SELECT token FROM users WHERE email = '${email}' AND status = '2'");
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $tokens = $sql->fetchAll(PDO::FETCH_ASSOC);

            if ($tokens[0]['token'] === $token) {
                $sql = $this->conn->prepare("UPDATE users SET password = '${newPass}', status = '1' WHERE email = '${email}'");

                if ($sql->execute()) {
                    if ($sql->rowCount() > 0) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return "token_error";
            }
        } else {
            return "email_error";
        }
    }
}
