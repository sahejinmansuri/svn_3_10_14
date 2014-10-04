<?php

class App_Ws_Search extends Atlasp_Ws_Searchbase
{

    public function __construct($evt_data)
    {
        $cfg = Zend_Registry::get('config');

        $t = $evt_data['esp_data']['type'];
        $evt_data['esp_data']['ns'] = "http://webservices.seisint.com/$t";
        $evt_data['esp_data']['uname'] = $cfg->$t->esp->uname;
        $evt_data['esp_data']['passwd'] = $cfg->$t->esp->passwd;
        $evt_data['esp_data']['wsdl'] = $cfg->paths->wsdl . '/' . $t . '/' . $evt_data['esp_data']['wsdl'];
        $evt_data['esp_data']['vmap'] = $this->getVersionMap();
        $evt_data['esp_data']['endpoint'] = $cfg->$t->esp->endpoint;
        if (isset($evt_data['xsl']))
            $evt_data['xsl'] = $cfg->paths->xsl . '/' . $evt_data['xsl'];


        return $evt_data;
    }

    public function getResponse($request)
    {
        return parent::getResponse($request);
    }

    public function getResponseAttrs($root, $req)
    {
        $pstr = parent::getResponseAttrs($root, $req);
        return $rstr;
    }

    public function getVersionMap()
    {
        return array(
            '1' => '1.2',
            'default' => '1.2',
        );
    }

    public function _isAssoc($arr)
    {
        return array_keys($arr) != range(0, count($arr) - 1);
    }

    protected function _purgeEmptyValues($arr)
    {
        $res = array();
        foreach ($arr as $i => $row) {
            foreach ($row as $k => $v) {
                $v = trim($v);
                if (empty($v)) {
                    unset($row[$k]);
                }
            }

            $res[$i] = $row;
        }
        return $res;
    }

}
