<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\BranchStructure;
use Illuminate\Auth\Access\HandlesAuthorization;

class BranchStructurePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:BranchStructure');
    }

    public function view(AuthUser $authUser, BranchStructure $branchStructure): bool
    {
        return $authUser->can('View:BranchStructure');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:BranchStructure');
    }

    public function update(AuthUser $authUser, BranchStructure $branchStructure): bool
    {
        return $authUser->can('Update:BranchStructure');
    }

    public function delete(AuthUser $authUser, BranchStructure $branchStructure): bool
    {
        return $authUser->can('Delete:BranchStructure');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:BranchStructure');
    }

    public function restore(AuthUser $authUser, BranchStructure $branchStructure): bool
    {
        return $authUser->can('Restore:BranchStructure');
    }

    public function forceDelete(AuthUser $authUser, BranchStructure $branchStructure): bool
    {
        return $authUser->can('ForceDelete:BranchStructure');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:BranchStructure');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:BranchStructure');
    }

    public function replicate(AuthUser $authUser, BranchStructure $branchStructure): bool
    {
        return $authUser->can('Replicate:BranchStructure');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:BranchStructure');
    }

}