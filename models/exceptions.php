<?php

class DBException extends Exception
{
  function display()
  {
    echo "DBException: $this->message";
  }
}

class DataValueException extends Exception
{
  function display()
  {
    echo "DataValueException: $this->message";
  }
}


?>
