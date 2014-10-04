<?php

/**
 * Atlasp_ErrorController
 *
 */
class Atlasp_ErrorController extends Atlasp_ControllerAction
{
    /**
     * Max length for the subject line
     */
    const EMAIL_SUBJECT_LENGTH_MAX = 75;

    /**
     * List of Exception messages that do not generate email notification
     *
     * @var array
     */
    private $_ignoreNotifyExceptions = array();

    /**
     * Adds Exception message to the list of Exception that do not require
     * e-mail notification
     * @param string|Exception $errorMessage
     */
    public function addIgnoreExceptionNotification($errorMessage)
    {
        if (is_string($errorMessage)) {
            $this->_addIgnoreNotifyException($errorMessage);
        } else
        //  Check if parameter is instance of Exception
        if ($errorMessage instanceof Exception) {
            /* @var $errorMessage Exception */
            $this->_addIgnoreNotifyException($errorMessage->getMessage());
        } else {
            throw new Zend_Exception('Unsupported Type');
        }
    }

    /**
     * Checks to see if error message is in the ignore list
     * 
     * @param string|Exception $errorMessage
     * @return bool true if message is in ignore list
     */
    public function isIgnoredException($errorMessage)
    {
        if (is_string($errorMessage)) {
            return $this->_isIgnoredException($errorMessage);
        } else if ($errorMessage instanceof Exception) {
            /* @var $errorMessage Exception */
            return $this->_isIgnoredException($errorMessage->getMessage());
        } else {
            throw new Zend_Exception('Unsupported Type');
        }
    }

    /**
     * Default index action
     * 
     * @return void
     */
    public function indexAction()
    {
        //
        $errors = $this->_getParam('error_handler');
        /* @var $errors ArrayObject */

        //
        if (!$errors) {
            $this->view->message = 'An error occured';
            return;
        }

        //  Get the last Error
        $lastError = $errors->getIterator()->current();
        /* @var $lastError Exception */

        //
        switch ($errors->type) {
            //
            //  Check for path related problems
            //
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
                // 404 error -- controller or action not found
                $this->getResponse()->setHttpResponseCode(404);
                $this->view->message = 'Page not found';
                break;

            default:
                //
                //  All other errors
                //
                // set application error
                $this->getResponse()->setHttpResponseCode(500);

                //  Handle Error depending on the error code
                switch ($lastError->getCode()) {

                    //  Exception with code = 0 is considered to be a default
                    //  exception code it is below without break so it falls
                    //  into default condition
                    case 0:
                    default:
                        /* @var $lastError Zend_Exception */
                        $this->view->message = $lastError->getMessage();
                        $this->view->exception = $lastError;
                }
        }

        //  Send Notification
        if ($lastError) {
            $this->_notify($lastError->getMessage(), $lastError);
        }
    }

    /**
     * Sends a notification message to people specified in the cnf file
     *
     * @param string $subject
     * @param Exception $ex
     */
    protected function _notify($subject, Exception $ex)
    {
        if ($this->isIgnoredException($ex)) {
            return;
        }

        //  Get Configurations
        $cfg = Zend_Registry::get('config');
        $name = Zend_Registry::get('name');
        preg_match('/^(.*?)\./', php_uname('n'), $host);

        if (strlen($subject) > self::EMAIL_SUBJECT_LENGTH_MAX) {
            $subject = substr($subject, 0, (self::EMAIL_SUBJECT_LENGTH_MAX - 1)) . '...';
        }

        //  Create Subject and Email Body
        $subject = "$name : {$cfg->app->env} : {$host[1]} : $subject";
        $body = $this->_convertExceptionToString($ex);

        //  Initialize E-Mail Message
        $mail = new Zend_Mail();
        $mail->setFrom($cfg->errfrom, $name);
        $mail->addTo($cfg->errto, 'Excp_Handlers');
        $mail->setSubject($subject);
        $mail->setBodyText($body);
        //  Send Message
        $mail->send();
    }

    /**
     * Adds Exception message to the list of Exception that do not require
     * e-mail notification
     *
     * @param string $errorMessage
     */
    private function _addIgnoreNotifyException($errorMessage)
    {
        if (!$this->isIgnoredException($errorMessage)) {
            $key = md5($errorMessage);
            $this->_ignoreNotifyExceptions[$key] = $errorMessage;
        }
    }

    /**
     * Checks to see if error message is in the ignore list
     *
     * @param string $errorMessage
     * @return bool true if message is in ignore list
     */
    private function _isIgnoredException($errorMessage)
    {
        $key = md5($errorMessage);
        return isset($this->_ignoreNotifyExceptions[$key]);
    }

    /**
     * Converts Exception object into a string
     * 
     * @param Exception $ex
     * @return string
     */
    protected function _convertExceptionToString(Exception $ex)
    {
        $exceptionInfo = array();

        //  Message
        $exceptionInfo[] = "Message: {$ex->getMessage()}";
        if ($ex->getCode()) {
            $exceptionInfo[] = "Code: {$ex->getCode()}";
        }

        //  Error Summary
        $exceptionInfo[] = PHP_EOL;
        $exceptionInfo[] = 'Exception Summary:';
        $exceptionInfo[] = $ex->__toString();

        //
        return implode(PHP_EOL, $exceptionInfo);
    }

}