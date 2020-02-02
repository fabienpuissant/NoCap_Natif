<?php

class Mail {


  public function __construct(){

  }

  public function send_email($token, $email, $user_id) {


      $mail = new PHPMailer();
      $mail->isSMTP();
      $mail->SMTPAuth = true;
      $mail->SMTPSecure = 'ssl';
      $mail->Host = 'smtp.gmail.com';
      $mail->Port = '465';
      $mail->isHTML(true);
      $mail->Username = 'nocapwebsite@gmail.com';
      $mail->Password = 'NoCap2019';
      $mail->SetFrom('nocapwebsite@gmail.com');
      $mail->Subject = 'Confirmation d\'inscription';
      $mail->Body = 'http://localhost/NoCap/photographe/confirm.php?id='. urlencode($user_id) .'&key'. $token;
      $mail->AddAddress($email);
      $mail->Send();
  }

  public function confirm($user_id, $token) {

      require('database.php');
      $req = $bdd->prepare('SELECT confirmation_token FROM user WHERE id = ?');
      $req->execute([$user_id]);

      $user = $req->fetch();
      if($user['confirmation_token'] == $token){
      	$req = $bdd->prepare("UPDATE user SET confirmation_token = 'confirmed', confirmed_at = NOW() WHERE id = ?");
      	$req->execute([$user_id]);
        return true;
    } else {
      return false;
    }

  }

}


 ?>
