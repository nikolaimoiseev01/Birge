<?php

namespace App\Livewire\Components;

use App\Models\Expert;
use Livewire\Component;

class ExpertPopup extends Component
{
    public ?Expert $expert = null;

    protected $listeners = [
        'loadExpert' => 'loadExpert',
    ];

    public function loadExpert(int $id): void
    {
        $this->expert = Expert::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.components.expert-popup');
    }

    public function nextExpert(): array
    {
        if (!$this->expert) {
            $this->expert = Expert::orderBy('id')->first();
        } else {
            $this->expert = Expert::where('id', '>', $this->expert->id)
                ->orderBy('id')
                ->first()
                ?? Expert::orderBy('id')->first();
        }

        return [
            'id' => $this->expert->id,
            'imageUrl' => $this->expert->getFirstMediaUrl('image'),
        ];
    }

    public function prevExpert(): array
    {
        if (!$this->expert) {
            $this->expert = Expert::orderByDesc('id')->first();
        } else {
            $this->expert = Expert::where('id', '<', $this->expert->id)
                ->orderByDesc('id')
                ->first()
                ?? Expert::orderByDesc('id')->first();
        }

        return [
            'id' => $this->expert->id,
            'imageUrl' => $this->expert->getFirstMediaUrl('image'),
        ];
    }
}
