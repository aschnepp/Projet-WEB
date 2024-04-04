<?php
require("{$_SERVER["DOCUMENT_ROOT"]}/controller/Cookie.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $cookie = new Cookie();
  $cookie->removeCookie() ? $connexionAutho = 1 : $connexionAutho = 0;
} else {
  $connexionAutho = 0;
}

if ($connexionAutho == 1) {
  http_response_code(200);
} else {
  http_response_code(400);
}
