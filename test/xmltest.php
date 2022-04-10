<?php

$data = "<user type='admin'>\n\t<id>1</id>\n\t<name>allansm</name>\n</user>";

$user = new SimpleXmlElement($data);

print($user->attributes()["type"]."\n");
print($user->id."\n");
print($user->name."\n");

$xml = $user->asXML();

unset($data);
unset($user);

file_put_contents("user.xml", $xml);

$user = simplexml_load_file("user.xml");

unlink("user.xml");

print($user->asXML()."\n");

