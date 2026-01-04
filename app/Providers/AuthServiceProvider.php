<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

// Models
use App\Models\User;
use App\Models\Computer;
use App\Models\Branch;
use App\Models\ComputerModel;
use App\Models\ActivityReport;
use App\Models\AssetClass;
use App\Models\ATMReport;
use App\Models\ATM;
use App\Models\Cache;
use App\Models\CacheLock;
use App\Models\DataVPN;
use App\Models\Deliverable;
use App\Models\District;
use App\Models\Dongle;
use App\Models\DowntimeReason;
use App\Models\DOB;
use App\Models\Export;
use App\Models\FailedImportRow;
use App\Models\FailedJob;
use App\Models\FixedLine;
use App\Models\GroupPermission;
use App\Models\HQ;
use App\Models\Import;
use App\Models\Job;
use App\Models\JobBatch;
use App\Models\Migration;
use App\Models\ModelHasPermission;
use App\Models\ModelHasRole;
use App\Models\OtherAsset;
use App\Models\Outlet;
use App\Models\OU;
use App\Models\PasswordResetToken;
use App\Models\Photocopy;
use App\Models\POS;
use App\Models\Printer;
use App\Models\Role;
use App\Models\RoleHasPermission;
use App\Models\Scanner;
use App\Models\Session;
use App\Models\Task;
use App\Models\TaskCategory;
use App\Models\UserUserGroup;

// Base Policy
use App\Policies\BasePolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // Keep empty, we register dynamically
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        $models = [
            User::class,
            Computer::class,
            Branch::class,
            ComputerModel::class,
            ActivityReport::class,
            AssetClass::class,
            ATMReport::class,
            ATM::class,
            DataVPN::class,
            Deliverable::class,
            District::class,
            Dongle::class,
            DowntimeReason::class,
            DOB::class,
            FixedLine::class,
            HQ::class,
            OtherAsset::class,
            Outlet::class,
            OU::class,
            Photocopy::class,
            POS::class,
            Printer::class,
            Scanner::class,
            Task::class,
            TaskCategory::class,
            UserUserGroup::class,
        ];

        foreach ($models as $model) {
            Gate::policy($model, BasePolicy::class);
        }
    }
}
