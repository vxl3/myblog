<?php
error_reporting(0);
/*
ملف بوت صيد متاحات tiktok 🔥
اتصلات محدثه و جديده ساحبها الحين 👍🏼
ابن المتن*** يلي يخمط الملف و يغير الحقوق 🗿

الملف كتابتي @KHAFEER 💁🏼‍♂️
*/
if(!file_exists('admin.json')){
$token = readline('Enter Token : ');
$id = readline('Enter Id : ');
$save['info'] = [
'token'=>$token,
'id'=>$id
];
file_put_contents('admin.json',json_encode($save),64|128|256);
}
function save($array){
file_put_contents('admin.json',json_encode($array),64|128|256);
}
$token = json_decode(file_get_contents('admin.json'),true)['info']['token'];
$id = json_decode(file_get_contents('admin.json'),true)['info']['id'];
include 'index.php';
if($id == ""){
echo "Error Id";
}
try {
 $callback = function ($update, $bot) {
  global $id;
  if($update != null){
   if(isset($update->message)){
    $message = $update->message;
    $chat_id = $message->chat->id;   
    $name = $message->from->first_name;
    $message_id = $message->message_id;
    $text = $message->text;
$admin = json_decode(file_get_contents('admin.json'),true);
if($text == '/start' && $chat_id == $admin['info']['id']){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"*
~ اهلا بك في اداة صيد متاحات tiktok ♨️

• يمكنك صيد متاحات tiktok بكل سهوله ✅

- استخدم الازرار بلأسفل للتحكم 👍🏼
*",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"بدء الصيد ☠️",'callback_data'=>'start'],['text'=>"إيقاف الصيد ⛔",'callback_data'=>'stop']],
[['text'=>"حذف الكوكيز 🗑️",'callback_data'=>'delcookies']],
[['text'=>"حالة الاداه ⁉️",'callback_data'=>'status']],
]
])
]);
}
}
if(isset($update->callback_query)) {
    $chat_id1 = $update->callback_query->message->chat->id;
    $mid = $update->callback_query->message->message_id;
    $data = $update->callback_query->data;
    $message = $update->message;
    $chat_id = $message->chat->id;
    $text = $message->text;
    $name = $message->from->first_name;
if($data == 'start'){
bot('editMessageText',[
'chat_id'=>$chat_id1,
'message_id'=>$mid,
'text'=>"
• اختر عدد الاحرف 🔢
",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'4','callback_data'=>'count#4'],['text'=>'5','callback_data'=>'count#5']],
[['text'=>'6','callback_data'=>'count#6'],['text'=>'7','callback_data'=>'count#7']],
[['text'=>'رجوع 🔙','callback_data'=>'back']],
]
])
]);
}
/*
ملف بوت صيد متاحات tiktok 🔥
اتصلات محدثه و جديده ساحبها الحين 👍🏼
ابن المتن*** يلي يخمط الملف و يغير الحقوق 🗿

الملف كتابتي @KHAFEER 💁🏼‍♂️
*/
$exp = explode('#',$data);
if($exp[0] == 'count'){
bot('editMessageText',[
'chat_id'=>$chat_id1,
'message_id'=>$mid,
'text'=>"
- اختر نوع الدومين 🌐
",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"@yahoo.com",'callback_data'=>'domain#@yahoo.com'],['text'=>'@hotmail.com','callback_data'=>'domain#@hotmail.com']],
[['text'=>"@outlook.com",'callback_data'=>'domain#@outlook.com'],['text'=>'@outlook.sa','callback_data'=>'domain#@outlook.sa']],
[['text'=>'@gmail.com','callback_data'=>'domain#@gmail.com'],['text'=>"@mail.ru",'callback_data'=>'domain#@mail.ru']],
[['text'=>"رجوع 🔙",'callback_data'=>'back']],
]
])
]);
file_put_contents('count',$exp[1]);
}
$expa = explode('#',$data);
if($expa[0] == 'domain'){
$counttt = file_get_contents('count');
bot('editMessageText',[
'chat_id'=>$chat_id1,
'message_id'=>$mid,
'text'=>"
~ لقد اخترت العدد : {$counttt} ⚠️

- لقد اخترت الدومين : {$expa[1]} 🌐

• هل تريد بدء الفحص ام الرجوع 🤔
",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'بدء 🔥','callback_data'=>'starts'],['text'=>'رجوع 🔙','callback_data'=>'back']],
]
])
]);
file_put_contents('domain',$expa[1]);
}
if($data == 'back'){
bot('editMessageText',[
'chat_id'=>$chat_id1,
'message_id'=>$mid,
'text'=>"*
~ اهلا بك في اداة صيد متاحات tiktok ♨️

• يمكنك صيد متاحات tiktok بكل سهوله ✅

- استخدم الازرار بلأسفل للتحكم 👍🏼
*",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"بدء الصيد ☠️",'callback_data'=>'start'],['text'=>"إيقاف الصيد ⛔",'callback_data'=>'stop']],
[['text'=>"حذف الكوكيز 🗑️",'callback_data'=>'delcookies']],
[['text'=>"حالة الاداه ⁉️",'callback_data'=>'status']],
]
])
]);
unlink('count');
unlink('domain');
}
if($data == 'starts'){
$screens = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),1,4);
bot('editMessageText',[
'chat_id'=>$chat_id1,
'message_id'=>$mid,
'text'=>"
~ تم بدء الفحص اسم الجلسه : $screens 🔥
",
]);
system('screen -dmS n'.$screens.' php check.php');
file_put_contents('screens',$screens."\n",FILE_APPEND);
}
/*
ملف بوت صيد متاحات tiktok 🔥
اتصلات محدثه و جديده ساحبها الحين 👍🏼
ابن المتن*** يلي يخمط الملف و يغير الحقوق 🗿

الملف كتابتي @KHAFEER 💁🏼‍♂️
*/
if($data == 'delcookies'){
if(file_exists('Info')){
bot('editMessageText',[
'chat_id'=>$chat_id1,
'message_id'=>$mid,
'text'=>"
- تم حذف جميع الكوكيز ✅
",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'رجوع 🔙','callback_data'=>'back']],
]
])
]);
delTree('Info');
} else {
bot('answerCallbackQuery', [
    'callback_query_id' => $update->callback_query->id,
    'text' =>"لا يوجد كوكيز ⁉️",
    'show_alert' => true,
  ]);
}
}
if($data == 'stop'){
$ex = explode("\n",file_get_contents('screens'));
for($i=0;$i<count($ex);$i++){
$keyboard['inline_keyboard'][] = [['text'=>$ex[$i],'callback_data'=>'kill#'.$ex[$i]]];
}
$keyboard['inline_keyboard'][] = [['text'=>'رجوع 🔙','callback_data'=>'back']];
$keys = json_encode($keyboard);
bot('editMessageText',[
'chat_id'=>$chat_id1,
'message_id'=>$mid,
'text'=>"
• اختر الجلسه لإيقافها 👇🏾
",
'reply_markup'=>$keys,
]);
}
$exxp = explode('#',$data);
if($exxp[0] == 'kill'){
$slpq = str_replace($exxp[1],'',file_get_contents('screens'));
file_put_contents('screens',$slpq);
system('screen -S n'.$exxp[1].' -X kill');
bot('editMessageText',[
'chat_id'=>$chat_id1,
'message_id'=>$mid,
'text'=>"
- تم إيقاف الجلسه : *{$exxp[1]}* بنجاح ✅
",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"رجوع 🔙",'callback_data'=>'back']],
]
])
]);
}
if($data == 'status'){
$scrns = file_get_contents('screens');
if(empty($scrns) or $scrns == null or $scrns == "\n"){
$stats = 'واقفه';
$scrn = 0;
} else {
$stats = 'شغاله';
$plat = explode("\n",file_get_contents('screens'));
$scrn = count($plat)-1;
}
bot('editMessageText',[
'chat_id'=>$chat_id1,
'message_id'=>$mid,
'text'=>"
• حالة الاداه : *$stats* 🎭
• عدد الجلسات : *$scrn* ♨️
",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"رجوع 🔙",'callback_data'=>'bacck']],
]
])
]);
} if($data == 'bacck'){
bot('editMessageText',[
'chat_id'=>$chat_id1,
'message_id'=>$mid,
'text'=>"*
~ اهلا بك في اداة صيد متاحات tiktok ♨️

• يمكنك صيد متاحات tiktok بكل سهوله ✅

- استخدم الازرار بلأسفل للتحكم 👍🏼
*",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"بدء الصيد ☠️",'callback_data'=>'start'],['text'=>"إيقاف الصيد ⛔",'callback_data'=>'stop']],
[['text'=>"حذف الكوكيز 🗑️",'callback_data'=>'delcookies']],
[['text'=>"حالة الاداه ⁉️",'callback_data'=>'status']],
]
])
]);
}
/*
ملف بوت صيد متاحات tiktok 🔥
اتصلات محدثه و جديده ساحبها الحين 👍🏼
ابن المتن*** يلي يخمط الملف و يغير الحقوق 🗿

الملف كتابتي @KHAFEER 💁🏼‍♂️
*/
#----------------------------#
}
      }
    };
         $bot = new EzTG(array('throw_telegram_errors'=>true,'token' => $token, 'callback' => $callback));
  }
    catch(Exception $e){
 echo $e->getMessage().PHP_EOL;
 sleep(1);
}