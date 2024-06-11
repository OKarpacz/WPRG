<?php

interface Employee {
    public function getSalary();
    public function setSalary($salary);
    public function getRole();
}

class Manager implements Employee {
    private $salary;
    private $employees = [];

    public function getSalary() {
        return $this->salary;
    }

    public function setSalary($salary) {
        $this->salary = $salary;
    }

    public function getRole() {
        return "Manager";
    }

    public function addEmployee(Employee $employee) {
        $this->employees[] = $employee;
    }

    public function getEmployees() {
        return $this->employees;
    }
}

class Developer implements Employee {
    private $salary;
    private $programmingLanguage;

    public function getSalary() {
        return $this->salary;
    }

    public function setSalary($salary) {
        $this->salary = $salary;
    }

    public function getRole() {
        return "Developer";
    }

    public function setProgrammingLanguage($programmingLanguage) {
        $this->programmingLanguage = $programmingLanguage;
    }

    public function getProgrammingLanguage() {
        return $this->programmingLanguage;
    }
}

class Designer implements Employee {
    private $salary;
    private $designingTool;

    public function getSalary() {
        return $this->salary;
    }

    public function setSalary($salary) {
        $this->salary = $salary;
    }

    public function getRole() {
        return "Designer";
    }

    public function setDesigningTool($designingTool) {
        $this->designingTool = $designingTool;
    }

    public function getDesigningTool() {
        return $this->designingTool;
    }
}
//Test
$manager = new Manager();
$manager->setSalary(5000);

$developer1 = new Developer();
$developer1->setSalary(4000);
$developer1->setProgrammingLanguage("PHP");

$developer2 = new Developer();
$developer2->setSalary(4500);
$developer2->setProgrammingLanguage("JavaScript");

$designer = new Designer();
$designer->setSalary(4500);
$designer->setDesigningTool("Adobe Illustrator");

$manager->addEmployee($developer1);
$manager->addEmployee($developer2);
$manager->addEmployee($designer);

echo "Manager Salary: " . $manager->getSalary() . "\n";
echo "Manager Role: " . $manager->getRole() . "\n";
echo "Manager Employees:\n";

foreach ($manager->getEmployees() as $employee) {
    echo "Role: " . $employee->getRole() . ", Salary: " . $employee->getSalary();
    if ($employee instanceof Developer) {
        echo ", Programming Language: " . $employee->getProgrammingLanguage();
    } elseif ($employee instanceof Designer) {
        echo ", Designing Tool: " . $employee->getDesigningTool();
    }
    echo "\n";
}
?>
