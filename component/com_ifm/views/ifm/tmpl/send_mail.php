<?php
#
#---------------------------------------------------------------------------
#
#---------------------------------------------------------------------------
#
function send_mail ($to, $body, $subject, $fromaddress, $fromname, $attachments=false)
{

#
# Setup common variables
#
$eol = "\r\n";
$eoln = "\n";
$mime_boundary=md5(time());

#
# Common Headers
#
$headers  = "";
$headers .= "From: " . $fromname . "<" . $fromaddress . ">" . $eoln;
$headers .= "Reply-To: " . $fromname . "<" . $fromaddress . ">" . $eoln;
$headers .= "Return-Path: " . $fromname . "<" . $fromaddress . ">" . $eoln;
$headers .= "Message-ID: <" . time() . "-" . $fromaddress . ">" . $eoln;
$headers .= "X-Mailer: PHP v" . phpversion() . $eoln;

#
# Boundry for marking the split & Multitype Headers
#
#$headers .= 'MIME-Version: 1.0' . $eol . $eol;
$headers .= 'MIME-Version: 1.0' . $eoln;
$headers .= "Content-Type: multipart/mixed; boundary=\"" . $mime_boundary . "\"" . $eol . $eol;

#
# Open the first part of the mail
#
$msg = "--" . $mime_boundary . $eoln;
$htmlalt_mime_boundary = $mime_boundary . "_htmlalt";

#
# Setup for text OR html -
#
$msg .= "Content-Type: multipart/alternative; boundary=\"" . $htmlalt_mime_boundary . "\"" . $eol . $eol;

#
# Text Version
#
$msg .= "This is a multi-part message in MIME format." . $eoln;
$msg .= "--" . $htmlalt_mime_boundary . $eoln;
$msg .= "Content-Type: text/plain; charset=iso-8859-1" . $eoln;
$msg .= "Content-Transfer-Encoding: 8bit" . $eol . $eol;
$tmp = str_replace("<p>", "\n", $body);
$tmp = str_replace("</p>", "\n", $tmp);
$tmp = str_replace("<br />", "\n", $tmp);
$msg .= strip_tags (str_replace ("<br>", "\n", substr ($tmp, (strpos ($tmp, "<body>") + 6)))) . $eol . $eol;

#
# HTML Version
#
$msg .= "--" . $htmlalt_mime_boundary . $eoln;
$msg .= "Content-Type: text/html; charset=iso-8859-1" . $eoln;
$msg .= "Content-Transfer-Encoding: 8bit" . $eol . $eol;
$msg .= $body . $eol . $eol;

#
# close the html/plain text alternate portion
#
$msg .= "--" . $htmlalt_mime_boundary . "--" . $eol . $eol;

#
# Process any attachments if requested
#
if ($attachments !== false) {
    for($i = 0; $i < count ($attachments); $i++) {
		if (is_file ($attachments[$i]["file"])) {
		    #
		    # File for Attachment
		    #
		    $file_name = substr ($attachments[$i]["file"], (strrpos ($attachments[$i]["file"], "/") + 1));
		    $handle = fopen ($attachments[$i]["file"], 'rb');
		    $f_contents = fread ($handle, filesize ($attachments[$i]["file"]));
		    $f_contents = chunk_split (base64_encode ($f_contents));
		    $f_type = filetype ($attachments[$i]["file"]);
		    fclose ($handle);

		    #
		    # Attachment
		    #
		    $msg .= "--" . $mime_boundary . $eol;
	        $msg .= "Content-Type: " . $attachments[$i]["content_type"] . "; name=\"" . $file_name . "\"" . $eol;
		    $msg .= "Content-Transfer-Encoding: base64" . $eol;
		    $msg .= "Content-Description: " . $file_name . $eol;
		    $msg .= "Content-Disposition: attachment; filename=\"" . $file_name . "\"" . $eol . $eol;
		    $msg .= $f_contents . $eol . $eol;
	    }
	}
}

#
# Finish the mime
#
$msg .= "--" . $mime_boundary . "--" . $eol . $eol;

#
# Set the from address in the INI
#
ini_set ("sendmail_from", $fromaddress);

#
# Send the mail message
#
$mail_sent = mail ($to, $subject, $msg, $headers);

#
# Restore the from address in the INI
#
ini_restore ("sendmail_from");

#
# Return the mail send status
#
return $mail_sent;

}
?>
