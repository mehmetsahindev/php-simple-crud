<?php

class UserException extends Exception
{
}

class User
{
  private $_id;
  private $_name;
  private $_email;
  private $_phone;

  public function __construct($id, $name, $email, $phone)
  {
    $this->setID($id);
    $this->setName($name);
    $this->setEmail($email);
    $this->setPhone($phone);
  }

  public function getID()
  {
    return $this->_id;
  }

  public function getName()
  {
    return $this->_name;
  }

  public function getEmail()
  {
    return $this->_email;
  }

  public function getPhone()
  {
    return $this->_phone;
  }

  public function setID($id)
  {
    if (($id !== null) && (!is_numeric($id) || $id <= 0 || $id > 9223372036854775807 || $this->_id !== null)) {
      throw new UserException("User ID error");
    }

    $this->_id = $id;
  }

  public function setName($name)
  {
    if (strlen($name) < 1) {
      throw new UserException("User name is required.");
    } else if (strlen($name) > 100) {
      throw new UserException("User name must be 100 character max.");
    }

    $this->_name = $name;
  }

  public function setEmail($email)
  {
    if (($email !== null) && (strlen($email) > 100)) {
      throw new UserException("User email must be 100 character max.");
    }

    $this->_email = $email;
  }

  public function setPhone($phone)
  {
    if (($phone !== null) && strlen($phone) > 100) {
      throw new UserException("User phone must be 100 character max.");
    }

    $this->_phone = $phone;
  }
}
