<?php
error_reporting(0);
/*
ملف بوت صيد متاحات tiktok 🔥
اتصلات محدثه و جديده ساحبها الحين 👍🏼
ابن المتن*** يلي يخمط الملف و يغير الحقوق 🗿

الملف كتابتي @KHAFEER 💁🏼‍♂️
*/
$token = json_decode(file_get_contents('admin.json'),true)['info']['token'];
$id = json_decode(file_get_contents('admin.json'),true)['info']['id'];
include 'index.php';
$admin = json_decode(file_get_contents('admin.json'),true);
$checked = 0;
$hit = 0;
$bad = 0;
$error = 0;
$count = file_get_contents('count');
$domain = file_get_contents('domain');
$edit = bot('sendMessage',[
'chat_id'=>$id,
'text'=>"
- بدء الفحص روح دورلك شغله تسليك 😴
- عدد الاحرف : $count
- الدومين : $domain
",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"~ Checked : $checked 🔎",'callback_data'=>'i']],
[['text'=>"~ In : $email 📨",'callback_data'=>'i3']],
[['text'=>"~ Hit : $hit ✅",'callback_data'=>'i1']],
[['text'=>"~ Bad : $bad ⛔",'callback_data'=>'i2']],
[['text'=>"~ Error : $error 🗿",'callback_data'=>'i4']],
]
])
]);
$count = file_get_contents('count');
$domain = file_get_contents('domain');
while(true){
$email = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz0123456789'),1,$count).$domain;
if(strpos($email,'@yahoo.com')){
$tiktok = tiktok($email);
$chk_mail = yahoo($email);
} elseif(strpos($email,'@hotmail.com')){
$tiktok = tiktok($email);
$chk_mail = hotmail($email);
} elseif(strpos($email,'@outlook.com')){
$tiktok = tiktok($email);
$chk_mail = hotmail($email);
} elseif(strpos($email,'@outlook.sa')){
$tiktok = tiktok($email);
$chk_mail = hotmail($email);
} elseif(strpos($email,'@gmail.com')){
$tiktok = tiktok($email);
$chk_mail = gmail($email);
} elseif(strpos($email,'@mail.ru')){
$tiktok = tiktok($email);
$chk_mail = mailru($email);
}
if($chk_mail == 'true' && $tiktok == 'true'){
$hit += 1;
$checked += 1;
bot('editMessageReplyMarkup',[
'chat_id'=>$id,
'message_id'=>$edit->result->message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"~ Checked : $checked 🔎",'callback_data'=>'i']],
[['text'=>"~ In : $email 📨",'callback_data'=>'i3']],
[['text'=>"~ Hit : $hit ✅",'callback_data'=>'i1']],
[['text'=>"~ Bad : $bad ⛔",'callback_data'=>'i2']],
[['text'=>"~ Error : $error 🗿",'callback_data'=>'i4']],
]
])
]);
/*
ملف بوت صيد متاحات tiktok 🔥
اتصلات محدثه و جديده ساحبها الحين 👍🏼
ابن المتن*** يلي يخمط الملف و يغير الحقوق 🗿

الملف كتابتي @KHAFEER 💁🏼‍♂️
*/
bot('sendMessage',[
'chat_id'=>$id,
'text'=>"
Hi Sir i Fucked New Account ✅.
-------------------------
.❖. Email : $email
-------------------------
- By : < @KHAFEER - @C_Y_L >
",
]);
} elseif($chk_mail == 'false' && $tiktok == 'true'){
$bad += 1;
$checked += 1;
bot('editMessageReplyMarkup',[
'chat_id'=>$id,
'message_id'=>$edit->result->message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"~ Checked : $checked 🔎",'callback_data'=>'i']],
[['text'=>"~ In : $email 📨",'callback_data'=>'i3']],
[['text'=>"~ Hit : $hit ✅",'callback_data'=>'i1']],
[['text'=>"~ Bad : $bad ⛔",'callback_data'=>'i2']],
[['text'=>"~ Error : $error 🗿",'callback_data'=>'i4']],
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
elseif($chk_mail == 'true' && $tiktok == 'false'){
$bad += 1;
$checked += 1;
bot('editMessageReplyMarkup',[
'chat_id'=>$id,
'message_id'=>$edit->result->message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"~ Checked : $checked 🔎",'callback_data'=>'i']],
[['text'=>"~ In : $email 📨",'callback_data'=>'i3']],
[['text'=>"~ Hit : $hit ✅",'callback_data'=>'i1']],
[['text'=>"~ Bad : $bad ⛔",'callback_data'=>'i2']],
[['text'=>"~ Error : $error 🗿",'callback_data'=>'i4']],
]
])
]);
}
elseif($chk_mail == 'false' && $tiktok == 'false'){
$bad += 1;
$checked += 1;
bot('editMessageReplyMarkup',[
'chat_id'=>$id,
'message_id'=>$edit->result->message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"~ Checked : $checked 🔎",'callback_data'=>'i']],
[['text'=>"~ In : $email 📨",'callback_data'=>'i3']],
[['text'=>"~ Hit : $hit ✅",'callback_data'=>'i1']],
[['text'=>"~ Bad : $bad ⛔",'callback_data'=>'i2']],
[['text'=>"~ Error : $error 🗿",'callback_data'=>'i4']],
]
])
]);
} else {
$error += 1;
$checked += 1;
bot('editMessageReplyMarkup',[
'chat_id'=>$id,
'message_id'=>$edit->result->message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"~ Checked : $checked 🔎",'callback_data'=>'i']],
[['text'=>"~ In : $email 📨",'callback_data'=>'i3']],
[['text'=>"~ Hit : $hit ✅",'callback_data'=>'i1']],
[['text'=>"~ Bad : $bad ⛔",'callback_data'=>'i2']],
[['text'=>"~ Error : $error 🗿",'callback_data'=>'i4']],
]
])
]);
}
}
/*
ملف بوت صيد متاحات tiktok 🔥
اتصلات محدثه و جديده ساحبها الحين 👍🏼
ابن المتن*** يلي يخمط الملف و يغير الحقوق 🗿

الملف كتابتي @KHAFEER 💁🏼‍♂️
*/
?>