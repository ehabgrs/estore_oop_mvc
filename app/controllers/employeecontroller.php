<?php
namespace PHPMVC\Controllers;
class EmployeeController extends AbstractController
{
    use \PHPMVC\LIB\InputFilter;
    use \PHPMVC\LIB\Helper;
        
	public function defaultAction()
	{
		$this->_language->load('template.common');
        $this->_language->load('employee.default');
		$employees = \PHPMVC\Models\EmployeeModel::getAll();
        // we added the data for _data array for this controller
        $this->_data['employees'] = $employees;

        $this->_view();
	}
    
    public function addAction()
    {
		$this->_language->load('template.common');
		
        if(isset($_POST['submit'])) {
            // we filter the data coming for us from the user first before use it
            $name = $this->filterString($_POST['name']);
            $age = $this->filterInt($_POST['age']);
            $address = $this->filterString($_POST['address']);
            $tax = $this->filterFloat($_POST['tax']);
            $salary = $this->filterFloat($_POST['salary']);
            
            // create new object from EmployeeModel and it has construct by 5 values so i ahve to add it
            // we can remove the construct function from EmployeeModel class and then use setters instead example $emp->name = $name
            
            $emp = new \PHPMVC\Models\EmployeeModel($name,$age,$address,$tax,$salary);
            
            
           
            if($emp->create()){
                 $this->redirect('/public/employee');
            } else {
                echo 'aw snap';
            }
        }
        
        $this->_view();
    }
	
	
	 public function editAction()
    {
		$this->_language->load('template.common');
		//use filterInt() that we created in inputfilter trait
		$id = $this->filterInt($this->_params[0]);
		
		$employee = \PHPMVC\Models\EmployeeModel::getEmployeeById($id);
		
			if($id>0 && !empty($employee)) {
				
				$this->_data['employee'] = $employee;
							
            } else {
				$this->redirect('/public/employee');
			}
			
			if(isset($_POST['submit'])) {
				$employee->name = $this->filterString($_POST['name']);
				$employee->age = $this->filterInt($_POST['age']);
				$employee->salary = $this->filterFloat($_POST['salary']);
				$employee->tax = $this->filterFloat($_POST['tax']);
				$employee->address = $this->filterString($_POST['address']);
				
				if($employee->update()) {
					$this->redirect('/public/employee');
				}	
			}
	 $this->_view();
	}
    
    public function deleteAction()
    {
		$this->_language->load('template.common');
        $id = $this->filterInt($this->_params[0]);
		
		$employee = \PHPMVC\Models\EmployeeModel::getEmployeeById($id);
		
		if($id>0 && !empty($employee)) {		
				$this->_data['employee'] = $employee;				
            } else {
				$this->redirect('/public/employee');
			}
	
			if(isset($_POST['submit'])) {
				if($employee->employeeDelete($id)) {
					$this->redirect('/public/employee');
				}	
			}
			
			 $this->_view();	
    }
	
	
} 