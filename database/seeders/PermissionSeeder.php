<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // List of tables / models
        $tables = [
            'activity_reports',
            'asset_classes',
            'a_t_m_reports',
            'a_t_m_s',
            'branches',
            'cache',
            'cache_locks',
            'computers',
            'computer_models',
            'data_v_p_n_s',
            'deliverables',
            'districts',
            'dongles',
            'downtime_reasons',
            'd_o_b_s',
            'exports',
            'failed_import_rows',
            'failed_jobs',
            'fixed_lines',
            'group_permission',
            'h_q_s',
            'imports',
            'jobs',
            'job_batches',
            'migrations',
            'model_has_permissions',
            'model_has_roles',
            'other_assets',
            'outlets',
            'o_u_s',
            'password_reset_tokens',
            'permissions',
            'photocopies',
            'pos',
            'printers',
            'roles',
            'role_has_permissions',
            'scanners',
            'sessions',
            'tasks',
            'task_categories',
            'users',
            'user_groups',
            'user_user_group',
        ];

        // Standard and extended actions
        $actions = [
            'viewAny',
            'view',
            'create',
            'update',
            'delete',
            'restore',
            'forceDelete',
            'export',
            'import',
            'approve',
            'reject',
            'archive',
            'unarchive',
            'publish',
            'unpublish',
            'assign'
        ];

        foreach ($tables as $table) {
            foreach ($actions as $action) {
                Permission::firstOrCreate([
                    'name'  => strtolower($table) . '.' . strtolower($action),
                    'model' => $table,
                    'action' => $action,
                ]);
            }
        }
    }
}
