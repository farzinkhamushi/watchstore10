<?php

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
        Schema::create('app_translations', function (Blueprint $table) {
            $table->id();
            $table->string('en')->default(\App\Enums\LanguageStatus::English->value);
            $table->string('fa')->default(\App\Enums\LanguageStatus::Farsi->value);
            $table->string('pr')->default(\App\Enums\LanguageStatus::Portuguese->value);
            $table->string('sw')->default(\App\Enums\LanguageStatus::Swedish->value);
            $table->string('gr')->default(\App\Enums\LanguageStatus::German->value);
            $table->string('fr')->default(\App\Enums\LanguageStatus::French->value);
            $table->string('it')->default(\App\Enums\LanguageStatus::Italian->value);
            $table->string('sp')->default(\App\Enums\LanguageStatus::Spanish->value);
            $table->string('ch')->default(\App\Enums\LanguageStatus::Chinese->value);
            $table->string('ja')->default(\App\Enums\LanguageStatus::Japanese->value);
            $table->string('kr')->default(\App\Enums\LanguageStatus::Korean->value);
            $table->string('tr')->default(\App\Enums\LanguageStatus::Turkish->value);
            $table->string('ar')->default(\App\Enums\LanguageStatus::Arabic->value);
            $table->string('rs')->default(\App\Enums\LanguageStatus::Russian->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_translations');
    }
};
