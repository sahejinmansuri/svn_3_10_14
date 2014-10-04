<?php

/**
 * Atlasp_Config_Ini is derived class from Zend_Config_Ini
 *
 * Atlasp_Config_Ini allows configuration properties to be contained within
 * another property. 
 *
 * example: ap.OBJ_PATH = "/home/user/"
 * 
 * example: ap.OBJ_FILE = "{ap.OBJ_PATH}somefile.txt" = 'home/user/somefile.txt'
 *
 * @category    Atlasp
 * @package     Atlasp_Config
 * @see         Zend_Config_Ini
 */
class Atlasp_Config_Ini extends Zend_Config_Ini
{

    /**
     * Collection of hash values for all processed objects
     *
     * @var array
     */
    protected $_processedObjectHashkeys = array();

    /**
     * Magic function so that $obj->value will work.
     *
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        //
        $cnfValue = $this->get($name);

        //
        if (is_object($cnfValue)) {
            $this->_performVariableSubstitution($cnfValue);
        }

        //
        return $cnfValue;
    }

    /**
     * Performs variable substitution
     *
     * @param Zend_Config $object
     * @return void
     */
    protected function _performVariableSubstitution(Zend_Config $object)
    {
        if (!isset($object->_data) && $object instanceof Zend_Config) {
            return;
        }
        //  Get Properties of array
        $properties = $object->_data;

        //  Generate unique key for the unmodified properties
        $hashKey = sha1(serialize($properties));
        if (!isset($this->_processedObjectHashkeys[$hashKey])) {

            //  Store object hashkey to prevent preprocessing of the same object
            $this->_processedObjectHashkeys[$hashKey] = true;

            //  Scan through all properties of object
            foreach ($properties as $property => $value) {

                //  Recurse if proterty is object
                if (is_object($value)) {
                    //  Decend into the object
                    $this->_performVariableSubstitution($value);
                } else
                //  If is string try to replace
                if (is_string($value)) {

                    //  Get Reference
                    $propReference = $object->$property;

                    //
                    $matches = array();
                    if (preg_match_all('/{([\d\w\.]+)}/', $propReference, $matches)) {

                        //  Scan through all matches
                        foreach ($matches[1] as $match) {

                            //  Initialize sub-config value
                            $subCnfValue = null;

                            //  Check if operating on multi-level / root property
                            if (strpos($match, '.') === false) {
                                 //  Operating on root property
                                $subCnfValue = $this->get($match);
                            }else{
                                //  Split Match into peaces
                                $tmp = explode('.', $match);

                                //  Get Data array index
                                $arrayIndex = $tmp[0];
                                //  Destroy Data Array index
                                unset($tmp[0]);

                                //  Combine remainting peaces together to
                                //  get chain to needed property
                                $rPropRef = implode('->', $tmp);

                                //  Get Configuration Value for the sub-config
                                $subCnf = $this->get($arrayIndex);
                                $subCnfValue = isset($subCnf->$rPropRef) ? $subCnf->$rPropRef : null;

                                //  Special Case:
                                //
                                //  Object is in a Nested object, nested Zend_Config
                                //  Calling object property with variable substitution will
                                //  not work, because Magic method __get not be called
                                //
                                //  Programatically creating a statement will 1st
                                //  substitute the variables in the string, resulting
                                //  in full path to the object that will call all the
                                //  magic methods when requested sequentially
                                if ($subCnfValue === null) {
                                    eval("\$subCnfValue = \$subCnf->$rPropRef;");
                                }
                            }
                            
                            //  Perform variable substitution
                            $propReference = str_replace('{' . $match . '}', $subCnfValue, $propReference);
                        }

                        //  Assign new value to the config 
                        $object->_data[$property] = $propReference;
                    }
                }
            }

            //  Get new HashKey for modified properties
            $newHashKey = sha1(serialize($object->_data));
            //  Store object hashkey to prevent preprocessing of the same object
            $this->_processedObjectHashkeys[$newHashKey] = true;
        }
    }

}