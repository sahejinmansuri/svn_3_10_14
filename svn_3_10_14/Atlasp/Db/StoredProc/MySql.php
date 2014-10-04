<?php
class Atlasp_Db_StoredProc_MySql 
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

        $num_in= count($inparam);
        $num_out= count($outparam);

        $out = implode(",", $outparam);

        $in = '';
        $i= $num_in;
        while ($i-- > 0) {
            $in.= '?';
            if ($i > 0) {
                $in.= ',';
            }
           
        }
  
        $outval = array();
        
        $callstr= "call $name($in".($num_out > 0 ? "," : "")."$out)";
        //echo "$callstr<br/>";

        $stmt = $db->prepare($callstr);

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
            throw new Atlasp_Exp_DbException(3001,"StoredProc $name Call Error", $e, 1, gethostname());
        }

        $t = Zend_Registry::get('times');
        $t['SYBSP'] = Atlasp_Utils::inst()->endTimer($b);
        Zend_Registry::set('times',$t);

        if ($spretval == 1) {
//            Zend_Registry::get('log')->debug($m."Setting return_value");
            $outval['return_value'] = $stmt->fetchAll();
//            Zend_Registry::get('log')->debug($m."return_value == ".$outval['return_value']);
        }

        $stmt->closeCursor();
 
        $outval['out_value'] = array(); 
        if ($num_out > 0) {
            $resStmt = $db->prepare("select $out");
            try {
                $resStmt->execute();    
            } catch(Exception $e) {
                // var_dump($e); exit;
                throw $e;
            }
            $outval['out_value'] = $resStmt->fetchAll();
            $resStmt->closeCursor();
        }

        return $outval;
    }    
}
