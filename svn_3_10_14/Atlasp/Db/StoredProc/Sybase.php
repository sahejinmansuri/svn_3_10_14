<?php
class Atlasp_Db_StoredProc_Sybase
{
    static private $_instance;

    private function construct() {}
    private function  __clone()  {}

    public static function getInstance()
    {
        if (!isset(self::$_instance)) {
            $c = __CLASS__;
            self::$_instance = new $c;
        }

        return self::$_instance;
    }

    public function call($dbstr, $name, $inparam, $outparam, $spretval)
    {
        $db = Zend_Registry::get($dbstr);
        $sql = '';
        $displayEndStatment = false;
        $outvars = array();
        $outparams = '';

        if (is_array($outparam)) {
            $sql = 'begin'; 

            foreach ($outparam as $param => $declareType) {
                $sql .= ' declare ' . $param . ' ' . $declareType;
                $outvars[] = $param . ' out';            
            }

            $sql .= ' ';
            $outparams = implode(",", $outvars);
            $displayEndStatment = true;
        }

        $in = str_repeat('?,', count($inparam) );

        if (strlen($outparams) > 0) {
            $sql .= "exec {$name} {$in}{$outparams}";
        } else {
            $sql .= "exec {$name} {$in}";
        }

        if ($displayEndStatment) {
            $sql .= ' end';
        }

        $lastCharIndex = (strlen($sql) - 1);
 
        if ($sql[$lastCharIndex] == ',') {
            $sql = substr($sql, 0, -1);
        }

        $outval = array();
        $stmt = $db->prepare($sql);
        $size = count($inparam);

        for ($i = 0; $i < $size; $i++) {
            $stmt->bindParam(($i + 1), $inparam[$i]);    
        }

        $b = Atlasp_Utils::inst()->startTimer();

        try {
            $stmt->execute();
        } catch (Exception $e) {
            //var_dump($e); exit;
            $t = Zend_Registry::get('times');
            $t['SYBSP'] = Atlasp_Utils::inst()->endTimer($b);
            Zend_Registry::set('times',$t);
            throw new Atlasp_Exp_DbException(3001,"Stored Proc $name Call Error", $e, 1, gethostname());
        }

        $t = Zend_Registry::get('times');
        $t['SYBSP'] = Atlasp_Utils::inst()->endTimer($b);
        Zend_Registry::set('times',$t);

        if ($spretval == 1) {
            $outval['return_value'] = $stmt->fetchAll();
        }

        $stmt->closeCursor();

        $outval['out_value'] = '';
        if (strlen($outparam) > 0) {
            $resStmt = $db->prepare("select $outparam");
            try {
                $resStmt->execute();    
            } catch(Exception $e) {
                //var_dump($e); exit;
                throw $e;
            }  
            $outval['out_value'] = $resStmt->fetchAll();
            $resStmt->closeCursor();
        }

        return $outval;
    }    
}
