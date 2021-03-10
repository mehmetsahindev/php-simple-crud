<?php

class Response
{
  private $_title;
  private $_success;
  private $_error;
  private $_data;
  private $_formData;

  public function __construct($title, $success, $error, $data, $formData)
  {
    $this->setTitle($title);
    $this->setSuccess($success);
    $this->setError($error);
    $this->setdata($data);
    $this->setFormData($formData);
  }

  public function setTitle($title)
  {
    $this->_title = $title;
  }

  public function setSuccess($success)
  {
    $this->_success = $success;
  }

  public function setError($error)
  {
    $this->_error = $error;
  }

  public function setData($data)
  {
    $this->_data = $data;
  }

  public function setFormData($formData)
  {
    $this->_formData = $formData;
  }

  public function getTitle()
  {
    return $this->_title;
  }
  public function getSuccess()
  {
    return $this->_success;
  }
  public function getError()
  {
    return $this->_error;
  }
  public function getData()
  {
    return $this->_data;
  }
  public function getFormData()
  {
    return $this->_formData;
  }

  public function returnAsArray()
  {
    $response = array();
    $response['title'] = $this->getTitle();
    $response['success'] = $this->getSuccess();
    $response['error'] = $this->getError();
    $response['data'] = $this->getData();
    $response['formData'] = $this->getFormData();
    return $response;
  }
}
