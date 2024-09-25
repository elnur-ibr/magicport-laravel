<?php

declare(strict_types=1);

use App\Enums\TaskStatusEnum;
use App\Models\Project;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(Project::class)->index()->constrained();
            $table->string('name');
            $table->string('description', 510)->nullable();
            $table->unsignedTinyInteger('status')->default(TaskStatusEnum::TODO)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
