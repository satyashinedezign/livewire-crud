<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;

class FormValidation extends Component
{
    public $enctype;
    public $jQueryValidation;
    public $form;
    public $index = 1;
    public $showForm = true;
    public $formId = 'formId';
    public $method = 'get';
    public $fields = [];
    public $fileType = [];
    public $selectOptions = [];
    public $customClass = [];
    public $minLength = [];
    public $maxLength = [];
    public $regex = [];
    public $required = [];
    public $fieldType = ["text"];
    public $label = [''];
    public $fieldTypeValues = [''];

    protected $rules = [
        'formId' => 'required',
        'method' => 'required|in:get,post',
        'enctype' => 'nullable|in:multipart/form-data,application/x-www-form-urlencoded,text/plain',
        'label.0' => 'required',
        'fieldType.0' => 'required',
        'minLength.0' => 'nullable|numeric',
        'maxLength.0' => 'nullable|numeric',
        'label.*' => 'required',
        'fieldType.*' => 'required',
        'minLength.*' => 'nullable|numeric',
        'maxLength.*' => 'nullable|numeric',
    ];

    protected $messages = [
        'formId.required' => 'Please enter the form id',
        'method.required' => 'Please select the form method',
        'method.in' => 'Form method can either be get or post',
        'enctype.in' => 'Enctype can be multipart/form-data, application/x-www-form-urlencoded or text/plain',
        'label.0.required' => 'Please enter the label',
        'fieldType.0.required' => 'Please select the field type',
        'minLength.0.numeric' => 'Minlength must be a numeric value',
        'maxLength.0.numeric' => 'Maxlength must be a numeric value',
        'label.*.required' => 'Please enter the label',
        'fieldType.*.required' => 'Please select the field type',
        'minLength.*.numeric' => 'Minlength must be a numeric value',
        'maxLength.*.numeric' => 'Maxlength must be a numeric value',
    ];

    private function setDefaultFields($i)
    {
        $this->label[$i] = '';
        $this->fieldTypeValues[$i] = '';
        $this->fieldType[$i] = 'text';
    }

    private function resetForm()
    {
        $this->reset(['formId', 'method', 'enctype', 'label', 'fieldType', 'fileType', 'selectOptions', 'customClass', 'minLength', 'maxLength', 'regex', 'required', 'fields', 'fieldTypeValues', 'index']);
    }

    public function add($i)
    {
        $this->index = $i + 1;
        $this->setDefaultFields($i);
        array_push($this->fields, $i);
    }

    public function remove($i)
    {
        unset($this->fields[$i]);
    }

    public function checkFieldType($index, $type)
    {
        $this->fieldTypeValues[$index] = $type;
    }

    public function store(Request $request)
    {
        $this->validate();
        dd($request->all());

        $this->fields = [];
        $this->resetForm();
        session()->flash('message', 'Form submit successfully');
    }

    public function render()
    {
        return view('livewire.form-validation')->layout('layouts.guest');
    }
}
