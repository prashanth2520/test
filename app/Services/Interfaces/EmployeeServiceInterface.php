<?php
namespace App\Services\Interfaces;

interface EmployeeServiceInterface
{
    public function index();
    public function saveEmployee(array $request);
    public function viewEmployee(int $emp_id);
}

?>