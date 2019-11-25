<?php
    
    function getOneRecord($sql, $db, $parameter = null){
        $statement = $db->prepare($sql);
        $statement->execute($parameter);
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    function executeSQL($sql, $db, $parameter = null){
        $statement = $db->prepare($sql);
        $statement->execute($parameter);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
    }

    function getAllRecords($sql, $db, $parameter = null){
        $statement = $db->prepare($sql);
        $statement->execute($parameter);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    function checkValidUser($db){
        $sql = "select email, first_name, last_name from `users` where username = :username and password = :password";
        $values = array(':username'=>$_POST['username'], ':password'=>md5($_POST['password']));
        $result = getOneRecord($sql, $db, $values);
        
        return $result;
 }

?>
