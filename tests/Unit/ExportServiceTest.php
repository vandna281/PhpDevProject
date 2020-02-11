<?php

namespace Tests\Unit;

use Mockery as m;
use Tests\TestCase;
use App\Service\ExportService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExportServiceTest extends TestCase
{
	public function setUp() {
		$this->expSvc = new ExportService();
	}

	/*
	* When no ids are passed, then no logic will run
	*/
	public function testExportSelectedStudents_withNoId() {
		$mockObj = $this->getMockBuilder('ExportService')
			 			->setMethods(['writeDatatoFile', 'saveHistory', 'exportSelectedStudents'])
			 			->getMock();

		$mockObj->expects($this->exactly(0))
				->method('writeDatatoFile')
				->willReturn(true);
		$mockObj->expects($this->exactly(0))
				->method('saveHistory')
				->willReturn(true);

		$mockObj->exportSelectedStudents("",1);
	}

}