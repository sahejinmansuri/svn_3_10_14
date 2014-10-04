<?php

abstract class Atlasp_Ws_Searchbase extends Atlasp_Ws_Abstract
{
    abstract public function getEvtData();

    public function getResponse($req)
    {
        $reqParams = (is_object($req)) ? $req->getParams() : $req;
        $sidef = $this->getEvtData();
        $soapInputs = $this->_makeSoapInput($sidef['soap_input'], $reqParams);
        $soapInputs = $this->_addSoapInputs($reqParams, $soapInputs);
        
        error_log("the ep is " . $sidef['esp_data']['endpoint']);
        if (isset($sidef['esp_data']['endpoint'])) {
            $sidef['esp_data']['endpoint'] = $this->_setEndpoint($reqParams, $sidef);
        }
        error_log("the ep is " . $sidef['esp_data']['endpoint']);
        if (isset($sidef['wstype'])) {
            $wsclass = 'Atlasp_Ws_' . $sidef['wstype'];
            $ws = new $wsclass($sidef['esp_data']);
        } else {
            $ws = new Atlasp_Ws_Esp($sidef['esp_data']);
        }

        if (isset($sidef['xml']) && $sidef['xml'] == 0) {
            try {
                $response = $ws->getResponse($soapInputs);
            } catch (Atlasp_Exp_WsException $e) {
                throw $e;
            }
            return $response;
        }

        try {
            $xml = $ws->getXML($soapInputs);
        } catch (Atlasp_Exp_WsException $e) {
            $err = Zend_Registry::get('errors');
            return $err['esp'];
        }

        if (isset($sidef['no_xsl'])) {
            return $xml;
        }

        $xdom = $this->getDom($xml);
        $rstr = $this->getResponseAttrs($xdom, $reqParams);
        $xml = $this->addToXml($xml, $rstr);

        //  Dump last response to file
        $this->_dumpResponseToFile($xml);

        $xsl = new Atlasp_Xsl_Display($sidef['xsl']);
        if (isset($sidef['xslparams'])) {
            $xsl->loadXsltParams($this->getXsltParams($reqParams));
        }

        try {
            $html = $xsl->getHtml($xml);
        } catch (Atlasp_Exp_XslException $e) {
            $err = Zend_Registry::get('errors');
            return $err['xslt'];
        }
        return $html;
    }

    public function getResponseAttrs($root, $reqData)
    {
        if ($root->getElementsByTagName("RecordCount")->item(0)) {
            $total = $root->getElementsByTagName("RecordCount")->item(0)->nodeValue;
        } else {
            $total = 0;
        }

        $pageNum = $this->getPageBeginEnd($reqData, $this->getPageCount(), $total);

        $rstr = '';
        $rstr.='total="' . $total . '" ';
        $rstr.='begin="' . $pageNum[0] . '" ';
        $rstr.='end="' . $pageNum[1] . '" ';
        $rstr.='cpage="' . $pageNum[2] . '" ';
        $rstr.='pages="' . $pageNum[3] . '" ';

        return $rstr;
    }

    protected function addToXml($response, $str)
    {
        $pat = '/\<response/i';
        $rep = "<response $str";
        $response = preg_replace($pat, $rep, $response);
        return $response;
    }

    protected function getDom($xml)
    {
        $xd = new DOMDocument;
        $xd->loadXML($xml);
        $root = $xd->documentElement;
        return $root;
    }

    protected function getPageCount()
    {
        return 25;
    }

    protected function _addSoapInputs($requestParams, $soapInput)
    {
        if (!isset($requestParams['PAGEOFF'])) {
            if (!isset($requestParams['showall'])) {
                if (isset($requestParams['PAGE'])) {
                    $begin = $requestParams['PAGE'] - 1;
                    $begin = $begin * $this->getPageCount();
                } else {
                    $begin = 1;
                }
                $soapInput['Options']['StartingRecord'] = $begin;
                $soapInput['Options']['ReturnCount'] = $this->getPageCount();
            } else {
                $soapInput['Options']['StartingRecord'] = 1;
                $soapInput['Options']['ReturnCount'] = 'all';
            }
        }
        
        return $soapInput;
    }

    /*
     * Returns (begin_record_of_this_page, end_record_of_this_page, 
     * current_page_num, total_pages )
     */
    protected function getPageBeginEnd($reqData, $perpage, $total)
    {
        if (!isset($reqData['showall'])) {
            if (isset($reqData['PAGE'])) {
                $begin = $reqData['PAGE'];
                $begin = $begin * $perpage;
            } else {
                $begin = 1;
            }
            if ($total < $perpage) {
                return array(1, $total, 1, 1);
            } else {
                if (isset($reqData['PAGE'])) {
                    $pagenum = $reqData['PAGE'];
                    $end = $begin + $perpage;
                    $begin++;
                } else {
                    $pagenum = 1;
                    $end = $perpage;
                }
                if ($end > $total) {
                    $end = $total;
                }
                return array($begin, $end, $pagenum, (int) ($total / $perpage));
            }
        } else {
            return array(1, $total, 1, 1);
        }
    }
}
