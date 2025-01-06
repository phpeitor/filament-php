<?php
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->datetime('meeting_date');
            $table->string('subject');
            $table->enum('meeting_status',['requested','accepted','finished','cancelled'])->default('requested');
            
            $table->text('details')->nullable();
            $table->string('url')->nullable();
            $table->json('minutes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
