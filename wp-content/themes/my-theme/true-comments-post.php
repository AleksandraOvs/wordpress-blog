<?php
if (!empty( $_POST ['comment'])){
    exit;
}

$_POST['comment'] = $_POST['real'];

require (dirname (__FILE__) . '/../../../wp-comments-post.php');