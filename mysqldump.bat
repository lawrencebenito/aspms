@echo off

set location="C:\xampp\htdocs\aspms\database\"
echo Generating dump to %location%
echo.
cd C:\Program Files\MySQL\MySQL Server 5.7\bin

::mysqldump -u [username] –p[password] [database_name] > [dump_file.sql]
mysqldump -u root -p db_aspms > %location%db_aspms.sql