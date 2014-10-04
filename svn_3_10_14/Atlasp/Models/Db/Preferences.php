<?php

class Atlasp_Models_Db_Preferences extends Atlasp_Db_Table_Abstract
{

    protected $_name = 'preferences';
    protected $_primary = array('COMPANYID', 'LOGINID');

    /**
     * Loads user preferences 
     * 
     * @param int $companyId
     * @param string $loginId
     * @return array
     */
    public function getUserPreferences($companyId, $loginId)
    {
        //  Create query to load prefs for given user 
        $select = $this->select()
                ->from($this->_name, 'prefs')
                ->where('loginid = ?', $loginId)
                ->where('companyid = ?', (int) $companyId);

        //  Load Prefs
        $preferences = $this->fetchRow($select);
        
        //  Convert prefs to array
        $preferencesXml = isset($preferences->prefs) ? $preferences->prefs : null;
        $preferences = $this->_convertXmlToArray($preferencesXml);

        //
        return $preferences;
    }

    /**
     * Converts XML to array with all children as arrays and yes/no values as 
     * true/false.
     * 
     * @param string $xmlPreferences
     * @return array
     */
    protected function _convertXmlToArray($xmlPreferences)
    {
        //  Make sure XML Preferences are valid
        if (!$xmlPreferences) {
            return array();
        }

        //  Load XML and conver to array
        $preferences = (array) @simplexml_load_string($xmlPreferences);
        //  Clean preferences
        $preferences = $this->_cleanPreferences($preferences);

        //
        return $preferences;
    }

    /**
     * Cleans preferences:     * 
     * - converts all objects to arrays
     * - converts "yes" => true 
     * - converts "no" => false 
     * 
     * @param array $array
     * @return array 
     */
    protected function _cleanPreferences(array $array)
    {
        foreach ($array as &$element) {
            //  If element is object, cast it to array
            if (is_object($element)) {
                $element = (array) $element;
            }

            //  If element is array, make sure all children are clean
            if (is_array($element)) {
                $element = $this->_cleanPreferences($element);
            } else
            //  If element is string (dealing with value)
            if (is_string($element)) {
                //  Sanitize element value
                switch ($element) {
                    case 'yes':
                        $element = true;
                        break;
                    case 'no':
                        $element = false;
                        break;
                }
            }
        }

        return $array;
    }

}