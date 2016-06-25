<?php


class HelloWorldTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var PDO
     */
    public $pdo = null;

    public function __construct()
    {
        $this->pdo = new PDO("mysql:host=localhost;dbname=hello", "root", "", array(
			PDO::ATTR_PERSISTENT => true
		));

		$currentDir = __DIR__;
		$baseDir = str_replace("\Tests", "", $currentDir);
		$file = $baseDir."\HelloWorld.php";
		
		include_once($file);
    }

    public function setup() {
		
		$this->helloWorld = new HelloWorld($this->pdo);
		
	}
	
    public function tearDown()
    {
        unset($this->helloWorld);
    }
	

    public function testDBCreate() {
		$result = $this->helloWorld->createDBIFNotExists();
		$this->assertTrue($result, true);
	}
	
    public function testTableCreate() {
		$result = $this->helloWorld->createTableIFNotExists();
		$this->assertTrue($result, true);
	}
	
	
	
    public function testInsert()
    {
		$result = $this->helloWorld->insert("1. Versuch - ".date("d.m.Y H:i:s"));
		$this->assertTrue($result);
    }
    public function testInsertFalse()
    {
		$result = $this->helloWorld->insert();
		$this->assertFalse($result);
    }

	
    public function testHello()
    {
        $results = $this->helloWorld->getAll();
		$this->assertTrue(is_array($results), true); // https://phpunit.de/manual/current/en/appendixes.assertions.html
    }
	

    public function testWhat()
    {

        $result = $this->helloWorld->insert("2. Versuch - ".date("d.m.Y H:i:s"));
        $this->assertTrue($result);

        // $this->assertEquals('Bar', $this->helloWorld->getAll());
    }
}

