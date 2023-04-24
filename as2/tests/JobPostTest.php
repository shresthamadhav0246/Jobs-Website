<?php
namespace tests;
require 'Job/Controllers/Job.php';
require 'MockDatabase/MockDatabaseJobsTable.php';
require 'CSY2028/DatabaseTable.php';

class JobPostTest extends \PHPUnit\Framework\TestCase {
  public $pdo;
public function testValid() {
  $jobsTable = $this->createMock(\MockDatabase\MockDatabaseJobsTable::class);
    $categoriesTable = $this->createMock(\MockDatabase\MockDatabaseJobsTable::class);
    $locationsTable = $this->createMock(\MockDatabase\MockDatabaseJobsTable::class);
    $adminAuthentication = $this->createMock(\MockDatabase\MockDatabaseJobsTable::class);
    $adminTable = $this->createMock(\MockDatabase\MockDatabaseJobsTable::class);

  $testPostData = [
    'job' => [
            'id' => '20',
            'title' => 'Test Job Title',
            'description' => 'Test Job Description',
            'salary' => '50000',
            'locationId' => '1',
            'categoryId' => '1',
            'closingDate' => '2024-01-01',
            'userId' => '1'
  ]
  ];
  $jobController = new \Job\Controllers\Job($jobsTable,$categoriesTable,$locationsTable,$adminTable,$adminAuthentication, [], $testPostData);

  ob_start();
  $result = $jobController->editSubmit();
  $result = ob_get_clean();

  $this->assertEquals('', $result);

 
}

public function testDatabaseJobsTableSave() {
  $pdo=new \PDO('mysql:host=mysql;dbname=job;charset=utf8', 'student', 'student');

  //Delete the record
 $delete=$pdo->query('DELETE FROM job WHERE id = 20');
  //query the database for john's record
 $stmt = $pdo->query('SELECT * FROM job WHERE id = 20');
  //fetch the record
 $record = $stmt->fetch();
  //Check there is no record for john
 $this->assertFalse($record);
  //set up test data
 $testRecord = [
  'id' => 20,
  'title' => 'Test Job Title',
  'description' => 'Test Job Description',
  'salary' => '50000',
  'locationId' => '1',
  'categoryId' => '1',
  'closingDate' => '2024-01-01',
  'userId' => '1'
  ];
  $databaseTable = new \CSY2028\DatabaseTable($pdo, 'job', 'id');
  $databaseTable->save($testRecord);
  //query the database again for john's record
 $stmt = $pdo->query('SELECT * FROM job WHERE id =20');
  //fetch the record
  if ($stmt !== false) {
    $record = $stmt->fetch();
    return $record;
  } else {
    // handle the case where the query failed
  }
  //Check there is now record for john and the values match the ones expected
 $this->assertEquals($record['id'], $testRecord[20]);
  $this->assertEquals($record['title'], $testRecord['Test Job Title']);
  $this->assertEquals($record['description'], $testRecord['Test Job Description']);
  $this->assertEquals($record['salary'], $testRecord['50000']);
  $this->assertEquals($record['locationId'], $testRecord['1']);
  $this->assertEquals($record['categoryId'], $testRecord['1']);
  $this->assertEquals($record['closingDate'], $testRecord['2024-01-01']);
  $this->assertEquals($record['userId'], $testRecord['1']);
  }

}

?>