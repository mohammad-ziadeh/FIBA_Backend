<?php

namespace App\Helpers;

class StudentBreadcrumbsHelper
{
  public static function generateBreadcrumbs($routeName)
  {
    $breadcrumbs = [];

    if ($routeName === 'studentDashboard') {
      $breadcrumbs[] = ['label' => 'Dashboard', 'url' => route('studentDashboard')];
    } elseif ($routeName === 'profile.edit') {
      $breadcrumbs[] = ['label' => 'Dashboard', 'url' => route('studentDashboard')];
      $breadcrumbs[] = ['label' => 'Profile', 'url' => route('profile.edit')];
    } elseif ($routeName === 'studentSubmissions') {
      $breadcrumbs[] = ['label' => 'Dashboard', 'url' => route('studentDashboard')];
      $breadcrumbs[] = ['label' => 'Tasks', 'url' => route('studentSubmissions')];
    } elseif ($routeName === 'announcements') {
      $breadcrumbs[] = ['label' => 'Dashboard', 'url' => route('studentDashboard')];
      $breadcrumbs[] = ['label' => 'Announcements', 'url' => route('announcements')];
    } elseif ($routeName === 'student-leaderBoard.index') {
      $breadcrumbs[] = ['label' => 'Dashboard', 'url' => route('studentDashboard')];
      $breadcrumbs[] = ['label' => 'Leaderboard', 'url' => route('student-leaderBoard.index')];
    } elseif ($routeName === 'spinner') {
      $breadcrumbs[] = ['label' => 'Dashboard', 'url' => route('studentDashboard')];
      $breadcrumbs[] = ['label' => 'Spinner', 'url' => route('spinner')];
    }

    return $breadcrumbs;
  }
}
