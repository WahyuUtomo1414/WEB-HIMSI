<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\AiKnowledgeSource;
use Illuminate\Auth\Access\HandlesAuthorization;

class AiKnowledgeSourcePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:AiKnowledgeSource');
    }

    public function view(AuthUser $authUser, AiKnowledgeSource $aiKnowledgeSource): bool
    {
        return $authUser->can('View:AiKnowledgeSource');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:AiKnowledgeSource');
    }

    public function update(AuthUser $authUser, AiKnowledgeSource $aiKnowledgeSource): bool
    {
        return $authUser->can('Update:AiKnowledgeSource');
    }

    public function delete(AuthUser $authUser, AiKnowledgeSource $aiKnowledgeSource): bool
    {
        return $authUser->can('Delete:AiKnowledgeSource');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:AiKnowledgeSource');
    }

    public function restore(AuthUser $authUser, AiKnowledgeSource $aiKnowledgeSource): bool
    {
        return $authUser->can('Restore:AiKnowledgeSource');
    }

    public function forceDelete(AuthUser $authUser, AiKnowledgeSource $aiKnowledgeSource): bool
    {
        return $authUser->can('ForceDelete:AiKnowledgeSource');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:AiKnowledgeSource');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:AiKnowledgeSource');
    }

    public function replicate(AuthUser $authUser, AiKnowledgeSource $aiKnowledgeSource): bool
    {
        return $authUser->can('Replicate:AiKnowledgeSource');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:AiKnowledgeSource');
    }

}