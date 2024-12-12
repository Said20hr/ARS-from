<?php

namespace App\Livewire\Forms;

use App\Models\Event;
use Livewire\Component;

class Form extends Component
{
    public $currentStep = 0; // Start at Step 0
    public $totalSteps = 4; // Adjust to include Step 0

    public $name, $email, $phone, $job_title, $company_name, $industry, $industry_other;
    public $motivation, $contribution, $previous_event, $previous_event_details;
    public $heard_about, $heard_about_other;

    protected $rules = [
        1 => [
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
        ],
        2 => [
            'job_title' => 'required|string',
            'company_name' => 'required|string',
            'industry' => 'required|string',
            'industry_other' => 'required_if:industry,autres|nullable|string', // Updated validation for industry_other
        ],
        3 => [
            'motivation' => 'required|string',
            'contribution' => 'required|string',
        ],
        4 => [
            'previous_event' => 'required|string',
            'previous_event_details' => 'required_if:previous_event,yes|nullable|string', // Updated validation for previous_event_details
            'heard_about' => 'required|string',
            'heard_about_other' => 'required_if:heard_about,other|nullable|string', // Updated validation for heard_about_other
        ],
    ];

    public function nextStep()
    {
        if ($this->currentStep > 0) {
            $this->validate($this->rules[$this->currentStep] ?? []);
        }
        $this->currentStep++;
    }

    public function previousStep()
    {
        $this->currentStep--;
    }

    public function submit()
    {
        $this->validate($this->rules[$this->currentStep]);

        // Save to database
        Event::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'job_title' => $this->job_title,
            'company_name' => $this->company_name,
            'industry' => $this->industry == 'autres' ? $this->industry_other : $this->industry,
            'motivation' => $this->motivation,
            'contribution' => $this->contribution,
            'previous_event' => $this->previous_event,
            'previous_event_details' => $this->previous_event_details,
            'heard_about' => $this->heard_about == 'other' ? $this->heard_about_other : $this->heard_about,
        ]);

        session()->flash('message', 'Votre demande a été soumise avec succès.');
        $this->reset(); // Reset the form fields
        $this->currentStep = 1; // Reset to step 1
    }
    public function render()
    {
        return view('livewire.forms.form');
    }
}
