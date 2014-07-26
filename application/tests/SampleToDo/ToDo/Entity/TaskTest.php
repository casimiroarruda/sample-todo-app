<?php
/**
 * Created by PhpStorm.
 * User: duodraco
 * Date: 7/23/14
 * Time: 4:06 PM
 */

namespace SampleToDo\ToDo\Entity;


class TaskTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Task
     */
    protected $object;

    public function setUp()
    {
        $this->object = new Task;
    }

    public function tearDown()
    {
        $this->object = null;
    }

    public function testDone()
    {
        $this->object->setDone();
        $this->assertTrue($this->object->isDone());
    }
}
 