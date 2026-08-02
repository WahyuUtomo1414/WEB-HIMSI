<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Count;
use Illuminate\Auth\Access\HandlesAuthorization;

class CountPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Count');
    }

    public function view(AuthUser $authUser, Count $count): bool
    {
        return $authUser->can('View:Count');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Count');
    }

    public function update(AuthUser $authUser, Count $count): bool
    {
        return $authUser->can('Update:Count');
    }

    public function delete(AuthUser $authUser, Count $count): bool
    {
        return $authUser->can('Delete:Count');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Count');
    }

    public function restore(AuthUser $authUser, Count $count): bool
    {
        return $authUser->can('Restore:Count');
    }

    public function forceDelete(AuthUser $authUser, Count $count): bool
    {
        return $authUser->can('ForceDelete:Count');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Count');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Count');
    }

    public function replicate(AuthUser $authUser, Count $count): bool
    {
        return $authUser->can('Replicate:Count');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Count');
    }

}