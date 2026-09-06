<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\AiConfig;
use Illuminate\Auth\Access\HandlesAuthorization;

class AiConfigPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:AiConfig');
    }

    public function view(AuthUser $authUser, AiConfig $aiConfig): bool
    {
        return $authUser->can('View:AiConfig');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:AiConfig');
    }

    public function update(AuthUser $authUser, AiConfig $aiConfig): bool
    {
        return $authUser->can('Update:AiConfig');
    }

    public function delete(AuthUser $authUser, AiConfig $aiConfig): bool
    {
        return $authUser->can('Delete:AiConfig');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:AiConfig');
    }

    public function restore(AuthUser $authUser, AiConfig $aiConfig): bool
    {
        return $authUser->can('Restore:AiConfig');
    }

    public function forceDelete(AuthUser $authUser, AiConfig $aiConfig): bool
    {
        return $authUser->can('ForceDelete:AiConfig');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:AiConfig');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:AiConfig');
    }

    public function replicate(AuthUser $authUser, AiConfig $aiConfig): bool
    {
        return $authUser->can('Replicate:AiConfig');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:AiConfig');
    }

}