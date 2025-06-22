<?php

namespace App\Livewire;

use App\Enums\TypeEnum;
use App\Models\User;
use Livewire\Component;

class UserManagement extends Component
{
    public $filter = 'all';
    public TypeEnum $type;

    protected $queryString = [
        'filter' => ['except' => 'all']
    ];
    
    public function render()
    {
        $query = User::withTrashed()->with([
            'moreDetail.jobTitle',
            'moreDetail.country',
            'moreDetail.languages',
            'moreDetail.skills'
        ])->whereHas('moreDetail');


        // Apply role filter ONLY if $type = 'teacher'
        if ($this->type === TypeEnum::TEACHER) {
            $query->where('role', 'teacher');
        }

        // Apply status filter (active/banned/deleted)
        switch ($this->filter) {
            case 'active':
                $query->where('deleted_at', null)
                    ->whereHas('moreDetail', fn($q) => $q->where('is_banned', false));
                break;
            case 'banned':
                $query->where('deleted_at', '!=', null)
                    ->whereHas('moreDetail', fn($q) => $q->where('is_banned', true));
                break;
            case 'deleted':
                $query->where('deleted_at', '!=', null)
                    ->whereHas('moreDetail', fn($q) => $q->where('is_banned', false));
                break;
            default: // 'all' (no additional filters)
                $query->withTrashed();
        }

        // Get counts (respecting $type)
        $countQuery = User::withTrashed()->whereHas('moreDetail');

        if ($this->type === TypeEnum::TEACHER) {
            $countQuery->where('role', 'teacher');
        }

        $counts = [
            'all'     => $countQuery->count(),
            'active'  => $countQuery->clone()
                ->where('deleted_at', null)
                ->whereHas('moreDetail', fn($q) => $q->where('is_banned', false))
                ->count(),
            'banned'  => $countQuery->clone()
                ->where('deleted_at', '!=', null)
                ->whereHas('moreDetail', fn($q) => $q->where('is_banned', true))
                ->count(),
            'deleted' => $countQuery->clone()
                ->where('deleted_at', '!=', null)
                ->whereHas('moreDetail', fn($q) => $q->where('is_banned', false))
                ->count(),
        ];

        $users = $query->orderBy('created_at', 'desc')->get();
        $type = $this->type;
        $filter = $this->filter;

        return view('livewire.user-management', compact('users', 'counts', 'filter', 'type'))->layout('components.layouts.header', ['title' => "$type->value Management"]);
    }

    public function changeFilter($filter)
    {
        $this->filter = $filter;
    }
}
