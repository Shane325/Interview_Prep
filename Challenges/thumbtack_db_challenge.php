<?php

$myApp = new MyApp();
//read the user input
$myApp->readStandardInput();

Class MyApp {

    protected $myDatabase;

    public function __construct(){
        //instantiate new class
        $this->myDatabase = new MyDatabase();
    }

    public function routeCommand($command){
        //split the user input into an array of values
        $params = explode(" ", $command);
        //assign values to variables
        $request = $params[0];

        if($request == 'SET'){
            //handle SET request
            $name = $params[1];
            $value = $params[2];

            $this->myDatabase->setFunc($name, $value);

            $this->readStandardInput();

        }elseif($request == 'GET'){
            //handle GET request here
            $name = $params[1];

            $this->myDatabase->getFunc($name);

            $this->readStandardInput();

        }elseif($request == 'UNSET'){
            //handle UNSET request here
            $name = $params[1];

            $this->myDatabase->unsetFunc($name);

            $this->readStandardInput();

        }elseif($request == 'NUMEQUALTO'){
            //handle NUMEQUALTO request
            $value = $params[1];

            $this->myDatabase->numEqualToFunc($value);
            $this->readStandardInput();

        }elseif($request == 'END'){
            //handle END request
            $this->myDatabase->closeDb();
            exit;
        }

        $this->myDatabase->getAllFunc();
        $this->readStandardInput();
    }

    //function to read from the command line
    public function readStandardInput(){
        $fr = fopen("php://stdin", "r");    //open file pointer to read from stdin
        $input = fgets($fr);                //read 128 max characters
        $input = rtrim($input);             //trim right
        fclose($fr);                        //close the file handle
        //return $input;                      //return the input stream
        $this->routeCommand($input);
    }

    //function to process output
    public function writeStandardOutput($output){
        $fw = fopen("php://stdout", "w");
        fwrite($fw, $output . PHP_EOL);
        fclose($fw);
    }

}

Class MyDatabase{

    protected $db;

    public function __construct(){
        //create in memory db if it does not exist
        $this->db = new SQLite3(':memory:');
        //create table in db if it does now exist
        $this->db->exec('CREATE TABLE IF NOT EXISTS storage (name STRING, value INT);');
    }

    //function to SET a name and value
    public function setFunc($name, $value){
        $statement = $this->db->prepare('INSERT INTO storage (name, value) VALUES (:name, :value);');
        $statement->bindValue(':name', $name);
        $statement->bindValue(':value', $value);
        $statement->execute();
    }

    //function to GET a value based on name
    public function getFunc($name){
        $statement = $this->db->prepare('SELECT value FROM storage WHERE name = :name;');
        $statement->bindValue(':name', $name);
        $result = $statement->execute();
        while($row = $result->fetchArray()){
            echo $row['value'] . PHP_EOL;
        }
    }

    //function to UNSET a value based on name
    public function unsetFunc($name){
        $statement = $this->db->prepare('DELETE FROM storage WHERE name = :name;');
        $statement->bindValue(':name', $name);
        $statement->execute();
    }

    //function to get NUMEQUALTO
    public function numEqualToFunc($value){
        $statement = $this->db->prepare('SELECT COUNT(name) as numequalto FROM storage WHERE $value = :value;');
        $statement->bindValue(':value', $value);
        $result = $statement->execute();
        //var_dump($result->fetchArray());
        while($row = $result->fetchArray()){
            echo $row['numequalto'] . PHP_EOL;
        }
        echo $value . PHP_EOL;
    }

    //function to return all values from table
    public function getAllFunc(){
        $result = $this->db->query('SELECT * FROM storage');
        while($row = $result->fetchArray()){
             echo $row['name'] . " " . $row['value'] . PHP_EOL;
        }
    }

    //function to Close db connection
    public function closeDb(){
        $this->db->close();
    }
}



?>
