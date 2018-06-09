<?php

namespace tests\models;

use app\models\Auskunft;
use app\models\Generated;
use app\models\Reminders;

use app\commands\CleanupController;

class CleanupControllerTest extends \Codeception\Test\Unit
{
    private $model;
    /**
     * @var \UnitTester
     */
    public $tester;

    public function testCleanup()
    {
    }
}