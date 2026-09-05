<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\AiChatLog;
use Illuminate\Auth\Access\HandlesAuthorization;

class AiChatLogPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:AiChatLog');
    }

    public function view(AuthUser $authUser, AiChatLog $aiChatLog): bool
    {
        return $authUser->can('View:AiChatLog');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:AiChatLog');
    }

    public function update(AuthUser $authUser, AiChatLog $aiChatLog): bool
    {
        return $authUser->can('Update:AiChatLog');
    }

    public function delete(AuthUser $authUser, AiChatLog $aiChatLog): bool
    {
        return $authUser->can('Delete:AiChatLog');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:AiChatLog');
    }

    public function restore(AuthUser $authUser, AiChatLog $aiChatLog): bool
    {
        return $authUser->can('Restore:AiChatLog');
    }

    public function forceDelete(AuthUser $authUser, AiChatLog $aiChatLog): bool
    {
        return $authUser->can('ForceDelete:AiChatLog');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:AiChatLog');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:AiChatLog');
    }

    public function replicate(AuthUser $authUser, AiChatLog $aiChatLog): bool
    {
        return $authUser->can('Replicate:AiChatLog');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:AiChatLog');
    }

}