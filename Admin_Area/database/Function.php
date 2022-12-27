<?php
function SelectId($table_name,$id){
  GLOBAL $conn;
    $sql = "SELECT * FROM $table_name Where id=$id";
    $result = $conn->query($sql);
    
    if ($result !== FALSE) {
      if ($result->num_rows > 0) {
        return $result->fetch_assoc();
        $result -> free_result();
      } else {
        echo "0 results";
      }
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

function SelectAll($table_name){
    GLOBAL $conn;
    $sql = "SELECT * FROM $table_name";
    $result = $conn->query($sql);
    
    if ($result !== FALSE) {
      if ($result->num_rows > 0) {
        return $result;
        $result -> free_result();
      } else {
        echo "0 results";
      }
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

function SelectRaw($sql){
    GLOBAL $conn;
    $result = $conn->query($sql);
    if ($result !== FALSE) {
      if ($result->num_rows > 0) {
        return $result;
        $result -> free_result();
      } else {
        echo "0 results";
      }
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

function Insert($table_name,$column,$value){
    GLOBAL $conn;
    $sql = "INSERT INTO $table_name ($column)
    VALUES ($value)";

    if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;
    return $last_id;
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

function Update($table_name,$updated,$id){
  GLOBAL $conn;
  $sql = "UPDATE $table_name SET $updated where id=$id";
  if ($conn->query($sql) === TRUE) {
    return $conn->query($sql);
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
function Delete($table_name,$id){
  GLOBAL $conn;
  $sql = "DELETE FROM $table_name WHERE id=$id";

  if ($conn->query($sql) === TRUE) {
    return TRUE;
    echo "Record deleted successfully";
  } else {
    echo "Error deleting record: " . $conn->error;
  }
  $conn->close();
}
?>
