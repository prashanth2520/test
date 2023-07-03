<?php
namespace App\Repositories\Interfaces;

interface EmployeeRepositoryInterface
{
    public function index();
    public function hasEmployee(int $emp_id);
    public function updateUser(array $request);
    public function updateEmployeeDet(array $request);
    public function viewEmployee(int $emp_id);
}



?>