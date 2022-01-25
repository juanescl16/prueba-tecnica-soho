<?php

namespace App\Interfaces;

use App\Models\Project;

interface FileServiceInterface {
    public function uploadFiles($file, Project $project, $type);
}