<?php

namespace App\Http\Livewire;

use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

class Register extends Component implements HasForms
{
    use InteractsWithForms;

    public $name;
    public $email;
    public $password;
    public $role_id;

    public function mount(): void
    {
        $this->form->fill([
            'name' => "",
            'email' => "",
            'password' => "",
            'role_id' => "7"
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('name')->required(),
            TextInput::make('email')->email()->required(),
            TextInput::make('password')->password()->required(),
            Hidden::make('role_id')
            // ...
        ];
    }

    public function create(): void
    {
        User::create($this->form->getState());
    }
    protected function getFormModel(): string
    {
        return User::class;
    }

    public function render()
    {
        return view('livewire.register');
    }
}
