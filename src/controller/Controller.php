<?php
require 'model/dbOperations.php';
require 'model/models.php';
require_once 'config.php';

session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();

class Controller
{
    function __construct()
    {
        $this->objconfig = new config();
        $this->objsm =  new dbOperations($this->objconfig);
    }
    // mvc handler request
    public function mvcHandler()
    {
        $act = isset($_GET['act']) ? $_GET['act'] : NULL;
        switch ($act) {
            case 'add':
                $this->insert();
                break;
            case 'update':
                $this->update();
                break;
            case 'delete':
                $this->delete();
                break;
            default:
                $this->list();
        }
    }
    // page redirection
    public function pageRedirect($url)
    {
        header('Location:' . $url);
    }
    // check validation
    public function checkValidation($user)
    {
        $noerror = true;
        // Validate first_name        
        if (empty($user->first_name)) {
            $user->first_name_msg = "Field is empty.";
            $noerror = false;
        } elseif (!filter_var($user->first_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
            $user->first_name_msg = "Invalid entry.";
            $noerror = false;
        } else {
            $user->first_name_msg = "OK";
        }
        // Validate last_name            
        if (empty($user->last_name)) {
            $user->last_name_msg = "Field is empty.";
            $noerror = false;
        } elseif (!filter_var($user->last_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
            $user->last_name_msg = "Invalid entry.";
            $noerror = false;
        } else {
            $user->last_name_msg = "OK";
        }
        // Validate email            
        if (empty($user->email)) {
            $user->email_msg = "Field is empty.";
            $noerror = false;
        } elseif (!filter_var($user->email, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
            $user->email_msg = "Invalid entry.";
            $noerror = false;
        } else {
            $user->email_msg = "OK";
        }
        return $noerror;
    }
    // add new record
    public function insert()
    {
        try {
            $user = new User();
            if (isset($_POST['addbtn'])) {
                // read form value
                $user->first_name = trim($_POST['first_name']);
                $user->last_name = trim($_POST['last_name']);
                $user->email = trim($_POST['email']);
                //call validation
                $chk = $this->checkValidation($user);
                if ($chk) {
                    //call insert record            
                    $pid = $this->objsm->insertRecord($user);
                    if ($pid > 0) {
                        $this->list();
                    } else {
                        echo "Somthing is wrong..., try again.";
                    }
                } else {
                    $_SESSION['user0'] = serialize($user); //add session obj           
                    $this->pageRedirect("view/insert.php");
                }
            }
        } catch (Exception $e) {
            $this->close_db();
            throw $e;
        }
    }
    // update record
    public function update()
    {
        try {
            if (isset($_POST['updatebtn'])) {
                $user = unserialize($_SESSION['user0']);
                $user->id = trim($_POST['id']);
                $user->first_name = trim($_POST['first_name']);
                $user->last_name = trim($_POST['last_name']);
                $user->email = trim($_POST['email']);
                // check validation  
                $chk = $this->checkValidation($user);
                if ($chk) {
                    $res = $this->objsm->updateRecord($user);
                    if ($res) {
                        $this->list();
                    } else {
                        echo "Somthing is wrong..., try again.";
                    }
                } else {
                    $_SESSION['user0'] = serialize($user);
                    $this->pageRedirect("view/update.php");
                }
            } elseif (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
                $id = $_GET['id'];
                $result = $this->objsm->selectRecord($id);
                $row = mysqli_fetch_array($result);
                $user = new User();
                $user->id = $row["id"];
                $user->last_name = $row["last_name"];
                $user->first_name = $row["first_name"];
                $user->email = $row["email"];
                $_SESSION['user0'] = serialize($user);
                $this->pageRedirect('view/update.php');
            } else {
                echo "Invalid operation.";
            }
        } catch (Exception $e) {
            $this->close_db();
            throw $e;
        }
    }
    // delete record
    public function delete()
    {
        try {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $res = $this->objsm->deleteRecord($id);
                if ($res) {
                    $this->pageRedirect('index.php');
                } else {
                    echo "Somthing is wrong..., try again.";
                }
            } else {
                echo "Invalid operation.";
            }
        } catch (Exception $e) {
            $this->close_db();
            throw $e;
        }
    }
    public function list()
    {
        $result = $this->objsm->selectRecord(0);
        include "view/list.php";
    }
}
