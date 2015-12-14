class Artist {

    public static function signUp($email, $pass) {

        global $db;

        $result = $db->prepare("SELECT firstname FROM artists WHERE email = :email");
        $result->bindParam(':email', $email);
        $result->execute();
        $email_exists = ($result->rowCount() > 0) ? true : false;

        if($email_exists) {
            return true;
        } else {
            $hash = password_hash($_POST["password"]);

            $sql = "INSERT INTO artists (email, hash) values(:email, :hash)";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':hash', $hash);
            $stmt->execute();
        }

        $db = null;

    }


}
