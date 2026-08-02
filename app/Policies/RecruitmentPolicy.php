<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Recruitment;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecruitmentPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Recruitment');
    }

    public function view(AuthUser $authUser, Recruitment $recruitment): bool
    {
        return $authUser->can('View:Recruitment');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Recruitment');
    }

    public function update(AuthUser $authUser, Recruitment $recruitment): bool
    {
        return $authUser->can('Update:Recruitment');
    }

    public function delete(AuthUser $authUser, Recruitment $recruitment): bool
    {
        return $authUser->can('Delete:Recruitment');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Recruitment');
    }

    public function restore(AuthUser $authUser, Recruitment $recruitment): bool
    {
        return $authUser->can('Restore:Recruitment');
    }

    public function forceDelete(AuthUser $authUser, Recruitment $recruitment): bool
    {
        return $authUser->can('ForceDelete:Recruitment');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Recruitment');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Recruitment');
    }

    public function replicate(AuthUser $authUser, Recruitment $recruitment): bool
    {
        return $authUser->can('Replicate:Recruitment');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Recruitment');
    }

}