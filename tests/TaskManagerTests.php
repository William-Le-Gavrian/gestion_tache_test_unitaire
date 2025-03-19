<?php

use App\Entity\TaskManager;

class TaskManagerTests extends \PHPUnit\Framework\TestCase
{
    public function testConstructor()
    {
        $taskManager = new TaskManager();

        $this->assertEquals([], $taskManager->getTasks());
    }

    public function testAddTask()
    {
        $taskManager = new TaskManager();
        $task = "test task";

        $taskManager->addTask($task);

        $this->assertCount(1, $taskManager->getTasks());
    }

    public function testRemoveTask()
    {
        $taskManager = new TaskManager();
        $task = "test task";
        $taskManager->addTask($task);
        $taskManager->removeTask(0);

        $this->assertCount(0, $taskManager->getTasks());

        $this->expectException(OutOfBoundsException::class);
        $this->expectExceptionMessage("Index de tâche invalide: 0");
        $taskManager->removeTask(0);
    }

    public function testGetters()
    {
        $taskManager = new TaskManager();
        $task = "test task";
        $taskManager->addTask($task);

        $this->assertEquals($task, $taskManager->getTask(0));
        $this->assertEquals([$task], $taskManager->getTasks());

        $this->expectException(OutOfBoundsException::class);
        $this->expectExceptionMessage("Index de tâche invalide: 1");
        $taskManager->getTask(1);
    }

    public function testRemoveInvalidIndexThrowsException()
    {
        $taskManager = new TaskManager();

        $this->expectException(OutOfBoundsException::class);
        $this->expectExceptionMessage("Index de tâche invalide: 0");
        $taskManager->removeTask(0);
    }

    public function testGetInvalidIndexThrowsException()
    {
        $taskManager = new TaskManager();

        $this->expectException(OutOfBoundsException::class);
        $this->expectExceptionMessage("Index de tâche invalide: 1");
        $taskManager->getTask(1);
    }

    public function testTaskOrderAfterRemoval()
    {
        $taskManager = new TaskManager();
        for($i = 0; $i < 5; $i++){
            $taskManager->addTask("test task $i");
        }

        $this->assertEquals(["test task 0", "test task 1" , "test task 2", "test task 3", "test task 4"], $taskManager->getTasks());
    }
}