<?php
namespace Job\Entity;

class Users{

const EDIT_JOB = 1;
const DELETE_JOB = 2;
const LIST_CATEGORIES = 4;
const EDIT_CATEGORY = 8;
const DELETE_CATEGORY = 16;
const EDIT_USER_ACCESS = 32;
const ARCHIVE_JOB=64;
const EDIT_USER=128;
const APPLICANT_LIST=256;

private $permission;
private $jobsTable;
public $id;

public function __construct(\CSY2028\DatabaseTable $jobsTable) {
          $this->jobsTable = $jobsTable;

 }
 public function addJob(array $joke) {
    $job['userId'] = $this->id;
    $this->jobsTable->save($job);
  }

public function hasPermission(int $permission) {
    return $this->permissions & $permission;
}

}
