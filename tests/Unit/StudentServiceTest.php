<?php

namespace Tests\Unit;

use App\Http\Services\StudentService;
use App\Models\Student;
use Illuminate\Support\Collection;
use Mockery;
use Tests\TestCase;

class StudentServiceTest extends TestCase
{

    public function tearDownn(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_get_all_students_returns_collection()
    {
        $studentMock = Mockery::mock(Student::class);
        $studentMock->shouldReceive('all')
            ->once()
            ->andReturn(collect([
                (object)['id' => 1, 'given_name' => 'Juan'],
                (object)['id' => 2, 'given_name' => 'Ana'],
            ]));

        $service = new StudentService($studentMock);
        $result = $service->getAllStudents();

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertCount(2, $result);
    }

    public function test_get_student_by_id_returns_student()
    {
        $student = new Student([
            'id' => 1,
            'dni' => '12345678',
            'given_name' => 'Juan',
            'family_name' => 'Pérez',
            'email' => 'juan@example.com',
            'bithdate' => '2000-01-01',
            'state' => 'active',
        ]);;

        $studentMock = Mockery::mock(Student::class);
        $studentMock->shouldReceive('find')->with(1)->once()->andReturn($student);

        $service = new StudentService($studentMock);
        $result = $service->getStudentById(1);

        $this->assertEquals($student->id, $result->id);
    }

    public function test_create_student_returns_student()
    {
        $data = [
            'dni' => '87654321',
            'given_name' => 'María',
            'family_name' => 'Gómez',
            'email' => 'maria@example.com',
            'bithdate' => '1998-05-15',
            'state' => 'active',
        ];

        $studentInstanceMock = Mockery::mock(Student::class)->makePartial();

        $studentModelMock = Mockery::mock(Student::class);
        $studentModelMock->shouldReceive('create')
            ->with($data)
            ->once()
            ->andReturn($studentInstanceMock);

        $service = new StudentService($studentModelMock);
        $student = $service->createStudent($data);

        $this->assertInstanceOf(Student::class, $student);
    }

    public function test_update_student_updates_and_returns_student()
    {
        $studentId = 1;
        $data = ['given_name' => 'Updated Name'];

        $student = Mockery::mock(Student::class);
        $student->shouldReceive('update')->with($data)->once()->andReturn(true);

        $studentMock = Mockery::mock(Student::class);
        $studentMock->shouldReceive('find')->with($studentId)->once()->andReturn($student);

        $service = new StudentService($studentMock);

        $result = $service->updateStudent($studentId, $data);

        $this->assertNotNull($result);
    }

    public function test_update_student_returns_null_when_not_found()
    {
        $id = 999;
        $data = ['state' => 'inactive'];

        $studentModelMock = Mockery::mock(Student::class);
        $studentModelMock->shouldReceive('find')
            ->with($id)
            ->once()
            ->andReturn(null);

        $service = new StudentService($studentModelMock);
        $result = $service->updateStudent($id, $data);

        $this->assertNull($result);
    }

    public function test_delete_student_returns_true()
    {
        $studentMock = Mockery::mock(Student::class);
        $studentMock->shouldReceive('delete')
            ->once()
            ->andReturn(true);

        $service = new StudentService(new Student());
        $result = $service->deleteStudent($studentMock);

        $this->assertTrue($result);
    }
}
