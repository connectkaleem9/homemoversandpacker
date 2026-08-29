@echo off
REM ===========================================================================
REM  homemoverandpaker.com - local development server
REM
REM  Double-click this file to run the website on your own computer.
REM  It starts PHP, opens the site in your browser, and keeps running until
REM  you close this black window.
REM
REM  This file is for LOCAL USE ONLY. It is never used on the live hosting.
REM ===========================================================================

title Home Movers ^& Packers - Local Website Server

REM --- Work from the folder this file lives in --------------------------------
cd /d "%~dp0"

REM --- Find PHP ---------------------------------------------------------------
set "PHP_EXE=%USERPROFILE%\tools\php\php.exe"

if not exist "%PHP_EXE%" (
    REM Fall back to PHP on the system PATH, if there is one
    where php >nul 2>nul
    if errorlevel 1 (
        echo.
        echo  ============================================================
        echo   PHP was not found.
        echo.
        echo   Expected it here:
        echo   %PHP_EXE%
        echo.
        echo   Download PHP 8.3 for Windows ^(the "Non Thread Safe" x64 zip^)
        echo   from https://windows.php.net/download/ and unzip it to:
        echo   %USERPROFILE%\tools\php\
        echo  ============================================================
        echo.
        pause
        exit /b 1
    )
    set "PHP_EXE=php"
)

echo.
echo  ============================================================
echo   Starting the website...
echo.
echo   Address:  http://localhost:8000
echo.
echo   Keep this window OPEN while you use the site.
echo   To stop the server, close this window or press Ctrl+C.
echo  ============================================================
echo.

REM --- Open the browser a moment after the server comes up ---------------------
start "" /b cmd /c "timeout /t 2 /nobreak >nul & start http://localhost:8000"

REM --- Run the server (router.php mirrors the .htaccess clean URLs) ------------
"%PHP_EXE%" -S localhost:8000 router.php

echo.
echo  The server has stopped.
pause
