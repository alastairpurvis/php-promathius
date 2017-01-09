<?php
/*
  cip_manager.php
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com
  Copyright (c) 2002 osCommerce
  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Установка модулей');

define('TABLE_HEADING_FILENAME', 'Название');
define('TABLE_HEADING_SIZE', 'Размер');
define('TABLE_HEADING_ACTION', 'Действие');

define('TEXT_INFO_HEADING_UPLOAD', 'Загрузить');
define('TEXT_FILE_NAME', 'Имя файла:');
define('TEXT_FILE_SIZE', 'Размер:');
define('TEXT_DELETE_INTRO', 'Вы действительно хотите удалить данный файл?');

define('ERROR_DIRECTORY_NOT_WRITEABLE', 'Ошибка: Нет доступа на запись в данную директорию. Установите правильные права доступа на: %s');
define('ERROR_FILE_NOT_WRITEABLE', 'Ошибка: Нет доступа на запись в данный файл. Установите правильные права доступа на: %s');
define('ERROR_DIRECTORY_NOT_REMOVEABLE', 'Ошибка: Не могу удалить данную директорию. Установите правильные права доступа на: %s');
define('ERROR_FILE_NOT_REMOVEABLE', 'Ошибка: Не могу удалить данный файл. Установите правильные права доступа на: %s');
define('ERROR_DIRECTORY_DOES_NOT_EXIST', 'Ошибка: Директория не найдена: %s');
//======================
define('ICON_UNZIP', 'Разархивировать');
define('ICON_ZIP', 'Архивировать');
define('ICON_INSTALL', 'Установить');
define('ICON_REMOVE', 'Удалить модуль');
define('ICON_DELETE_MODULE', 'Удалить архив с модулем из магазина');
define('ICON_WITHOUT_DATA_REMOVING', 'сохранив изменения, произведённые модулем');
define('ICON_EMPTY', '');

define('ICON_INSTALLED_CURRENT_FOLDER', 'Текущая папка была установлена');

//Uploader:
define('ERROR_FILE_ALREADY_EXISTS','Файл %s  <b>уже существует</b>.');
define('TEXT_UPLOAD_INTRO', 'Выберите файл для загрузки.');
define('TEXT_UPLOAD_LIMITS','Вы можете загружать только <b>ZIP архивы</b>, не более <b>'.round(MAX_UPLOADED_FILESIZE/1024).'Kb</b> и только <b>архивы с модулями</b>!');

//========================================
define('TEXT_INFO_SUPPORT', 'Поддержка');
define('TEXT_INFO_CONTRIB', 'Информация о модуле');
define('CONTRIBS_PAGE_ALT','Официальная страница модуля');
define('CONTRIBS_PAGE','Официальная страница модуля');

define('CONTRIBS_FORUM_ALT','Форум поддержки данного модуля на официальном сайте магазина');
define('CONTRIBS_FORUM','Форум поддержки данного модуля на официальном сайте магазина');

define('CIP_STATUS_REMOVED_ALT', 'Модуль не был установлен');
define('CIP_STATUS_INSTALLED_ALT', 'Модуль установлен');

define('CIP_USES', 'CIP использует');
define('TEXT_DOESNT_EXISTS', ' не существует'




//MESSAGES:
define('MSG_WAS_INSTALLED','Модуль установлен!');
define('MSG_WAS_APPLIED',' был также установлен!');
define('MSG_WAS_REMOVED','Модуль удалён!');


//define('CIP_MANAGER_XML_NOT_FOUND',' не найден!');

define('TEXT_POST_INSTALL_NOTES','POST INSTALL NOTES');


?>