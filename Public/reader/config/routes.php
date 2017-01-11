<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['manga/(:any)'] = 'reader/manga/$1';
$route['manga/(:any)/(:any)'] = 'reader/read/$1/$2';
$route['bookmark/(:any)/(:any)'] = 'reader/bookmark/$1/$2';
$route['add-bookmark/(:any)/(:any)'] = 'reader/add_bookmark/$1/$2';
$route['update'] = 'reader/update';
