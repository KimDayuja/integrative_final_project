<?php 


/**
 * User class
 */
class User
{
	
	use Model;

	protected $table = 'users';
    protected $allowedColumns = [
        'fname',
        'lname',
        'email',
        'phone',
        'password',
        'role',
    ];

    public function validate($data){
        $this->errors = [];
        
        if(empty($this->errors)){
            return true;
        }
        return false;
    }

	public function deleteUser($userId, $id_column = 'UserId')
    {
        return $this->delete($userId, $id_column);
    }
    public function delete($id, $id_column = 'id')
    {
        $data[$id_column] = $id;
        $query = "DELETE FROM $this->table WHERE $id_column = :$id_column";

        if($this->query($query, $data)) {
            return true;
        }
        return false;
    }
}