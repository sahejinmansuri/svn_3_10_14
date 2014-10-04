<?php

class App_Menu extends App_Models_Db_Wigi_Menu {

	public function getAllItems($data){
		$result = $this->fetchAll($this->select()->where('user = ?', $data['user']));
		return $result->toArray();
	}
    
	public function fullMenu($data){
		$result = array();
		$parents = $this->fetchAll($this->select()->where('user = ?', $data['user'])->where('type = ?', 'PARENT'));
		$parents = $parents->toArray();
		
		$i=0;
		foreach($parents as $parent) {
			$childs = $this->fetchAll($this->select()->where('user = ?', $data['user'])->where('parent = ?', $parent['id'])->where('type = ?', 'CHILD'));
			$childs =  $childs->toArray();
			$result[$i]['id'] = $parent['id'];
			$result[$i]['name'] = $parent['name'];
			$result[$i]['status'] = $parent['status'];
			$result[$i]['count'] = count($childs);
			$items = array();
			$j=0;
			foreach($childs as $child) {
				$items[$j]['id'] = $child['id'];
				$items[$j]['name'] = $child['name'];
				$items[$j]['price'] = $child['price'];
				$items[$j++]['status'] = $child['status'];
			}
			$result[$i]['products'] = $items;
			$i++;
		}
		return $result;
	}
    
	public function getItem($data){
		$result = $this->fetchAll($this->select()->where('user = ?', $data['user'])->where('id = ?', $data['id']));
		return $result->toArray();
	}

	public function getParentItems($data){
		$result = $this->fetchAll($this->select()->where('user = ?', $data['user'])->where('type = ?', 'PARENT'));
		return $result->toArray();
	}

	public function checkExists($data) {
        $result = $this->fetchAll($this->select()->where('user = ?', $data['user'])->where('parent = ?', $data['parent'])->where('name = ?', $data['name']));
        if($result->count() > 0) {
			return true;
		}
		return false;
	}

	public function getItemsFromParent($data){
		$result = $this->fetchAll($this->select()->where('user = ?', $data['user'])->where('parent = ?', $data['parent'])->where('type = ?', 'CHILD'));
		return $result->toArray();
	}

	public function updateItem($data)
	{
		$update['name'] = isset($data['name']) ? $data['name'] : '';
		$update['price'] = isset($data['price']) ? $data['price'] : '';
		$user = isset($data['user']) ? $data['user'] : '';
		$update['parent'] = isset($data['parent']) ? $data['parent'] : 0;
		$update['type'] = isset($data['type']) ? $data['type'] : '';
		$update['status'] = isset($data['status']) ? $data['status'] : 'DISABLED';
		$id = $data['id'];
		if($update['name'] != '' && $user != '' && $update['type'] != '') {
			if ($this->update($update, array('id = ?' => $id, 'user = ?' => $user))) {
				return true;
			}
		}
		return false;
	}

	public function insertItem($data)
	{
		$insert['name'] = isset($data['name']) ? $data['name'] : '';
		$insert['price'] = isset($data['price']) ? $data['price'] : 0.00;
		$insert['user'] = isset($data['user']) ? $data['user'] : '';
		$insert['parent'] = isset($data['parent']) ? $data['parent'] : 0;
		$insert['type'] = isset($data['type']) ? $data['type'] : '';
		$insert['status'] = isset($data['status']) ? $data['status'] : 'DISABLED';
		if($insert['name'] != '' && $insert['user'] != '' && $insert['type'] != '') {
			return $this->insert($insert);
		}
		return false;
	}

	public function deleteItem($data)
	{
		$parent = array('parent' => $data['id'], 'user' => $data['user']);
		if($childs = self::getItemsFromParent($parent)) {
			foreach($childs as $childItem) {
				$this->delete(array('id = ?' => $childItem['id'], 'user = ?' => $data['user']));
			}
		}
		$this->delete(array('id = ?' => $data['id'], 'user = ?' => $data['user']));
		return true;
	}

}

?>
