<?php

namespace App\Livewire\Template;

use Livewire\Attributes\Validate; 
use App\Services\PinpointService;
use Livewire\Component;

class Template extends Component
{
    #[Validate('required')] 
    public string $name = 'template 2';

    #[Validate('required')] 
    public string $subject = 'Subject 2';

    #[Validate('required')] 
    public string $html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body> 
    Hello {{User.UserAttributes.name}}. This email is to inform you of the purchase of product {{Event.attributes.ProductName}}, value ${{Event.attributes.ProductPrice}} </body>
</html>';

    #[Validate('nullable')] 
    public string $text = 'Hello {{User.UserAttributes.name}}. This email is to inform you of the purchase of product {{Event.attributes.ProductName}}, value ${{Event.attributes.ProductPrice}}';


    public function render()
    {
        return view('livewire.template.create');
    }

    public function save()
    {
        $this->validate();

        try{
            $service = new PinpointService;
            $service->createMailTemplate(
                    $this->name,
                    $this->subject,
                    $this->html,
                    $this->text,
                );

            session()->flash('status', 'success');
            session()->flash('message', 'Mail template created.');
            $this->reset();
        }
        catch(\Exception $e) 
        {
            session()->flash('status', 'error');
            session()->flash('message', $e->getMessage());
        }

        $previousRoute = request()->header('Referer');
        return redirect($previousRoute);
    }
}
