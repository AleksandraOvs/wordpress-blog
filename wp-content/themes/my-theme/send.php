<?php 
require_once( dirname(__FILE__) . '/../../../wp-load.php');

//проверка, если какое-то поле пустое:
if ( empty($_POST['name']) || empty($_POST['mail']) || empty($_POST['message']) ) {
    wp_redirect( add_query_arg( 'status', 'error', site_url('contacts') ) );
    exit;
}


//$to = 'me@gmail.com';
$to = get_option('admin_email'); //указывает на адрес, указанный в админке сайта
$subject = 'Кто-то отправил форму';

if( !empty ( $_POST ['subject']) && $_POST ['subject']){
    $subject = $_POST['subject'];
}

$message = $_POST['message'];
$name = $_POST['name'];
$email = $_POST['mail'];

$headers = array(
    "From: $name <no-reply@siteurl.com>", //тут нужна доменная почта
    "Reply-To: $name <$email>"
);
if (wp_mail($to, $subject, $message, $headers )){
    wp_redirect( add_query_arg( 'status', 'success', site_url('contacts') ) );
    exit;
};

wp_redirect( add_query_arg( 'status', 'error-2', site_url('contacts') ) );
    exit;