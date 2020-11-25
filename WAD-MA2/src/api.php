<?php
    require_once('functions.php');
    debug($_POST);

    session_start();
    if (!isset($_SESSION['userID'])) {
        debug('Session variable userID not set.<br>');
        leave('User not authenticated.');
    } else {
        if (!isset($_POST['entity']) || !isset($_POST['action'])) {
            leave();
        } else {
            $entity = $_POST['entity'];
            $action = $_POST['action'];

            switch ($entity) {
                case 'person':
                    require_once('person.php');
                    $person = new Person;

                    switch ($action) {
                        case 'search':
                            if (!isset($_POST['searchText'])) {
                                leave();
                            } else {
                                echo json_encode($person->search($_POST['searchText']));
                            }
                            break;
                        case 'add':
                            if (!isset($_POST['personName'])) {
                                leave();
                            } else {
                                echo json_encode($person->add($_POST['personName']));
                            }
                            break;
                        case 'delete':
                            if (!isset($_POST['personID'])) {
                                leave();
                            } else {
                                echo json_encode($person->delete($_POST['personID']));
                            }
                            break;
                    }

                    break;
                case 'user':
                    require_once('user.php');
                    $user = new User;

                    switch ($action) {
                        case 'update':
                            if (!isset($_POST['email'])) {
                                leave();
                            } else {
                                echo json_encode($user->update($_POST['email'], $_POST['firstName'], $_POST['lastName'], $_POST['password'], $_POST['newPassword']));
                            }
                            break;
                    }
                    break;
                case 'session':
                    switch ($action) {
                        case 'destroy':
                            session_destroy();
                            leave('Session destroyed');
                            break;
                    }
            }
        }
    }
?>


//
// <?php
//     require_once('functions.php');
//
//     debug($_POST);
//
//     if (!isset($_POST['entity']) || !isset($_POST['action'])) {
//         leave();
//     } else {
//         $entity = $_POST['entity'];
//         $action = $_POST['action'];
//
//         switch ($entity) {
//             case 'user':
//                 require_once('user.php');
//                 $user = new User;
//
//                 switch ($action) {
//                     case 'search':
//                         if (!isset($_POST['info'])) {
//                             leave();
//                         } else {
//                             echo json_encode($user->search($_POST['info']));
//                         }
//                         break;
//                     case 'add':
//                         if (!isset($_POST['info'])) {
//                             leave();
//                         } else {
//                             echo json_encode($user->add($_POST['info']));
//                         }
//                         break;
//                 }
//                 break;
//         }
//     }
// ?>
