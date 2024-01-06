<?php
 namespace core;


 class ErrorHandler
{

    public function __construct()
    {   
        if (DEBUG) {
            error_reporting(-1);
        }else {
            error_reporting(0);
        }

        set_exception_handler([$this, 'exceptionHandler']);
        set_error_handler([$this, 'errorHandler']);
        ob_start(); // включаем буфиризацию для сохранения ошибки
        register_shutdown_function([$this, 'fatalErrorHandler']);
    }

    public function errorHandler($errno, $errstr, $errfile, $errline) 
    {
        $this->logError($errstr, $errfile, $errline);
        $this->dispalyError($errno, $errstr,  $errfile, $errline);
    }

    public function fatalErrorHandler() 
    {

        $error = error_get_last();
        if (!empty($error) AND $error['type'] & ( E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR))
        {
            //логируем ошибку
            $this->logError($error['message'], $error['file'], $error['line']);

            // выключаем буфер
            ob_end_clean();

            // показываем
            $this->dispalyError($error['type'], $error['message'], $error['file'], $error['line']);
        }
        else
        {
            // отключаем буфер
            ob_end_flush();
        }

    }




    //Метод отлавливает исключения логирует и выводит на экран
    public function exceptionHandler( \Throwable $error) 
    {
        $this->logError($error->getMessage(), $error->getFile(), $error->getLine());
        $this->dispalyError('Исключение', $error->getMessage(), $error->getFile(), $error->getLine(), $error->getCode());
    }


    //Логируем ошибку
    protected function logError($message = '', $file = '', $line = '')
    {
        file_put_contents
        (
            LOGS . '/errors.log', 
            "[" . date("Y-m-d H:i:s") . "] Текст ошибки: {$message} | Файл: {$file} | Строка: {$line}\n==============\n",
            FILE_APPEND
        );
    }

    //Показываем ошибку на экране
    protected function dispalyError($errno, $errstr, $errfile, $errline, $responce = 500) 
    {
        if($responce == 0) {
            $responce = 404;
        } 
        //оправляем код ответа в заголовках
        http_response_code($responce);

        if ($responce == 404 && !DEBUG) {
            require_once WWW . '/errors/404.php';
            die;
        }

        if (DEBUG) {
            require_once WWW . '/errors/dev.php';
        } else {
            require_once WWW . '/errors/prod.php';
        }
        die;
    }

}