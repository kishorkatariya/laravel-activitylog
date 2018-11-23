<?php
/**
 * Created by PhpStorm.
 * User: rgi-39
 * Date: 20/11/18
 * Time: 5:34 PM
 */

namespace Kishor\Activity\Observer;

use Illuminate\Routing\Controller as BaseController;
use function json_encode;
use Kishor\Activity\Models\Activity;
use function method_exists;
use const true;

class ActivityObserver extends BaseController
{

    public function retrieved()
    {

    }

    public function creating()
    {

    }

    public function updating($model)
    {
        try {
            if (array_key_exists("enabled", $model->getActivityLogData())) {
                $logStatus = $model->getActivityLogData()['enabled'];
            } else {
                $logStatus = true;
            }

            if ($logStatus == true) {
                $referenceId = $model->getKey();
                $referenceLogType = $model->getTable();
                $oldDiff = array_diff_assoc($model->getOriginal(), $model->getAttributes());
                $newDiff = array_diff_assoc($model->getAttributes(), $model->getOriginal());

                if (method_exists($model, 'getActivityLogData')) {
                    if (array_key_exists("update", $model->getActivityLogData())) {
                        $description = $model->getActivityLogData()['update'];
                    } else {
                        $description = "Updated Successfully.";
                    }
                } else {
                    $description = "Updated Successfully.";
                }

                Activity::create([
                    'reference_id' => $referenceId,
                    'reference_log_type' => $referenceLogType,
                    'old_value' => (!empty($oldDiff) ? $oldDiff : NULL),
                    'new_value' => (!empty($newDiff) ? $newDiff : NULL),
                    'record' => json_encode($model->getAttributes()),
                    'action' => 'updated',
                    'description' => $description,
                    'created_by' => ''
                ]);
            }

        } catch (\Exception $exception) {
            \Log::info($exception->getMessage());
        }


    }

    public function created($model)
    {
        try {
            if (array_key_exists("enabled", $model->getActivityLogData())) {
                $logStatus = $model->getActivityLogData()['enabled'];
            } else {
                $logStatus = true;
            }

            if ($logStatus == true) {
                $referenceId = $model->getKey();
                $referenceLogType = $model->getTable();

                if (method_exists($model, 'getActivityLogData')) {
                    if (array_key_exists("create", $model->getActivityLogData())) {
                        $description = $model->getActivityLogData()['create'];
                    } else {
                        $description = "Created Successfully.";
                    }
                } else {
                    $description = "Created Successfully.";
                }

                Activity::create([
                    'reference_id' => $referenceId,
                    'reference_log_type' => $referenceLogType,
                    'record' => json_encode($model->getAttributes()),
                    'action' => 'create',
                    'description' => $description,
                    'created_by' => ''
                ]);
            }
        } catch (\Exception $exception) {
            \Log::info($exception->getMessage());
        }
    }

    public function updated()
    {

    }

    public function saving()
    {

    }

    public function saved()
    {

    }

    public function restoring()
    {

    }

    public function restored()
    {

    }

    public function deleting()
    {
    }

    public function deleted($model)
    {
        try {
            if (array_key_exists("enabled", $model->getActivityLogData())) {
                $logStatus = $model->getActivityLogData()['enabled'];
            } else {
                $logStatus = true;
            }

            if ($logStatus == true) {
                $referenceId = $model->getKey();
                $referenceLogType = $model->getTable();

                if (method_exists($model, 'getActivityLogData')) {
                    if (array_key_exists("delete", $model->getActivityLogData())) {
                        $description = $model->getActivityLogData()['delete'];
                    } else {
                        $description = "Deleted Successfully.";
                    }
                } else {
                    $description = "Deleted Successfully.";
                }

                Activity::create([
                    'reference_id' => $referenceId,
                    'reference_log_type' => $referenceLogType,
                    'record' => json_encode($model->getAttributes()),
                    'action' => 'delete',
                    'description' => $description,
                    'created_by' => ''
                ]);
            }
        } catch (\Exception $exception) {
            \Log::info($exception->getMessage());
        }
    }

    public function forceDeleted()
    {

    }
}