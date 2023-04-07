<?php
require_once('./mailer/vendor/autoload.php');
// Connect to the database
include("./connectdb.php") ;
use PHPMailer\PHPMailer\PHPMailer;

$addressline1 = $_POST['addressline1'];
$addressline2 = $_POST['addressline2'];
$city = $_POST['city'];
$postcode = $_POST['postcode'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$username = $_POST['username'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password_entry = $_POST['password_entry'];

// Convert the customer password to an encrypted password
$Crypted_pass = sha1($password_entry);

// Insert the user's data into the user and useradresstable table by using a prepare then execute operation
$stmt = $db->prepare("CALL adduseridtotables(:aa, :cc, :kk, :ff, :gg, :ii, :hh, :dd, :ee, :bb, :jj)");
$stmt->execute(array(
    ":aa" => $username,
    ":bb" => $email,
    ":cc" => $Crypted_pass,
    ":dd" => $firstname,
    ":ee" => $lastname,
    ":ff" => $addressline1,
    ":gg" => $addressline2,
    ":hh" => $postcode,
    ":ii" => $city,
    ":jj" => $phone,
    ":kk" => 2
));
// here i would have a domain and have it registered in order to send
//due to spam accounts and in general scammers it is no longer possible to do.
// here is an example of an email form that would be used to send the privacy aggreement and terms of being on the website.
// Send an email to the user
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = '';
$mail->Password = '';
$mail->setFrom('', 'ross');
$mail->addAddress($email, $firstname . ' ' . $lastname);
$mail->Subject = 'Welcome to our website!';
$mail->Body = 'Thank you for registering with our website!
Here is the privacy policy and the rules for Dumfries Gamers.

Privacy Policy

This Privacy Policy sets out how Dumfries Gamers ("we", "us", or "our") uses and protects any information that you give us when you use this website DumfriesGamers.co.uk.

We are committed to ensuring that your privacy is protected. Should we ask you to provide certain information by which you can be identified when using this website, then you can be assured that it will only be used in accordance with this privacy policy.

We may change this policy from time to time by updating this page. You should check this page from time to time to ensure that you are happy with any changes.

What information we collect:

We may collect the following information:

Name
Contact information including email address
Demographic information such as postcode, preferences and interests
Other information relevant to customer surveys and/or offers
What we do with the information we gather:

We require this information to understand your needs and provide you with a better service, and in particular for the following reasons:

Internal record keeping.
We may use the information to improve our products and services.
We may periodically send promotional emails about new products, special offers or other information which we think you may find interesting using the email address which you have provided.
From time to time, we may also use your information to contact you for market research purposes. We may contact you by email, phone, or mail.
Security

We are committed to ensuring that your information is secure. In order to prevent unauthorised access or disclosure, we have put in place suitable physical, electronic and managerial procedures to safeguard and secure the information we collect online.


';
$mail-> Body = 'How we use cookies:

A cookie is a small file which asks permission to be placed on your computer"s hard drive. Once you agree, the file is added and the cookie helps analyse web traffic or lets you know when you visit a particular site. Cookies allow web applications to respond to you as an individual. The web application can tailor its operations to your needs, likes and dislikes by gathering and remembering information about your preferences.

We use traffic log cookies to identify which pages are being used. This helps us analyse data about web page traffic and improve our website in order to tailor it to customer needs. We only use this information for statistical analysis purposes and then the data is removed from the system.

Overall, cookies help us provide you with a better website by enabling us to monitor which pages you find useful and which you do not. A cookie in no way gives us access to your computer or any information about you, other than the data you choose to share with us.

You can choose to accept or decline cookies. Most web browsers automatically accept cookies, but you can usually modify your browser setting to decline cookies if you prefer. This may prevent you from taking full advantage of the website.

Links to other websites:

Our website may contain links to other websites of interest. However, once you have used these links to leave our site, you should note that we do not have any control over that other website. Therefore, we cannot be responsible for the protection and privacy of any information which you provide whilst visiting such sites and such sites are not governed by this privacy statement. You should exercise caution and look at the privacy statement applicable to the website in question.

Controlling your personal information:

You may choose to restrict the collection or use of your personal information in the following ways:

Whenever you are asked to fill in a form on the website, look for the box that you can click to indicate that you do notwant the information to be used by anybody for direct marketing purposes.

If you have previously agreed to us using your personal information for direct marketing purposes, you may change your mind at any time by contacting us.
We will not sell, distribute, or lease your personal information to third parties unless we have your permission or are required by law to do so. We may use your personal information to send you promotional information about third parties which we think you may find interesting if you tell us that you wish this to happen.

You may request details of personal information which we hold about you under the Data Protection Act 2018. A small fee will be payable. If you would like a copy of the information held on you please write to [your company address].

If you believe that any information we are holding on you is incorrect or incomplete, please write to or email us as soon as possible at the above address. We will promptly correct any information found to be incorrect.

Contact:

If you have any questions about this privacy policy, or the use of your personal information, you can contact us at DumfriesG@gmail.com.';
$mail->send();

// Redirect the user to the homepage
header("Location: ./index.php");
?>