<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\BlogImage;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogImagePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:BlogImage');
    }

    public function view(AuthUser $authUser, BlogImage $blogImage): bool
    {
        return $authUser->can('View:BlogImage');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:BlogImage');
    }

    public function update(AuthUser $authUser, BlogImage $blogImage): bool
    {
        return $authUser->can('Update:BlogImage');
    }

    public function delete(AuthUser $authUser, BlogImage $blogImage): bool
    {
        return $authUser->can('Delete:BlogImage');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:BlogImage');
    }

    public function restore(AuthUser $authUser, BlogImage $blogImage): bool
    {
        return $authUser->can('Restore:BlogImage');
    }

    public function forceDelete(AuthUser $authUser, BlogImage $blogImage): bool
    {
        return $authUser->can('ForceDelete:BlogImage');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:BlogImage');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:BlogImage');
    }

    public function replicate(AuthUser $authUser, BlogImage $blogImage): bool
    {
        return $authUser->can('Replicate:BlogImage');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:BlogImage');
    }

}