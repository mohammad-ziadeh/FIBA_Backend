<?php

namespace App\Helpers;

class BreadcrumbsHelper
{
    public static function generateBreadcrumbs($routeName)
    {
        $breadcrumbs = [];

        if ($routeName === 'dashboard') {
            $breadcrumbs[] = ['label' => 'Dashboard', 'url' => route('dashboard')];
        } elseif ($routeName === 'profile.edit') {
            $breadcrumbs[] = ['label' => 'Dashboard', 'url' => route('dashboard')];
            $breadcrumbs[] = ['label' => 'Profile', 'url' => route('profile.edit')];
        } elseif ($routeName === 'tables') {
            $breadcrumbs[] = ['label' => 'Dashboard', 'url' => route('dashboard')];
            $breadcrumbs[] = ['label'=> 'Tables','url'=> route('tables')];
        } elseif ($routeName === 'announcements.index') {
            $breadcrumbs[] = ['label' => 'Dashboard', 'url' => route('dashboard')];
            $breadcrumbs[] = ['label'=> 'Announcements','url'=> route('announcements.index')];
        }  elseif ($routeName === 'spinner') {
            $breadcrumbs[] = ['label' => 'Dashboard', 'url' => route('dashboard')];
            $breadcrumbs[] = ['label'=> 'Spinner','url'=> route('spinner')];
        } elseif ($routeName === 'users.index') {
            $breadcrumbs[] = ['label' => 'Dashboard', 'url' => route('dashboard')];
            $breadcrumbs[] = ['label'=> 'Tables','url'=> route('tables')];
            $breadcrumbs[] = ['label'=> 'Users','url'=> route('users.index')];
        }elseif ($routeName === 'tasks.index') {
            $breadcrumbs[] = ['label' => 'Dashboard', 'url' => route('dashboard')];
            $breadcrumbs[] = ['label'=> 'Tables','url'=> route('tables')];
            $breadcrumbs[] = ['label'=> 'Tasks','url'=> route('tasks.index')];
        }elseif ($routeName === 'attendance.index') {
            $breadcrumbs[] = ['label' => 'Dashboard', 'url' => route('dashboard')];
            $breadcrumbs[] = ['label'=> 'Tables','url'=> route('tables')];
            $breadcrumbs[] = ['label'=> 'Attendance','url'=> route('attendance.index')];
        }elseif ($routeName === 'attendanceHistory.index') {
            $breadcrumbs[] = ['label' => 'Dashboard', 'url' => route('dashboard')];
            $breadcrumbs[] = ['label'=> 'Tables','url'=> route('tables')];
            $breadcrumbs[] = ['label'=> 'Attendance','url'=> route('attendance.index')];
            $breadcrumbs[] = ['label'=> 'Yesterday Attendance','url'=> route('attendanceHistory.index')];
        }elseif ($routeName === 'leaderBoard.index') {
            $breadcrumbs[] = ['label' => 'Dashboard', 'url' => route('dashboard')];
            $breadcrumbs[] = ['label'=> 'Tables','url'=> route('tables')];
            $breadcrumbs[] = ['label'=> 'Leaderboard','url'=> route('leaderBoard.index')];
        }elseif ($routeName === 'submissions.index') {
            $breadcrumbs[] = ['label' => 'Dashboard', 'url' => route('dashboard')];
            $breadcrumbs[] = ['label'=> 'Tables','url'=> route('tables')];
            $breadcrumbs[] = ['label'=> 'Submissions','url'=> route('submissions.index')];
        }elseif ($routeName === 'badges.assign.form') {
            $breadcrumbs[] = ['label' => 'Dashboard', 'url' => route('dashboard')];
            $breadcrumbs[] = ['label' => 'Tables', 'url' => route('tables')];
            $breadcrumbs[] = ['label' => 'Badges', 'url' => route('badges.assign.form')];
        }elseif ($routeName === 'badges.create') {
            $breadcrumbs[] = ['label' => 'Dashboard', 'url' => route('dashboard')];
            $breadcrumbs[] = ['label' => 'Tables', 'url' => route('tables')];
            $breadcrumbs[] = ['label' => 'Badges', 'url' => route('badges.assign.form')];
            $breadcrumbs[] = ['label' => 'Create Badge', 'url' => route('badges.create')];
        }

        return $breadcrumbs;
    }
}
