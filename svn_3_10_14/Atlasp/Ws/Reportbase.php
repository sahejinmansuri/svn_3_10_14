<?php

class Atlasp_Ws_Reportbase extends Atlasp_Ws_Searchbase
{

    public function getResponse($req)
    {
        $sidef = $this->getEvtData();
        $soapInputs = $this->_makeSoapInput($sidef['soap_input'], $req);
        $wsesp = new Atlasp_Ws_Esp($sidef['esp_data']);
        if (isset($sidef['no_xml'])) {
            $response = $wsesp->getResponse($soapInputs);
        } else {
            $response = $wsesp->getXML($soapInputs);
        }

        if (isset($sidef['no_xsl'])) {
            return $response;
        }

        //
        $xdom = $this->getDom($response);
        $rstr = $this->getResponseAttrs($xdom, $req);
        $response = $this->addToXml($response, $rstr);

        //
        $this->_dumpResponseToFile($response);

        //
        $xsl = new Atlasp_Xsl_Display($sidef['xsl']);
        $html = $xsl->getHtml($response);
        
        //
        return $html;
    }

    public function getPageBeginEnd($req, $a, $b)
    {
        
    }

    public function getResponseAttrs($root, $req)
    {
        return '';
    }

}
