<?php

namespace Wovosoft\HrmsPerson\Actions;

use Illuminate\Database\Eloquent\Model;
use Wovosoft\HrmsPerson\Enums\WorkHistoryType;
use Wovosoft\HrmsPerson\Models\DepartmentalWorkHistory;
use Wovosoft\HrmsPerson\Models\NonDepartmentalWorkHistory;
use Wovosoft\HrmsPerson\Models\Person;
use Wovosoft\HrmsPerson\Models\WorkHistory;

class WorkHistoriesAction
{
    private ?WorkHistory $workHistory = null;

    public function __construct(private readonly Person $person)
    {
    }

    /**
     * @throws \Throwable
     */
    public function create(array $data): Model|bool
    {
        $workHistory = new WorkHistory();

        $workHistory->forceFill([
            "from"                 => $data['from'],
            "to"                   => $data['to'],
            "type"                 => $data["type"] ?? WorkHistoryType::Transfer,
            "is_departmental"      => (bool)$data['is_departmental'],
            "prev_work_history_id" => $this->person->workHistories()->latest('to')->first()?->id
        ]);

        $this->person->workHistories()->save($workHistory);


        if ($workHistory->is_departmental) {
            $info = new DepartmentalWorkHistory();
            $info->forceFill([
                "office_id"      => $data['info']['office_id'],
                "designation_id" => $data['info']['designation_id'],
                "comment"        => $data['info']['comment'],
            ]);
        } else {
            $info = new NonDepartmentalWorkHistory();
            $info->forceFill([
                "institution_id" => $data['info']['institution_id'],
                "designation"    => $data['info']['designation'],
                "posting_office" => $data['info']['posting_office'],
                "comment"        => $data['info']['comment'],
            ]);
        }

        $info->saveOrFail();

        $workHistory->info()->associate($info)->saveOrFail();

        $this->workHistory = $workHistory;
        return $workHistory;
    }

    public function of(WorkHistory $workHistory): static
    {
        $this->workHistory = $workHistory;
        return $this;
    }

    /**
     * [to=>date]
     * @param array $data
     * @return WorkHistory
     * @throws \Throwable
     */
    public function addReleaseRecord(array $data): WorkHistory
    {
        if ($this->person->workHistories()->exists()) {
            $workHistory = $this
                ->person
                ->workHistories()
                ->latest('from')
                ->firstOrFail();

            $workHistory->forceFill($data)->saveOrFail();
        } else {
            $workHistory = new WorkHistory();
            $workHistory->forceFill([
                "from"            => $this->person?->employee?->joining_date,
                "to"              => now(),
                "is_departmental" => true,
            ]);
            $this->person->workHistories()->save($workHistory);

            $departmentalWorkHistory = new DepartmentalWorkHistory();
            $departmentalWorkHistory->forceFill([
                "office_id"      => $this->person->employee->office_id,
                "designation_id" => $this->person->employee->designation_id,
            ]);
            $departmentalWorkHistory->saveOrFail();

            $workHistory->info()->associate($departmentalWorkHistory)->saveOrFail();
        }

        $this->workHistory = $workHistory;

        return $this->workHistory;
    }

    /**
     * @throws \Throwable
     */
    public function addJoiningRecord(array $data): bool
    {
        $workHistory = new WorkHistory();
        $workHistory->forceFill([
            "from"                 => $data['from'],
            "is_departmental"      => true,
            "prev_work_history_id" => $this->person->workHistories()->latest('from')->first()?->id
        ]);

        $this->person->workHistories()->save($workHistory);

        $departmentalWorkHistory = new DepartmentalWorkHistory();
        $departmentalWorkHistory->forceFill($data['info']);
        $departmentalWorkHistory->saveOrFail();

        return $workHistory->info()->associate($departmentalWorkHistory)->saveOrFail();
    }

    /**
     * @throws \Throwable
     */
    public function update(array $data): ?WorkHistory
    {
        $this->workHistory->forceFill([
            "from"                 => $data['from'],
            "to"                   => $data['to'],
            "is_departmental"      => (bool)$data['is_departmental'],
            "prev_work_history_id" => $this->person->workHistories()->latest('to')->first()?->id
        ])->saveOrFail();

        if ($this->workHistory->is_departmental) {
            if ($this->workHistory->info()->exists()) {
                if ($this->workHistory->info_type === DepartmentalWorkHistory::class) {
                    $info = $this->workHistory->info;
                } else {
                    $this->workHistory->info()->delete();
                    $info = new DepartmentalWorkHistory();
                }
            } else {
                $info = new DepartmentalWorkHistory();
            }

            $info->forceFill([
                "office_id"      => $data['info']['office_id'],
                "designation_id" => $data['info']['designation_id'],
                "comment"        => $data['info']['comment'],
            ]);
        } else {
            if ($this->workHistory->info()->exists()) {
                if ($this->workHistory->info_type === NonDepartmentalWorkHistory::class) {
                    $info = $this->workHistory->info;
                } else {
                    $this->workHistory->info()->delete();
                    $info = new NonDepartmentalWorkHistory();
                }
            } else {
                $info = new NonDepartmentalWorkHistory();
            }

            $info->forceFill([
                "institution_id" => $data['info']['institution_id'],
                "designation"    => $data['info']['designation'],
                "posting_office" => $data['info']['posting_office'],
                "comment"        => $data['info']['comment'],
            ]);
        }

        $info->saveOrFail();

        $this->workHistory->info()->associate($info)->saveOrFail();

        return $this->workHistory;
    }

    /**
     * @throws \Throwable
     */
    public function delete(): ?bool
    {
        $this->workHistory->deleteOrFail();
        $this->workHistory->info()->delete();
        return true;
    }
}
