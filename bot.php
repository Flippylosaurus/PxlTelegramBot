<?php
/**
 * Telegram Cowsay Bot Example.
 * Add @cowmooobot to try it!
 * @author Gabriele Grillo <gabry.grillo@alice.it>
 */
include("Telegram.php");
include("functions.pxl.php");
include("functions.config.php");
$config = get_config();
// Set the bot TOKEN
$bot_token = $config->bottoken;
// Instances the class
$telegram = new Telegram($bot_token);
/* If you need to manually take some parameters
*  $result = $telegram->getData();
*  $text = $result["message"] ["text"];
*  $chat_id = $result["message"] ["chat"]["id"];
*/
// Take text and chat_id from the message
$result = $telegram->getData();
$text = $telegram->Text();
$chat_id = $telegram->ChatID();
if ($text == "/start") {
    // Create a permanent custom keyboard
    $content = array('chat_id' => $chat_id, 'text' => "Send me a PM or reply to a image with /uploadpic.");
    $telegram->sendMessage($content);
}
if ($text == "/uploadpic" ) {
    if($result['chat']['type'] == 'private') { 
        $content = array('chat_id' => $chat_id, 'text' => 'You are messaging me in private, you don\'t need to type this command, just upload a picture.');
        $telegram->sendMessage($content);
        die();
    }
    if(!in_array('reply_to_message', $content)) {
        $content = array('chat_id' => $chat_id, 'text' => 'Please reply to a message.');
        $telegram->sendMessage($content);
        die(); 
    }
    $reply_message = $content['reply_to_message'];
    if(!in_array('photo', $reply_message)) {
        $content = array('chat_id' => $chat_id, 'text' => 'Please reply to a picture.');
        $telegram->sendMessage($content);
        die(); 
    }
    $photoId = $telegram->getFileID();
    $array = $telegram->getFile($telegram->getReplyFileID());
    $filename = count(glob('./download/*.{jpg}', GLOB_BRACE)) + 1;
    $telegram->downloadFile($array["result"]["file_path"], "./download/" . str_replace('photos/', '', $filename . '.jpg'));

}
if ($text == "/credit" || $text == "Credit") {
    $reply = "bla";
    $content = array('chat_id' => $chat_id, 'text' => $reply);
    $telegram->sendMessage($content);
}
if ($text == "/git" || $text == "Git") {
    $reply = "Check me on GitHub: https://github.com/bla";
    $content = array('chat_id' => $chat_id, 'text' => $reply);
    $telegram->sendMessage($content);
}
?>