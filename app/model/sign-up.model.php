<?php

class signUp {

    public function __construct() {
        require_once $_SERVER["DOCUMENT_ROOT"] . "/../protected/db-connect.php";
        $db = new Database;
        $this->con = $db->connect();
    }

    public function emailExists($email) {
    // Check if email exists

        $stmt = $this->con->prepare("SELECT email FROM artists WHERE email = :email LIMIT 1");
        $stmt->execute(array("email" => $email));
        $result = $stmt->fetchColumn();

        if ( $result === $email ) {
            return true;
        }

        else return false;

    }

    public function confirmEmail($confirmkey) {
    // Insert into our database of pending confirmations

        $sql = "SELECT email, confirmkey FROM confirm WHERE confirmkey = :confirmkey LIMIT 1";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':confirmkey', $confirmkey);
        $stmt->execute();
        $result = $stmt->fetch();

        if ( $result["confirmkey"] === $confirmkey ) {

            // Mark email as confirmed in artists table
            $sql = "UPDATE artists
                    SET confirmedEmail = 1
                    WHERE email = :email";
            $stmt = $this->con->prepare($sql);
            $stmt->execute(array("email" => $result["email"]));

            // Clear the user entry from the confirm table
            $sql = "DELETE FROM confirm WHERE confirmkey = :confirmkey LIMIT 1";
            $stmt = $this->con->prepare($sql);
            $stmt->execute(array("confirmkey" => $confirmkey));

            // Give us the email
            return $result["email"];
        }

        else return null;
    }

    public function insertArtist($email, $hash) {
    // Put the email and hash into our user database

        $sql = "INSERT INTO artists (email, hash, confirmedEmail) values(:email, :hash, 0)";
        $stmt = $this->con->prepare($sql);
        $stmt->execute(array("email" => $email, "hash" => $hash));

        $sql = "SELECT id FROM artists WHERE email = :email";
        $stmt = $this->con->prepare($sql);
        $stmt->execute(array("email" => $email));
        $result = $stmt->fetch();

        return $result["id"];

    }

    public function mailConfirmation($email) {
    // Mail the user a confirmation email

        $confirmkey = md5(microtime().rand());
        $sql = "INSERT INTO confirm (email, confirmkey) values(:email, :confirmkey)";
        $stmt = $this->con->prepare($sql);
        $stmt->execute(array("email" => $email, "confirmkey" => $confirmkey));

        include_once("Mail.php");
        $recipients = $email;
        $headers['From'] = 'FAWN Worldwide <info@fawnworldwide.org>';
        $headers['To'] = $email;
        $headers['Subject'] = 'FAWN: Please confirm your email address';
        $headers['Content-Type'] = 'text/html; charset=UTF-8';
        $body = "Thanks for signing up for FAWN! Please click <a href=\"http://fawnworldwide.org/app/controller/sign-up.controller.php?confirm=$confirmkey\">here</a> to confirm your email address.";
        $result = Mail::factory('sendmail', $params)->send($recipients, $headers, $body);
    }

    public function activateUser($confirmkey) {
        $sql = "SELECT confirmkey, email, hash FROM confirm WHERE confirmkey = :confirmkey LIMIT 1";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':confirmkey', $confirmkey);
        $stmt->execute();
        $result = $stmt->fetch();

        if ( $result["confirmkey"] === $confirmkey ) {
            $sql = "DELETE FROM confirm WHERE confirmkey = :confirmkey LIMIT 1";
            $stmt = $this->con->prepare($sql);
            $stmt->execute(array("confirmkey" => $confirmkey));
            return $result["email"];
        }

        else return null;
    }

    public function notifySlack($id, $name, $occupation, $location, $cause) {

        // Get the Slack webhook URL from our secrets.php file
        require_once $_SERVER["DOCUMENT_ROOT"] . "/../protected/secrets.php";

        $attachment = [];
        $userArray = [];
        $payloadArray["attachments"] = [];
        $attachment["fields"] = [];
        $fields = [];
        $channel = "@slackbot";

        // Slack attachment
        $attachment["fallback"] = "We have a new user on FAWN! " . $name . " (http://fawnworldwide.org/forger/$id) — Admin page (http://fawnworldwide.org/admin/)";
        $attachment["color"] = "#2079D1";
        $attachment["pretext"] = "We have a new user on FAWN!";
        $attachment["title"] = $name;
        $attachment["title_link"] = "http://fawnworldwide.org/forger/$id";
        // $attachment["image_url"] = "http://fawnworldwide.org/app/controller/avatar.controller.php?id=$id";
        $fields["title"] = "Occupation";
        $fields["value"] = $occupation;

        array_push($attachment["fields"], ["title" => "Occupation", "value" => $occupation], ["title" => "Location", "value" => $location], ["title" => "Cause", "value" => $cause]);

        array_push($payloadArray["attachments"], $attachment);
        $payload = json_encode($payloadArray);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $webhookURL);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "payload=$payload");

        curl_exec ($ch);
        curl_close ($ch);

    }

}

?>
