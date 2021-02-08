<?php
include('contact.php');
$contactobject = new Contact();
if(!contactobjectty($_POST['action']) && $_POST['action'] == 'listContact') {
	$contactobject->contactList();
}
if(!contactobjectty($_POST['action']) && $_POST['action'] == 'addContact') {
	$contactobject->addContact();
}
if(!contactobjectty($_POST['action']) && $_POST['action'] == 'getContact') {
	$contactobject->getContact();
}
if(!contactobjectty($_POST['action']) && $_POST['action'] == 'updateContact') {
	$contactobject->updateContact();
}
if(!contactobjectty($_POST['action']) && $_POST['action'] == 'contactDelete') {
	$contactobject->deleteContact();
}
?>