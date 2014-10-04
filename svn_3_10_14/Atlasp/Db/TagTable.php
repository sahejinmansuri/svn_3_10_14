<?php

class Atlasp_Db_TagTable extends Atlasp_Db_Table_Abstract
{

    protected $_name = 'tag_table';

    /**
     * Gets tag by ID
     * 
     * @param int $tagId
     * @return array
     * @throws Exception
     */
    public function getTag($tagId)
    {
        $tagId = (int) $tagId;
        $row = null;

        //
        if (!$tagId) {
            throw new Exception("Tag id is required");
        }

        //  Create SQL
        $select = $this->getAdapter()->select()
                ->from($this->_name)
                ->where('TAGID = ?', $tagId);

        try {
            //  Execute SQL
            $row = $this->getAdapter()->fetchRow($select);
        } catch (Exception $e) {
            $m = __METHOD__ . '(): ';
            Zend_Registry::get('log')->err($m . 'Exception thrown - ' . $e->getMessage());
        }

        return $row;
    }

    /**
     * 
     * @param int $companyId
     * @param int $userId
     * @param string $category
     * @param string|array $subcategory
     * @return array
     * @throws Exception
     */
    public function getTags($companyId, $userId=null, $category=null, $subcategory=null)
    {
        $m = __METHOD__ . '(): ';
        $log = Zend_Registry::get('log');
        $companyId = (int) $companyId;
        $tags = array();
        
        //
        if (!$companyId) {
            throw new Exception('Companyid is required at minimum');
        }

        //  Create SQL
        $select = $this->getAdapter()->select()
                ->from($this->_name)
                ->where('COMPANYID = ?', (int) $companyId);

        if ($userId) {
            $select->where('USERID = ?', (int) $userId);
        } else {
            $select->where('USERID IS NULL');
        }
        if ($category) {
            $select->where('CATEGORY = ?', $category);
        }
        if ($subcategory) {
            if (is_string($subcategory)) {
                $select->where('SUBCATEGORY = ?', $subcategory);
            } elseif (is_array($subcategory)) {
                if (count($subcategory) > 0) {
                    $tmp = array();
                    foreach ($subcategory as $cat) {
                        $tmp[] = $this->getAdapter()->quoteInto("?", $cat);
                    }
                    $cats = implode(', ', $tmp);
                    $sql = "SUBCATEGORY IN ($cats)";
                    $select->where($sql);
                }
            }
        }

        try {
            $log->debug($m . "Loading tags for [cid=$companyId, uid=$userId , cat=$category , subcat=$subcategory");
            $tags = $this->getAdapter()->fetchAll($select);
        } catch (Exception $e) {
            $log->err($m . 'Exception thrown - ' . $e->getMessage());
        }

        //
        return $tags;
    }

}
