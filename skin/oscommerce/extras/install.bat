@setlocal 

@echo off
REM This runs the install script
echo Running the installer

set target_dir=%1
REM set installer=python tools\installer.py
set installer=tools\windows\dist\installer.exe

if defined target_dir (
  %installer% --diff3=tools\windows\diffutils\bin\diff3.exe --zip_backup catalog\ tools\golden\oscommerce-2.2rc2a\catalog\ %target_dir%\
) else (
  %installer% --ui --diff3=tools\windows\diffutils\bin\diff3.exe --zip_backup
)
@endlocal

