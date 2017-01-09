<?php
/*
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com
  Copyright (c) 2003 osCommerce
  Contrib Installer (c) 2005 Rinon
  Released under the GNU General Public License
*/

//2.2 b
define('INSTALL_CONTRIB_INSTALLER','Установить');
define('INTRO','<br>Выберите папку и нажмите кнопку. Инсталлятор сам себя установит.
<br><b>Совет CIP.NET.UA:</b><br>
Во время установки Инсталлятора создаётся резервная копия всех файлов и базы данных.
<br>
Если вы хотите восстановить ваш магазин, то вам нужно удалить Инсталлятор и все файлы и база данных будет воссстановлена.<br>
Вы получите магазин без всех изменений, которые были сделаны после установки Инсталлятора.');


//2.2 e


define('CONTRIB_INSTALLER_NAME','Установка модулей');
define('CONFIG_FILENAME','install.xml');
define('INIT_CONTRIB_INSTALLER', 'contrib_installer.php');

define('INIT_CONTRIB_INSTALLER_TEXT', 'Установка модулей');
define('CONTRIB_INSTALLER_TEXT', 'Установка модулей');

//=========================
define('ALL_CHANGES_WILL_BE_REMOVED_TEXT', 'Все сделанные изменения были удалены.');
//=========================
define('AUTHOR_TEXT', 'Автор: ');
define('FROM_INSTALL_FILE_TEXT', 'Установочный файл: ');
//=========================
define('INSTALLING_CONTRIBUTION_TEXT', 'Устанавливаем модуль: ');
define('REMOVING_CONTRIBUTION_TEXT', 'Удаляем модуль: ');
//=========================
define('CANT_CREATE_DIR_TEXT', 'Не могу создать директорию: ');
define('CANT_WRITE_TO_DIR_TEXT', 'Не могу записать в файл: ');
define('COLUDNT_REMOVE_DIR_TEXT', 'Не могу удалить директорию: ');
//=========================
define('REMOVING_DIRS_IN_BOLD', 'Удаляем директорию: ');
define('CREATING_DIRS_IN_BOLD', 'Создаём директорию: ');
//=========================
define('WRITE_PERMISSINS_NEEDED_TEXT', 'Необходимы права доступа на запись для: ');
define('ADD_CODE_IN_FILE_TEXT', 'Новый код в файле: ');
define('EXPRESSION_TEXT', 'Код: ');
define('AFTER_EXPRESSION_ADD_TEXT', 'Оригинальный код: ');
define('ORIGINAL_AFTER_EXPRESSION_ADD_TEXT', 'Новый код после оригинала: ');
define('UNDO_ADD_CODE_IN_FILE_TEXT', 'Отменить добавление кода в файл: ');
define('ORIGINAL_EXPRESSION_TEXT', 'Оригинальный код: ');
define('ORIGINAL_REPLACE_WITH_TEXT', 'Замена на: ');
//=========================
define('CONFLICT_IN_FILE_TEXT', 'Конфликт в файле: ');
define('CANT_READ_FILE', 'Файл отсутствует: ');
define('REMOVING_FILE_TEXT', 'Удаляем файл: ');
define('COULDNT_REMOVE_FILE_TEXT', 'Не могу удалить файл: ');
define('COULDNT_COPY_TO_TEXT', 'Не могу скопировать файл: ');

//=========================
define('COULDNT_FIND_TEXT', 'Не могу найти ');
//define('CANT_OPEN_FOR_WRITING_TEXT', 'Не могу открыть файл для записи: ');
//=========================
define('CONTRIBUTION_DIR_TEXT', 'Директория с модулями: ');
define('NO_CONTRIBUTION_NAME_TEXT', 'Не указано название модуля.');
//=========================
define('NO_FILE_TAG_IN_ADDFILE_SECTION_TEXT', 'Нет тэга file.');
define('NAME_OF_FILE_MISSING_IN_ADDFILE_SECTION_TEXT', 'Название отсутствующего файла.');

define('NO_QUERY_TAG_IN_SQL_SECTION_TEXT', 'Нет тэга query.');
define('NO_REMOVE_QUERY_NESSESARY_FOR_SQL_QUERY_TEXT', 'Нет необходимого запроса на удаление для SQL запроса: ');
define('RUN_SQL_REMOVE_QUERY_TEXT', 'Выполнить SQL запрос на удаление: ');
define('RUN_SQL_QUERY_TEXT', 'Выполнить SQL запрос: ');

//=========================
define('NO_DIR_TAG_IN_MAKE_DIR_SECTION_TEXT', 'Нет тэга dir.');
define('NAME_OF_DIR_MISSING_IN_MAKE_DIR_SECTION_TEXT', 'Название отсутствующей директории.');
define('NAME_OF_PARENT_DIR_MISSING_IN_MAKE_DIR_SECTION_TEXT', 'Значение для parent_dir отсутствует.');

define('ERROR_IN_ADDCODE_SECTION_TEXT', 'Ошибка в <addcode>');
define('COPYING_TO_TEXT', 'Копируем в: ');
define('FIND_REPLACE_IN_FILE_TEXT', 'Поиск и замена в файле: ');
define('ERROR_IN_FINDREPLACE_SECTION_TEXT', 'Ошибка в <findreplace>');
define('UNDO_FIND_REPLACE_IN_FILE_TEXT', 'Отменить поиск и замену в файле: ');

define('REPLACE_WITH_TEXT', 'Заменить: ');
define('ON_LINE_TEXT', 'в строке ');
//=========================
define('UPDATE_BUTTON_TEXT', 'Обновить');
define('IN_THE_FILE_TEXT', 'в файле: ');

define('INSTALL_XML_FILE_IS_VALID_TEXT', 'Файл install.xml без ошибок.');
define('PERMISSIONS_IS_VALID_TEXT', 'Права доступа правильные.');

define('INSTALLATION_COMPLETE_TEXT', 'Установлен.');
define('REMOVING_COMPLETE_TEXT', 'Удалён.');


// Subheaders
define('COMMENTS_TEXT', 'Комментарии: ');
define('CHECKING_CONFIG_FILE_TEXT', 'Проверяем файл настроек: ');
define('CHECKING_PERMISSIONS_TEXT', 'Проверяем права доступа: ');
define('CHECKING_CONFLICTS_TEXT', 'Проверяем конфликты:');

//define('RUNNING_TEXT', 'Выполняем: ');
define('RUNNING_TEXT', 'Лог установки модулей: ');//1.0.4

define('STATUS_TEXT', 'Статус: ');

define('NO_CONFLICTS_TEXT', 'Нет конфликтов.');
define('PHP_INSTALL_TEXT', 'Устанавливаемый PHP код: ');
define('PHP_REMOVE_TEXT', 'Удаляемый PHP код: ');

define('PHP_RUNTIME_MESSAGES_TEXT', 'Сообщения PHP: ');

define('NO_INSTALL_TAG_IN_PHP_SECTION_TEXT', 'Нет тэга INSTALL.');
define('NO_REMOVE_TAG_IN_PHP_SECTION_TEXT', 'Нет тэга REMOVE.');


define('FILE_EXISTS_TEXT', 'Файл существует');
define('FILE_NOT_EXISTS_TEXT', 'Файл не найден');

define('LINK_EXISTS_TEXT', 'Ссылка существует.');



define('NAME_OF_FILE_MISSING_IN_DEL_FILE_SECTION_TEXT', 'Название отсутствующего файла.');
define('MD5_SUM_UPDATED_TEXT', 'MD5 сумма обновлена.');
define('MD5_SUM_REMOVED_TEXT', 'MD5 сумма удалена.');

define('FILE_EXISTS_AND_WAS_CHANGED_TEXT', 'Файл уже был изменён другим модулем. Вы должны: <br>
- сделать резервную копию файла,<br>
- вернуть оригинальный файл, без изменений,<br>
- установить модуль,<br>
- найти все изменения в файле в сравнении с оригиналом (отмечены комментариями),<br>
- перенести изменения из оригинального файла в файл, изменённый установщиком,<br>
- тестировать. <br>');
define('ERROR_COULD_NOT_OPEN_XML', 'Не могу открыть XML в: ');
define('ERROR_XML', 'Ошибка XML: ');
define('TEXT_AT_LINE', ' в строке ');

//1.0.6:
define('TEXT_NOT_ORIGINAL_TEXT', 'Не оригинальный текст find разделе. ');
define('TEXT_HAVE_BEEN_FOUND', 'был найден ');
define('TEXT_TIMES', ' раз!');

define('TEXT_HOW_TO_RESOVLE_CONFLICTS', '
This error message means that CIP (Contrib Installer Package) that you are installing tryes to change lines in file that was changed by another CIP before.<br>
If file was changed by hand you will see a message that says "Can\'t find...".<br>
<br>
<b>What to do?</b><br>
<br>
1.Open file from osCommerce and find lines that installed CIP tryes to change. <br>
You can see a comments above and below this lines.<br>
In comments you can find information about CIP that added/changes this lines.<br>
2. If CIP that make changes before don\'t really needed - remove them and install your CIP.<br>
If needed - read #3.<br>
<br>
3. Make a copy of CIP that you want to install.<br>
4. Change install.xml from copy of CIP.<br>
Use file from osCommerce that must be changed for that.<br>
<br>
May be you will find useful to compare 2 files <br>
use <i>diff /.../one_file.php /.../other_file.php -bu > 1.txt</i><br>
where<br>
other_file.php - file from osCommerce that have a conflict<br>
one_file.php - file from clear osCommerce or just remove CIP that changed lines that your CIP tryes change too.<br>
5. Try to install your new CIP.<br>
6. If all works. Add your name in install.xml an section "credits" and upload on oscommerce site :-)<br>
<br>
or<br>
<br>
ask a help on Contrib Installer forum.<br>');


//1.0.10


define('NO_COMMENTS_TAG_IN_DESCRIPTION_SECTION_TEXT', 'Нет тэга comments в разделе описания');
define('NO_CREDITS_TAG_IN_DESCRIPTION_SECTION_TEXT', 'Нет тэга credits в разделе описания');

define('NO_DETAILS_TAG_IN_DESCRIPTION_SECTION_TEXT', 'Нет тэга details в разделе описания');

define('NO_CONTRIB_REF_PARAMETER_IN_DETAILS_TAG_TEXT', 'Нет параметра contrib_ref в тэге details');
define('NO_FORUM_REF_PARAMETER_IN_DETAILS_TAG_TEXT', 'Нет параметра forum_ref в тэге details');
define('NO_CONTRIB_TYPE_PARAMETER_IN_DETAILS_TAG_TEXT', 'Нет параметра contrib_type в тэге details');
define('NO_STATUS_PARAMETER_IN_DETAILS_TAG_TEXT', 'Нет параметра status в тэге details');
define('NO_LAST_UPDATE_PARAMETER_IN_DETAILS_TAG_TEXT', 'Нет параметра last_update в тэге details');


//1.0.13
define('CHOOSE_A_CONTRIBUTION_TEXT', '
<a href="http://www.oscommerce.com/community?contributions=&search=Contrib+Installer&category=all" target=_blank">Искать модули на сайте osCommerce</a> или выберите модуль: ');


//1.0.14
define('IMAGE_BUTTON_INSTALL', 'Установить');
define('IMAGE_BUTTON_REMOVE', 'Удалить');

/*
define('

', '

');
define('

', '

');

*/
?>