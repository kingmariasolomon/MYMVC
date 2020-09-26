<?php
namespace App\Models;
use Core\Model;
use Core\Validators\RequiredValidator ;
use Core\Validators\MaxValidator ;

class Contacts extends Model
{
    public $id, $user_id, $fname, $lname, $email, $address, $address2, $city, $state, $zip, $home_phone, $cell_phone, $work_phone, $deleted = 0;

    public function __construct() {
        $table = 'contacts';
        parent::__construct($table);
        $this->_softDelete = true;
    }

    public function validator(){
        $this->runValidation(new RequiredValidator($this, ['field'=>'fname', 'msg'=>'First Name is required.']));
        $this->runValidation(new MaxValidator($this, ['field'=>'fname', 'rule'=>150, 'msg'=>'First Name Must Be less than 150 Characters.']));

        $this->runValidation(new RequiredValidator($this, ['field'=>'lname', 'msg'=>'Last Name is required.']));
        $this->runValidation(new MaxValidator($this, ['field'=>'lname', 'rule'=>150, 'msg'=>'Last Name Must Be less than 150 Characters.']));
    }

    public function findAllByUserId($user_id, $params=[]) {
        $conditions = [
            'conditions' => 'user_id = ?',
            'bind' => [$user_id]
        ];
        $conditions = array_merge($conditions, $params);
        return $this->find($conditions);
    }

    public function displayName() {
        return $this->fname . ' ' . $this->lname;
    }

    public function findByIdAndUserId($contact_id, $user_id, $params=[]) {
        $conditions = [
            'conditions' =>'id = ? And user_id = ?',
            'bind' => [$contact_id, $user_id]
        ];
        $conditions = array_merge($conditions, $params);
        return $this->findFirst($conditions);
    }

    public function displayAddress(){
        $address = '';
        if(!empty($this->address)) {
            $address .= $this->address . '<br>';
        }
        if(!empty($this->address2)) {
            $address .= $this->address2 . '<br>';
        }
        if(!empty($this->city)) {
            $address .= $this->city . ', ';
        }
        $address .= $this->state . ' ' . $this->zip . '<br>';
        return $address;
    }

    public function displayAddressLable() {
        $html = $this->displayName() . '<br>';
        $html .= $this->displayAddress();
        return $html;
    }
}
